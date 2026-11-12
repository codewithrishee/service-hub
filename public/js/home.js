(function () {
    'use strict';

    function initCarousel(root) {
        var track = root.querySelector('.carousel-track');
        var name = root.dataset.carousel;
        var prevBtn = document.querySelector('[data-carousel-prev="' + name + '"]');
        var nextBtn = document.querySelector('[data-carousel-next="' + name + '"]');
        var dotsWrap = document.querySelector('[data-carousel-dots="' + name + '"]');
        var slides = track ? track.querySelectorAll('.carousel-slide') : [];
        if (!track || !slides.length) return;

        var autoplayDelay = parseInt(root.dataset.carouselAutoplay, 10) || 0;
        var autoplayTimer = null;
        var isHovering = false;
        var reduceMotionMQ = window.matchMedia('(prefers-reduced-motion: reduce)');

        function gapPx() {
            var g = parseFloat(window.getComputedStyle(track).gap);
            return isNaN(g) ? 0 : g;
        }

        function slideStep() {
            if (!slides[0]) return 0;
            return slides[0].getBoundingClientRect().width + gapPx();
        }

        // BUG FIX: floor (was round) — stops page miscount
        function visibleCount() {
            var step = slideStep();
            if (!step) return 1;
            return Math.max(1, Math.floor((track.clientWidth + gapPx()) / step));
        }

        function totalPages() {
            return Math.max(1, Math.ceil(slides.length / visibleCount()));
        }

        function currentPage() {
            var step = slideStep();
            if (!step) return 0;
            var perPage = visibleCount();
            return Math.round(track.scrollLeft / (step * perPage));
        }

        function goToPage(page) {
            var step = slideStep();
            var pages = totalPages();
            page = Math.max(0, Math.min(page, pages - 1));
            var target = page * step * visibleCount();
            track.scrollTo({
                left: target,
                behavior: reduceMotionMQ.matches ? 'auto' : 'smooth'
            });
        }

        // BUG FIX: page-based nav instead of maxScroll−4 (was broken on mobile)
        function scrollByOne(dir) {
            var page = currentPage();
            var pages = totalPages();
            var target;
            if (dir > 0) {
                target = page >= pages - 1 ? 0 : page + 1;
            } else {
                target = page <= 0 ? pages - 1 : page - 1;
            }
            goToPage(target);
        }

        function buildDots() {
            if (!dotsWrap) return;
            dotsWrap.innerHTML = '';
            var pages = totalPages();
            for (var i = 0; i < pages; i++) {
                var dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'carousel-dot';
                dot.setAttribute('role', 'tab');
                // BUG FIX: "page" not "slide" (dots control pages)
                dot.setAttribute('aria-label', 'Go to page ' + (i + 1));
                dot.dataset.page = i;
                dot.addEventListener('click', function (e) {
                    e.preventDefault();
                    goToPage(parseInt(this.dataset.page, 10));
                    restartAutoplay();
                });
                dotsWrap.appendChild(dot);
            }
            updateDots();
        }

        function updateDots() {
            if (!dotsWrap) return;
            var page = currentPage();
            var dots = dotsWrap.querySelectorAll('.carousel-dot');
            dots.forEach(function (dot, idx) {
                dot.classList.toggle('active', idx === page);
                dot.setAttribute('aria-selected', idx === page ? 'true' : 'false');
            });
        }

        // BUG FIX: disable instead of hide — keyboard users stay safe
        function updateNavState() {
            var single = totalPages() <= 1;
            [prevBtn, nextBtn].forEach(function (b) {
                if (!b) return;
                b.disabled = single;
                b.setAttribute('aria-hidden', single ? 'true' : 'false');
            });
        }

        if (prevBtn) prevBtn.addEventListener('click', function () {
            scrollByOne(-1);
            restartAutoplay();
        });
        if (nextBtn) nextBtn.addEventListener('click', function () {
            scrollByOne(1);
            restartAutoplay();
        });

        var scrollUpdate;
        track.addEventListener('scroll', function () {
            if (scrollUpdate) cancelAnimationFrame(scrollUpdate);
            scrollUpdate = requestAnimationFrame(updateDots);
        }, { passive: true });

        // Keyboard
        track.setAttribute('tabindex', '0');
        track.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowRight') {
                e.preventDefault();
                scrollByOne(1);
            } else if (e.key === 'ArrowLeft') {
                e.preventDefault();
                scrollByOne(-1);
            }
        });

        function startAutoplay() {
            if (!autoplayDelay || reduceMotionMQ.matches) return;
            stopAutoplay();
            autoplayTimer = setInterval(function () {
                if (isHovering || document.hidden) return;
                scrollByOne(1);
            }, autoplayDelay);
        }

        function stopAutoplay() {
            if (autoplayTimer) {
                clearInterval(autoplayTimer);
                autoplayTimer = null;
            }
        }

        function restartAutoplay() {
            if (!autoplayDelay) return;
            stopAutoplay();
            startAutoplay();
        }

        root.addEventListener('mouseenter', function () { isHovering = true; });
        root.addEventListener('mouseleave', function () { isHovering = false; });
        root.addEventListener('focusin', function () { isHovering = true; });
        root.addEventListener('focusout', function () { isHovering = false; });

        // BUG FIX: react to reduced-motion toggle live
        if (reduceMotionMQ.addEventListener) {
            reduceMotionMQ.addEventListener('change', function () {
                if (reduceMotionMQ.matches) stopAutoplay();
                else startAutoplay();
            });
        }

        var resizeTimer;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                buildDots();
                updateNavState();
            }, 150);
        });

        buildDots();
        updateNavState();
        startAutoplay();
    }

    function init() {
        var carousels = document.querySelectorAll('.servicehub-home [data-carousel]');
        carousels.forEach(initCarousel);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();