import { DataTable } from 'simple-datatables';

/** Menú lateral en pantallas pequeñas. */
function initSidebar() {
    const side = document.getElementById('side');
    const scrim = document.getElementById('scrim');
    const toggle = document.querySelector('[data-side-toggle]');
    if (!side || !toggle) return;

    const set = (open) => {
        side.dataset.open = String(open);
        toggle.setAttribute('aria-expanded', String(open));
        if (scrim) scrim.hidden = !open;
    };
    toggle.addEventListener('click', () => set(side.dataset.open !== 'true'));
    scrim?.addEventListener('click', () => set(false));
    document.addEventListener('keydown', (e) => e.key === 'Escape' && set(false));
}

/** Tablas con búsqueda, orden y paginación. */
function initTables() {
    document.querySelectorAll('table[data-datatable]').forEach((table) => {
        new DataTable(table, {
            searchable: true,
            perPage: 10,
            perPageSelect: [10, 25, 50],
            labels: {
                placeholder: 'Buscar…',
                perPage: 'registros por página',
                noRows: 'No hay registros para mostrar',
                noResults: 'Ningún registro coincide con la búsqueda',
                info: 'Mostrando {start} a {end} de {rows} registros',
            },
        });
    });
}

/** Confirmación de borrado con <dialog>: un solo diálogo para todas las tablas. */
function initDelete() {
    const dialog = document.getElementById('delete-dialog');
    if (!dialog) return;
    const form = dialog.querySelector('form');
    const label = dialog.querySelector('[data-delete-label]');

    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-delete]');
        if (!btn) return;
        form.action = btn.dataset.delete;
        label.textContent = btn.dataset.label || 'este registro';
        dialog.showModal();
    });
    dialog.querySelector('[data-cancel]').addEventListener('click', () => dialog.close());
}

/** Contador de caracteres en campos con límite. */
function initCounters() {
    document.querySelectorAll('textarea[maxlength], input[data-counter]').forEach((el) => {
        const out = document.getElementById(`${el.id}-counter`);
        if (!out) return;
        const max = Number(el.getAttribute('maxlength') || el.dataset.counter);
        const update = () => {
            out.textContent = `${el.value.length} / ${max}`;
            out.dataset.over = String(el.value.length > max);
        };
        el.addEventListener('input', update);
        update();
    });
}

initSidebar();
initTables();
initDelete();
initCounters();
