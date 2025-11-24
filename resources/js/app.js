import './bootstrap';

const initRowNavigation = () => {
    const navigableElements = document.querySelectorAll('.js-clickable-row[data-row-href]');

    const shouldIgnoreEvent = (event) => {
        return !!event.target.closest('[data-row-link-ignore]');
    };

    const openLink = (href, event) => {
        if (!href) {
            return;
        }

        if (event?.metaKey || event?.ctrlKey) {
            window.open(href, '_blank');
        } else {
            window.location.assign(href);
        }
    };

    navigableElements.forEach((element) => {
        const href = element.dataset.rowHref;
        if (!href || element.dataset.rowHandlerAttached) {
            return;
        }

        element.dataset.rowHandlerAttached = 'true';

        element.addEventListener('click', (event) => {
            if (shouldIgnoreEvent(event)) {
                return;
            }

            openLink(href, event);
        });

        element.addEventListener('keydown', (event) => {
            if (shouldIgnoreEvent(event)) {
                return;
            }

            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                openLink(href, event);
            }
        });
    });
};

const initPublicMobileHeader = () => {
    const toggles = Array.from(document.querySelectorAll('[data-mobile-menu-toggle]'));

    if (!toggles.length) {
        return;
    }

    const getPanel = (toggle) => {
        const targetId = toggle.getAttribute('aria-controls');
        if (!targetId) {
            return null;
        }

        return document.getElementById(targetId);
    };

    const closeMenu = (toggle, panel) => {
        toggle.setAttribute('aria-expanded', 'false');
        panel?.classList.remove('open');
        panel?.setAttribute('aria-hidden', 'true');
    };

    const closeAllMenus = () => {
        toggles.forEach((toggle) => {
            const panel = getPanel(toggle);
            if (!panel) {
                return;
            }

            closeMenu(toggle, panel);
        });

        document.body.classList.remove('mobile-nav-open');
    };

    toggles.forEach((toggle) => {
        const panel = getPanel(toggle);
        if (!panel) {
            return;
        }

        const openMenu = () => {
            closeAllMenus();
            toggle.setAttribute('aria-expanded', 'true');
            panel.classList.add('open');
            panel.setAttribute('aria-hidden', 'false');
            document.body.classList.add('mobile-nav-open');
        };

        toggle.addEventListener('click', () => {
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
            if (isExpanded) {
                closeAllMenus();
            } else {
                openMenu();
            }
        });

        panel.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', closeAllMenus);
        });
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            closeAllMenus();
        }
    });
};

const initFrontend = () => {
    initRowNavigation();
    initPublicMobileHeader();
};

document.addEventListener('DOMContentLoaded', initFrontend);

