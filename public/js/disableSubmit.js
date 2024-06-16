document.addEventListener('DOMContentLoaded', function() {
    const submitButtons = document.querySelectorAll('input[type="submit"], button[type="submit"]');
    const linkSubmit = document.getElementById('event-submit');

    submitButtons.forEach(submitButton => {
        submitButton.addEventListener('click', function(event) {
            const form = event.target.closest('form');
            if (!form.checkValidity()) {
                form.reportValidity(); // Exibir mensagens de validação
                event.preventDefault();
                return;
            }
            submitButton.disabled = true;
            form.submit();
        });
    });

    if (linkSubmit) {
        linkSubmit.addEventListener('click', function(event) {
            const form = event.target.closest('form');
            if (!form.checkValidity()) {
                form.reportValidity(); // Exibir mensagens de validação
                event.preventDefault();
                return;
            }
            linkSubmit.classList.add('disabled');
            event.preventDefault();
            form.submit();
        });
    }
});
