'use strict';

document.addEventListener('DOMContentLoaded', function () {
    var searchForm = document.querySelector('.header-search');

    if (!searchForm) {
        return;
    }

    var searchField = searchForm.querySelector('.header-search__field');
    var searchButton = searchForm.querySelector('.search-button');

    if (!searchField || !searchButton) {
        return;
    }

    function openSearch() {
        searchForm.classList.add('is-open');
        searchButton.setAttribute('aria-expanded', 'true');
        window.requestAnimationFrame(function () {
            searchField.focus();
        });
    }

    function closeSearch() {
        searchForm.classList.remove('is-open');
        searchButton.setAttribute('aria-expanded', 'false');
    }

    searchButton.addEventListener('click', function (event) {
        if (!searchForm.classList.contains('is-open') && searchField.value.trim() === '') {
            event.preventDefault();
            openSearch();
        }
    });

    searchForm.addEventListener('submit', function (event) {
        if (searchField.value.trim() === '') {
            event.preventDefault();
            openSearch();
        }
    });

    searchField.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            searchField.value = '';
            closeSearch();
            searchButton.focus();
        }
    });

    document.addEventListener('click', function (event) {
        if (!searchForm.contains(event.target) && searchField.value.trim() === '') {
            closeSearch();
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var nav = document.getElementById('primaryNavbar');

    if (!nav || typeof bootstrap === 'undefined') {
        return;
    }

    nav.addEventListener('click', function (event) {
        if (!event.target.closest('a')) {
            return;
        }

        var collapse = bootstrap.Collapse.getInstance(nav);

        if (collapse && window.matchMedia('(max-width: 767px)').matches) {
            collapse.hide();
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var loader = document.querySelector('.page-loader');

    if (!loader) {
        return;
    }

    function showLoader() {
        loader.classList.add('is-active');
        loader.setAttribute('aria-hidden', 'false');
    }

    function hideLoader() {
        loader.classList.remove('is-active');
        loader.setAttribute('aria-hidden', 'true');
    }

    document.addEventListener('click', function (event) {
        var link = event.target.closest('a[href]');

        if (!link) {
            return;
        }

        var href = link.getAttribute('href');
        var target = link.getAttribute('target');

        if (
            !href ||
            href.charAt(0) === '#' ||
            href.indexOf('mailto:') === 0 ||
            href.indexOf('tel:') === 0 ||
            target === '_blank' ||
            link.hasAttribute('download')
        ) {
            return;
        }

        var url = new URL(href, window.location.href);

        if (url.origin !== window.location.origin) {
            return;
        }

        showLoader();
    });

    document.addEventListener('submit', function (event) {
        if (event.target && event.target.matches('form')) {
            showLoader();
        }
    });

    if (document.readyState === 'interactive' || document.readyState === 'complete') {
        hideLoader();
    } else {
        document.addEventListener('DOMContentLoaded', hideLoader, { once: true });
        window.addEventListener('load', hideLoader);
    }

    window.setTimeout(hideLoader, 2500);
    window.addEventListener('pageshow', hideLoader);
    window.addEventListener('pagehide', hideLoader);

    if (typeof window.bharathbyteHideLoader === 'function') {
        window.bharathbyteHideLoader();
    }
});

document.addEventListener('DOMContentLoaded', function () {
    var tocLinks = Array.prototype.slice.call(document.querySelectorAll('.article-toc a[href^="#"]'));

    if (tocLinks.length === 0) {
        return;
    }

    var sections = tocLinks
        .map(function (link) {
            var id = link.getAttribute('href').slice(1);
            var target = document.getElementById(id);

            return target ? { link: link, target: target } : null;
        })
        .filter(Boolean);

    if (sections.length === 0) {
        return;
    }

    function setActiveTocLink() {
        var active = sections[0];
        var offset = 120;

        sections.forEach(function (section) {
            if (section.target.getBoundingClientRect().top <= offset) {
                active = section;
            }
        });

        tocLinks.forEach(function (link) {
            link.classList.remove('is-active');
        });

        active.link.classList.add('is-active');
    }

    setActiveTocLink();
    window.addEventListener('scroll', setActiveTocLink, { passive: true });
});
