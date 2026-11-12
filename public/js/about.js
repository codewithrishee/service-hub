
(function () {
    var numbers = document.querySelectorAll('.servicehub-about-page .ab-number-value[data-count]');
    if (!numbers.length || !('IntersectionObserver' in window)) return;

    function animateNumber(el) {
        var target = parseInt(el.getAttribute('data-count'), 10) || 0;
        var suffix = el.querySelector('.ab-number-suffix');
        var suffixText = suffix ? suffix.outerHTML : '';
        var duration = 1400;
        var start = null;

        function step(timestamp) {
            if (!start) start = timestamp;
            var progress = Math.min((timestamp - start) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            var value = Math.round(target * eased);
            var display = value >= 1000
                ? value.toLocaleString('en-IN')
                : value;
            el.innerHTML = display + suffixText;
            if (progress < 1) requestAnimationFrame(step);
        }

        requestAnimationFrame(step);
    }

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                animateNumber(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.4 });

    numbers.forEach(function (el) { observer.observe(el); });
})();
