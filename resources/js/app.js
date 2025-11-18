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

document.addEventListener('DOMContentLoaded', initRowNavigation);

