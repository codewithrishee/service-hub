
document.addEventListener('DOMContentLoaded', function () {
    var mainImage = document.getElementById('galleryMainImage');
    var thumbs = document.querySelectorAll('.gallery-thumb');

    if (!mainImage || !thumbs.length) return;

    thumbs.forEach(function (thumb) {
        thumb.addEventListener('click', function () {
            // Active state
            thumbs.forEach(function (t) { t.classList.remove('active'); });
            thumb.classList.add('active');

            // Swap main image with a smooth fade
            var newSrc = thumb.getAttribute('data-img');
            if (!newSrc || newSrc === mainImage.src) return;

            mainImage.style.opacity = '0';
            setTimeout(function () {
                mainImage.src = newSrc;
                mainImage.style.opacity = '1';
            }, 180);
        });
    });
});
