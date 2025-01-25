document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            const targetPosition = targetElement.offsetTop;
            const startPosition = window.pageYOffset;
            const distance = targetPosition - startPosition;
            const duration = 10000; // Tempo em milissegundos (1 segundo)
            let start = null;

            function animationScroll(currentTime) {
                if (start === null) start = currentTime;
                const timeElapsed = currentTime - start;

                const run = ease(timeElapsed, startPosition, distance, duration);
                window.scrollTo(0, run);

                if (timeElapsed < duration) requestAnimationFrame(animationScroll);
            }

            function ease(t, b, c, d) {
                // Função de easing "easeInOutQuad" para suavizar o movimento
                t /= d / 2;
                if (t < 1) return (c / 2) * t * t + b;
                t--;
                return (-c / 2) * (t * (t - 2) - 1) + b;
            }

            requestAnimationFrame(animationScroll);
        }
    });
});
