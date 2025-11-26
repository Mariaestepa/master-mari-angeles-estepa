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

    // 3. ✅ CRÍTICO: Envolver TODO EL BLOQUE en un <span> con los atributos
    // Esto asegura que data-nosnippet funcione correctamente en <p>, <h1>, etc.
    addFilter('blocks.getSaveElement', 'geohat/wrap-in-span', function(element, blockType, attributes) {
        // Si no hay atributos activados, no hacer nada
        if (!attributes.dataNosnippetGeohat && !attributes.dataNosnippet) {
            return element;
        }

        // Crear atributos para el span wrapper
        const spanAttrs = {
            className: 'geohat-wrapper' // Clase opcional para identificar el wrapper
        };
        
        if (attributes.dataNosnippetGeohat) {
            spanAttrs['data-nosnippet-geohat'] = 'true';
        }
        if (attributes.dataNosnippet) {
            spanAttrs['data-nosnippet'] = 'true';
        }

        // ✅ Envolver TODO el elemento original en un <span>
        // Esto convierte: <p>texto</p> → <span data-nosnippet="true"><p>texto</p></span>
        return createElement('span', spanAttrs, element);
    });

})(window.wp);


// Elementor - Aplicar atributos dinámicamente

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