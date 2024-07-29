document.addEventListener('DOMContentLoaded', (event) => {
    const stars = document.querySelectorAll('.star');
    let currentRating = 0;

    stars.forEach(star => {
        star.addEventListener('mouseover', () => {
            resetStars();
            fillStars(star.dataset.value);
        });

        star.addEventListener('click', () => {
            currentRating = star.dataset.value;
            document.getElementById('ratingValue').value = currentRating;
        });
    });

    document.querySelector('.star-rating').addEventListener('mouseleave', () => {
        resetStars();
        if (currentRating > 0) {
            fillStars(currentRating);
        }
    });

    function resetStars() {
        stars.forEach(star => {
            star.innerHTML = '&#9734;'; // empty star
        });
    }

    function fillStars(rating) {
        for (let i = 0; i < rating; i++) {
            stars[i].innerHTML = '&#9733;'; // filled star
        }
    }
});