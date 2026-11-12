/* ==========================================================================
   ServiceHub — Auth JS
   File: public/js/auth.js
   Shared by login + register. Handles:
     - Password visibility toggles ([data-password-toggle])
     - Password strength meter (register page only)
     - Submit loading state (prevents accidental double submit)
   Idempotent and safe for shared auth pages.
   ========================================================================== */

(function () {
    'use strict';

    /* ------------------------------------------------------------------
       Password visibility toggle
       Event delegation on [data-password-toggle="<inputId>"].
       ------------------------------------------------------------------ */
    function initPasswordToggles() {
        if (document.__shAuthToggleBound) {
            return;
        }
        document.__shAuthToggleBound = true;

        document.addEventListener('click', function (event) {
            var trigger = event.target.closest('[data-password-toggle]');
            if (!trigger) {
                return;
            }

            var inputId = trigger.getAttribute('data-password-toggle');
            if (!inputId) {
                return;
            }

            var input = document.getElementById(inputId);
            if (!input) {
                return;
            }

            event.preventDefault();

            var isVisible = input.getAttribute('type') === 'text';
            input.setAttribute('type', isVisible ? 'password' : 'text');

            trigger.setAttribute('aria-pressed', isVisible ? 'false' : 'true');
            trigger.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');

            var icon = trigger.querySelector('i');
            if (icon) {
                icon.classList.toggle('bi-eye', isVisible);
                icon.classList.toggle('bi-eye-slash', !isVisible);
            }

            input.focus({ preventScroll: true });

            try {
                var val = input.value;
                input.setSelectionRange(val.length, val.length);
            } catch (e) { /* no-op */ }
        });
    }

    /* ------------------------------------------------------------------
       Password strength (register page)
       Scores 0–3 based on length + character variety.
       Matches auth.css: [data-strength="1|2|3"]
       ------------------------------------------------------------------ */
    function scorePassword(value) {
        if (!value) {
            return 0;
        }

        var hasLower = /[a-z]/.test(value);
        var hasUpper = /[A-Z]/.test(value);
        var hasDigit = /[0-9]/.test(value);
        var hasSymbol = /[^A-Za-z0-9]/.test(value);
        var variety = [hasLower, hasUpper, hasDigit, hasSymbol].filter(Boolean).length;

        if (value.length >= 8) {
            if (value.length >= 12 && variety >= 3) {
                return 3;
            }
            if (value.length >= 10 && variety >= 3) {
                return 2;
            }
            return 1;
        }

        return value.length > 0 ? 1 : 0;
    }

    function initPasswordStrength() {
        var password = document.getElementById('password');
        if (!password) {
            return;
        }

        var meter = document.querySelector('.auth-strength');
        if (!meter) {
            return;
        }

        var label = meter.querySelector('.auth-strength-label');
        var labels = ['', 'Weak', 'Good', 'Strong'];

        function update() {
            var score = scorePassword(password.value);

            if (score === 0) {
                meter.removeAttribute('data-strength');
                if (label) {
                    label.textContent = '';
                }
                return;
            }

            meter.setAttribute('data-strength', String(score));
            if (label) {
                label.textContent = labels[score] || '';
            }
        }

        password.addEventListener('input', update);
        update();
    }

    /* ------------------------------------------------------------------
       Submit loading state
       Prevents double submission while respecting native validation.
       Restores state on browser back/forward (pageshow).
       ------------------------------------------------------------------ */
    function initSubmitLoading() {
        var forms = document.querySelectorAll(
            'form#servicehub-login-form, form#servicehub-register-form'
        );

        forms.forEach(function (form) {
            if (form.__shSubmitBound) {
                return;
            }
            form.__shSubmitBound = true;

            var defaultLabel = null;

            form.addEventListener('submit', function (event) {
                if (typeof form.checkValidity === 'function' && !form.checkValidity()) {
                    return;
                }

                var submitBtn = form.querySelector('button[type="submit"]');
                if (!submitBtn) {
                    return;
                }

                if (submitBtn.disabled) {
                    event.preventDefault();
                    return;
                }

                submitBtn.disabled = true;

                var label = submitBtn.querySelector('.btn-label');
                if (label && defaultLabel === null) {
                    defaultLabel = label.textContent;
                }
                if (label) {
                    label.textContent = 'Please wait…';
                }
            });

            window.addEventListener('pageshow', function () {
                var submitBtn = form.querySelector('button[type="submit"]');
                if (!submitBtn) {
                    return;
                }

                submitBtn.disabled = false;

                var label = submitBtn.querySelector('.btn-label');
                if (label && defaultLabel !== null) {
                    label.textContent = defaultLabel;
                }
            });
        });
    }

    /* ------------------------------------------------------------------
       Init
       ------------------------------------------------------------------ */
    function init() {
        initPasswordToggles();
        initPasswordStrength();
        initSubmitLoading();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();