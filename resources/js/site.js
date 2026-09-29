/* Todo lo de aquí es mejora progresiva: sin JavaScript el sitio se lee completo. */

/** Menú de navegación en pantallas pequeñas. */
function initNav() {
    const toggle = document.querySelector('[data-nav-toggle]');
    const nav = document.getElementById('nav');
    if (!toggle || !nav) return;

    const set = (open) => {
        nav.dataset.open = String(open);
        toggle.setAttribute('aria-expanded', String(open));
    };

    toggle.addEventListener('click', () => set(nav.dataset.open !== 'true'));
    nav.addEventListener('click', (e) => e.target.closest('a') && set(false));
    document.addEventListener('keydown', (e) => e.key === 'Escape' && set(false));
}

/** Marca en la barra la sección que se está leyendo. */
function initScrollSpy() {
    const links = [...document.querySelectorAll('.nav a[href^="#"]')];
    const sections = links.map((a) => document.querySelector(a.getAttribute('href'))).filter(Boolean);
    if (!sections.length || !('IntersectionObserver' in window)) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.filter((e) => e.isIntersecting).forEach((e) => {
                links.forEach((a) => a.setAttribute('aria-current', String(a.hash === `#${e.target.id}`)));
            });
        },
        { rootMargin: '-45% 0px -50% 0px' },
    );
    sections.forEach((s) => observer.observe(s));
}

/** Casos técnicos: lista de proyectos + un panel visible a la vez (patrón WAI-ARIA tabs). */
function initCases() {
    const tabs = [...document.querySelectorAll('[data-case-tab]')];
    const panels = [...document.querySelectorAll('[data-case]')];
    if (tabs.length < 1) return;

    const select = (id, { focus = false, push = true } = {}) => {
        tabs.forEach((tab) => {
            const active = tab.dataset.caseTab === id;
            tab.setAttribute('aria-selected', String(active));
            tab.tabIndex = active ? 0 : -1;
            if (active && focus) tab.focus();
        });
        panels.forEach((panel) => { panel.hidden = panel.dataset.case !== id; });
        if (push) history.replaceState(null, '', `#proyecto-${id}`);
    };

    tabs.forEach((tab, i) => {
        tab.setAttribute('role', 'tab');
        tab.addEventListener('click', (e) => { e.preventDefault(); select(tab.dataset.caseTab); });
        tab.addEventListener('keydown', (e) => {
            const move = { ArrowDown: 1, ArrowRight: 1, ArrowUp: -1, ArrowLeft: -1 }[e.key];
            if (!move) return;
            e.preventDefault();
            select(tabs[(i + move + tabs.length) % tabs.length].dataset.caseTab, { focus: true });
        });
    });
    document.querySelector('[data-case-list]')?.setAttribute('role', 'tablist');
    panels.forEach((p) => p.setAttribute('role', 'tabpanel'));

    const fromHash = location.hash.match(/^#proyecto-(\d+)$/)?.[1];
    select(tabs.some((t) => t.dataset.caseTab === fromHash) ? fromHash : tabs[0].dataset.caseTab, { push: false });
}

/** Copiar datos de contacto. */
function initCopy() {
    document.querySelectorAll('[data-copy]').forEach((btn) => {
        btn.addEventListener('click', async () => {
            const original = btn.textContent;
            try {
                await navigator.clipboard.writeText(btn.dataset.copy);
                btn.textContent = 'Copiado';
            } catch {
                btn.textContent = 'Seleccionar y copiar';
            }
            setTimeout(() => { btn.textContent = original; }, 1800);
        });
    });
}

/** Validación del formulario de contacto antes de enviarlo (el servidor vuelve a validar). */
function initContactForm() {
    const form = document.querySelector('[data-contact-form]');
    if (!form) return;

    const rules = {
        nombre: (v) => (v.trim() ? '' : 'Indica tu nombre.'),
        email: (v) => (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) ? '' : 'Escribe un correo válido.'),
        mensaje: (v) => (v.trim().length >= 10 ? '' : 'El mensaje debe tener al menos 10 caracteres.'),
    };

    const check = (input) => {
        const error = rules[input.name]?.(input.value) ?? '';
        const slot = form.querySelector(`#${input.id}-error`);
        input.setAttribute('aria-invalid', String(Boolean(error)));
        if (slot) slot.textContent = error;
        return !error;
    };

    const inputs = [...form.querySelectorAll('input[name], textarea[name]')].filter((i) => rules[i.name]);
    inputs.forEach((i) => i.addEventListener('blur', () => check(i)));
    form.addEventListener('submit', (e) => {
        const invalid = inputs.filter((i) => !check(i));
        if (invalid.length) {
            e.preventDefault();
            invalid[0].focus();
        }
    });
}

initNav();
initScrollSpy();
initCases();
initCopy();
initContactForm();
