(function (wp) {
    const { addFilter } = wp.hooks;
    const { createElement, Fragment } = wp.element;
    const { InspectorControls } = wp.blockEditor || wp.editor;
    const { PanelBody, ToggleControl } = wp.components;
    const { createHigherOrderComponent } = wp.compose;
    const { __ } = wp.i18n;

    // 1. Añadir atributos personalizados al bloque
    function addAttributes(settings) {
        if (typeof settings.attributes !== 'undefined') {
            settings.attributes = {
                ...settings.attributes,
                dataNosnippetGeohat: {
                    type: 'boolean',
                    default: false,
                },
                dataNosnippet: {
                    type: 'boolean',
                    default: false,
                }
            };
        }
        return settings;
    }
    addFilter('blocks.registerBlockType', 'geohat/add-attributes', addAttributes);

    // 2. Mostrar controles en el inspector
    const withInspectorControls = createHigherOrderComponent((BlockEdit) => {
        return (props) => {
            const { attributes, setAttributes } = props;
            const { dataNosnippetGeohat, dataNosnippet } = attributes;

            return createElement(
                Fragment,
                {},
                createElement(BlockEdit, props),
                createElement(
                    InspectorControls,
                    {},
                    createElement(
                        PanelBody,
                        { title: __('Geohat Options', 'geohatllm'), initialOpen: true },
                        createElement(ToggleControl, {
                            label: __('Hide from LLM', 'geohatllm'),
                            checked: dataNosnippetGeohat,
                            onChange: (value) => setAttributes({ dataNosnippetGeohat: value }),
                        }),
                        createElement(ToggleControl, {
                            label: __('Hide from search engine SERPs', 'geohatllm'),
                            checked: dataNosnippet,
                            onChange: (value) => setAttributes({ dataNosnippet: value }),
                        })
                    )
                )
            );
        };
    }, 'withInspectorControls');
    addFilter('editor.BlockEdit', 'geohat/with-inspector-controls', withInspectorControls);

    // 3. NUEVO: Modificar el contenido guardado para envolver en <span>
    const modifyBlockSaveContent = createHigherOrderComponent((BlockListBlock) => {
        return (props) => {
            return createElement(BlockListBlock, props);
        };
    }, 'modifyBlockSaveContent');
    
    addFilter('editor.BlockListBlock', 'geohat/modify-block-save', modifyBlockSaveContent);

    // 4. Modificar el HTML final guardado
    addFilter('blocks.getSaveElement', 'geohat/wrap-content-in-span', function(element, blockType, attributes) {
        if (!attributes.dataNosnippetGeohat && !attributes.dataNosnippet) {
            return element;
        }

        // Solo aplicar a bloques de texto (p, h1-h6, li, etc.)
        const textBlocks = ['core/paragraph', 'core/heading', 'core/list-item', 'core/quote'];
        if (!textBlocks.includes(blockType.name)) {
            return element;
        }

        // Extraer el contenido del elemento
        const children = element.props.children;
        
        // Crear atributos para el span
        const spanAttrs = {};
        if (attributes.dataNosnippetGeohat) {
            spanAttrs['data-nosnippet-geohat'] = 'true';
        }
        if (attributes.dataNosnippet) {
            spanAttrs['data-nosnippet'] = 'true';
        }

        // Envolver el contenido en un <span>
        const wrappedChildren = createElement('span', spanAttrs, children);

        // Retornar el elemento original con el contenido envuelto
        return createElement(
            element.type,
            element.props,
            wrappedChildren
        );
    });

})(window.wp);


// Elementor

function applyGeoHatAttributes() {
    const elements = document.querySelectorAll('.elementor-element[data-settings]');
    elements.forEach(function (el) {
        try {
            const settings = JSON.parse(el.dataset.settings);
            if (settings.asdrubal_data_nosnippet_geohat === 'yes') {
                el.setAttribute('data-nosnippet-geohat', 'true');
                el.classList.add('geohat-nosnippet');
            }
            if (settings.asdrubal_data_nosnippet === 'yes') {
                el.setAttribute('data-nosnippet', 'true');
                el.classList.add('nosnippet');
            }
        } catch (e) {
            console.warn('Error al analizar data-settings de Elementor:', e);
        }
    });
}

// Ejecutar al cargar DOM
document.addEventListener('DOMContentLoaded', applyGeoHatAttributes);

// También cuando Elementor vuelve a renderizar dinámicamente en el editor
document.addEventListener('elementor/popup/show', applyGeoHatAttributes);
document.addEventListener('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/global', applyGeoHatAttributes);
});
