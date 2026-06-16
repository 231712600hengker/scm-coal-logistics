const pageLoader = document.getElementById('page-loading');

const showPageLoader = () => {
    if (pageLoader) {
        pageLoader.classList.add('is-visible');
    }
};

const hidePageLoader = () => {
    if (pageLoader) {
        pageLoader.classList.remove('is-visible');
    }
};

document.addEventListener('click', (event) => {
    const link = event.target.closest('a[href]');

    if (!link) {
        return;
    }

    const href = link.getAttribute('href');
    const target = link.getAttribute('target');

    if (!href || href.startsWith('#') || href.startsWith('javascript:') || target === '_blank') {
        return;
    }

    showPageLoader();
});

document.addEventListener('submit', (event) => {
    const form = event.target;

    if (form && !form.hasAttribute('data-no-loading')) {
        showPageLoader();
    }
});

window.addEventListener('pageshow', hidePageLoader);
window.addEventListener('beforeprint', hidePageLoader);
