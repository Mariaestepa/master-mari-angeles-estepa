document.addEventListener('DOMContentLoaded', function() {
          const btn = document.getElementById('llm-multiselect-btn');
          const dropdown = document.getElementById('llm-dropdown');

          btn.addEventListener('click', () => {
              dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
          });

          document.addEventListener('click', (e) => {
              if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                  dropdown.style.display = 'none';
              }
          });
      });


      document.addEventListener("DOMContentLoaded", function () {
  const table = document.getElementById("gh-last-visits");
  if (!table) return;

  const headers = table.querySelectorAll("thead th");
  let currentSort = { index: null, order: "none" };

  headers.forEach((header, index) => {
    header.style.cursor = "pointer";
    header.style.userSelect = "none";

    const text = header.textContent.trim();
    header.textContent = "";

    const span = document.createElement("span");
    span.textContent = text;
    header.appendChild(span);

    const arrow = document.createElement("span");
    arrow.className = "ml-1 text-gray-400 transition-colors flechith";
    header.appendChild(arrow);

    header.addEventListener("click", () => {
      const tbody = table.querySelector("tbody");
      const rows = Array.from(tbody.querySelectorAll("tr"));
      const isSameColumn = currentSort.index === index;

      // Determinar nuevo orden
      let order;
      if (!isSameColumn) {
        order = "asc";
      } else {
        order = currentSort.order === "asc" ? "desc" : "asc";
      }
      currentSort = { index, order };

      // Resetear todos los encabezados
      headers.forEach((h, i) => {
        const hArrow = h.querySelector("span:last-child");
        hArrow.textContent = "";
        h.classList.remove("text-blue-700");
        if (i === index) {
          hArrow.textContent = order === "asc" ? "↑" : "↓";
          h.classList.add("text-blue-700");
        }
      });

      // Función auxiliar
      const isNumeric = (val) => /^-?\d+(\.\d+)?$/.test(val.trim());

      rows.sort((a, b) => {
        const aText = a.children[index]?.innerText.trim() || "";
        const bText = b.children[index]?.innerText.trim() || "";

        let aVal = aText, bVal = bText;

        // Fechas
        if (/\d{4}-\d{2}-\d{2}/.test(aVal) && /\d{4}-\d{2}-\d{2}/.test(bVal)) {
          aVal = new Date(aVal);
          bVal = new Date(bVal);
        } else if (isNumeric(aVal) && isNumeric(bVal)) {
          aVal = parseFloat(aVal);
          bVal = parseFloat(bVal);
        } else {
          aVal = aVal.toLowerCase();
          bVal = bVal.toLowerCase();
        }

        if (aVal > bVal) return order === "asc" ? 1 : -1;
        if (aVal < bVal) return order === "asc" ? -1 : 1;
        return 0;
      });

      tbody.innerHTML = "";
      rows.forEach(row => tbody.appendChild(row));
    });
  });
});

document.addEventListener('DOMContentLoaded', () => {
  // Devuelve el input de URL más razonable cerca del trigger
  const findClosestUrlInput = (startEl) => {
    const scope =
      startEl.closest('form, .filtro-urls, .url-filters, .filters, .filtros-urls') || document;

    return (
      scope.querySelector('input[type="url"]') ||
      scope.querySelector('input[id*="url"]') ||
      scope.querySelector('input[name*="url"]') ||
      scope.querySelector('input[data-filter="url"]') ||
      scope.querySelector('input[placeholder*="url" i]') ||
      scope.querySelector('input[placeholder*="/" i]') ||
      scope.querySelector('input[type="text"]')
    );
  };

  // Devuelve true si el checkbox "Check HTTP status" está activado
  const isCheckStatusEnabled = (scope) => {
    const form =
      scope instanceof HTMLFormElement
        ? scope
        : scope.closest('form, .filtro-urls, .url-filters, .filters, .filtros-urls');
    const check = form?.querySelector('input[name="check_status"]');
    return check?.checked === true;
  };

  const ensureDefaultSlash = (inputEl, scope) => {
    if (!inputEl) return;
    // 🚫 Solo poner '/' si está activado "Check HTTP Status"
    if (!isCheckStatusEnabled(scope)) return;
    if (String(inputEl.value).trim() === '') {
      inputEl.value = '/';
      inputEl.dispatchEvent(new Event('input', { bubbles: true }));
      inputEl.dispatchEvent(new Event('change', { bubbles: true }));
    }
  };

  // 1) Click en el botón/enlace "Check HTTP Status"
  document.addEventListener(
    'click',
    (ev) => {
      const trigger = ev.target.closest(
        [
          '#check-http-status',
          '[data-action="check-http-status"]',
          '.check-http-status',
          'button[aria-label*="check http status" i]',
          'a[aria-label*="check http status" i]',
          'button',
          'a',
          '[role="button"]',
          '.button',
        ].join(', ')
      );
      if (!trigger) return;

      const looksLikeCheck =
        trigger.id === 'check-http-status' ||
        trigger.dataset?.action === 'check-http-status' ||
        trigger.classList?.contains('check-http-status') ||
        (trigger.textContent || '').toLowerCase().includes('check http status');

      if (!looksLikeCheck) return;

      const urlInput = findClosestUrlInput(trigger);
      ensureDefaultSlash(urlInput, trigger);
    },
    true
  );

  // 2) Submit del formulario
  document.addEventListener(
    'submit',
    (ev) => {
      const form = ev.target;
      if (!(form instanceof HTMLFormElement)) return;

      const isUrlFilterScope =
        form.matches('.filtro-urls, .url-filters, .filters, .filtros-urls') ||
        form.querySelector('input[type="url"], input[name*="url"], input[id*="url"]');

      if (!isUrlFilterScope) return;

      const urlInput = findClosestUrlInput(form);
      ensureDefaultSlash(urlInput, form);
    },
    true
  );

  // 3) Pulsar Enter directamente dentro del input
  document.addEventListener('keydown', (e) => {
    if (e.key !== 'Enter') return;
    const target = e.target;
    if (!(target instanceof HTMLInputElement)) return;

    const isUrlish =
      target.type === 'url' ||
      /url/i.test(target.name || '') ||
      /url/i.test(target.id || '') ||
      /url/i.test(target.placeholder || '');

    if (!isUrlish) return;

    ensureDefaultSlash(target, target);
  });
});
