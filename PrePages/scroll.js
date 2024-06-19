// Initialize ScrollReveal
ScrollReveal().reveal('.slogan img', { delay: 200, origin: 'left', distance: '30px', duration: 1000 });

// Initialize ScrollReveal for the typing effect
ScrollReveal().reveal('#typed-output', {
    delay: 400,
    origin: 'left',
    distance: '50px',
    duration: 1000,
    afterReveal: function () {
        // Initialize Typed.js after reveal
        new Typed('#typed-output', {
            strings: ["BRIDGE THE GAP,<br /><span>CONNECT</span> WITH <br /> TRADEMASTERS!"],
            typeSpeed: 50,
            startDelay: 400,
            showCursor: false,
            onComplete: function () {
                document.querySelector('#typed-output').innerHTML = "BRIDGE THE GAP,<br /><span>CONNECT</span> WITH <br /> TRADEMASTERS!";
            }
        });
    }
});