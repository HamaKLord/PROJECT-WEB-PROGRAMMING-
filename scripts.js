




document.addEventListener('DOMContentLoaded', () => {
    // Form validation for all forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', (event) => {
            if (!validateForm(form)) {
                event.preventDefault();
                alert('Please fill in all required fields correctly.');
            }
        });
    });
});






function validateForm(form) {
    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('error');
        } else {
            field.classList.remove('error');
        }
    });
    return isValid;
}
