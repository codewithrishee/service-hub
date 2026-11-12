/* ============================================================
   SERVICEHUB — HEADER
   Mobile off-canvas navigation controller
   - Left-side off-canvas (opened by right-side hamburger)
   - Backdrop with fade
   - Body scroll lock
   - ESC / backdrop / link click to close
   - Resize safety
   - Accessibility (aria-expanded, aria-hidden, focus)
   ============================================================ */

(function () {
    'use strict';

    function ready(fn) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', fn);
        } else {
            fn();
        }
    }

    ready(function () {
        var toggleBtn   = document.getElementById('shMenuToggle');
        var closeBtn    = document.getElementById('shMobileClose');
        var menu        = document.getElementById('shMobileMenu');
        var backdrop    = document.getElementById('shMobileBackdrop');

        if (!toggleBtn || !menu || !backdrop) return;

        var navLinks = menu.querySelectorAll('.sh-mobile-link, .sh-mobile-login, .sh-mobile-cta');

        var isOpen = false;
        var lastFocused = null;

        // ---------- Open ----------
        function openMenu() {
            if (isOpen) return;
            isOpen = true;

            lastFocused = document.activeElement;

            // Reveal backdrop (remove [hidden] first so transition can run)
            backdrop.hidden = false;
            // force reflow so transition applies
            // eslint-disable-next-line no-unused-expressions
            backdrop.offsetHeight;

            backdrop.classList.add('is-visible');
            menu.classList.add('is-open');
            menu.setAttribute('aria-hidden', 'false');

            toggleBtn.setAttribute('aria-expanded', 'true');
            toggleBtn.setAttribute('aria-label', 'Close navigation menu');

            document.body.classList.add('sh-menu-open');

            // Focus management — move focus into the panel
            // Defer so the transition doesn't steal focus
            setTimeout(function () {
                if (closeBtn) {
                    closeBtn.focus({ preventScroll: true });
                } else {
                    menu.focus({ preventScroll: true });
                }
            }, 60);
        }

        // ---------- Close ----------
        function closeMenu() {
            if (!isOpen) return;
            isOpen = false;

            menu.classList.remove('is-open');
            menu.setAttribute('aria-hidden', 'true');
            backdrop.classList.remove('is-visible');

            toggleBtn.setAttribute('aria-expanded', 'false');
            toggleBtn.setAttribute('aria-label', 'Open navigation menu');

            document.body.classList.remove('sh-menu-open');

            // Hide backdrop after transition to prevent intercepting clicks
            var hideDelay = prefersReducedMotion() ? 0 : 320;
            setTimeout(function () {
                if (!isOpen) {
                    backdrop.hidden = true;
                }
            }, hideDelay);

            // Restore focus to the trigger
            if (lastFocused && typeof lastFocused.focus === 'function') {
                lastFocused.focus({ preventScroll: true });
            } else {
                toggleBtn.focus({ preventScroll: true });
            }
        }

        function toggleMenu() {
            if (isOpen) closeMenu();
            else openMenu();
        }

        // ---------- Listeners ----------
        toggleBtn.addEventListener('click', function (e) {
            e.preventDefault();
            toggleMenu();
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', function (e) {
                e.preventDefault();
                closeMenu();
            });
        }

        backdrop.addEventListener('click', function () {
            closeMenu();
        });

        // Close when a nav link is clicked (allow navigation to proceed)
        navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                // small delay so the click registers & link navigation kicks in
                closeMenu();
            });
        });

        // ESC to close
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && isOpen) {
                closeMenu();
            }
        });

        // Focus trap — keep Tab navigation inside the panel
        menu.addEventListener('keydown', function (e) {
            if (e.key !== 'Tab' || !isOpen) return;

            var focusables = menu.querySelectorAll(
                'a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])'
            );
            if (!focusables.length) return;

            var first = focusables[0];
            var last  = focusables[focusables.length - 1];

            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        });

        // Resize safety — auto close on desktop
        var resizeTimer;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                if (window.innerWidth >= 992 && isOpen) {
                    closeMenu();
                }
            }, 120);
        });

        // Utility
        function prefersReducedMotion() {
            return window.matchMedia &&
                window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        }
    });
})();