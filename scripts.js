document.addEventListener('DOMContentLoaded', () => {

const forms = document.querySelectorAll('form');
forms.forEach(form => {
form.addEventListener('submit', (event) => {
if (!validateForm(form)) {
event.preventDefault();
alert('Please fill in all required fields correctly.');
}
});
 });

 
const forgotPasswordForm = document.querySelector('.forgot-password-form');
if (forgotPasswordForm) {
 forgotPasswordForm.addEventListener('submit', (event) => {
event.preventDefault();
 const id = document.getElementById('id').value;
 const email = document.getElementById('email').value;
 resetPassword(id, email).then(response => {
 alert(response.message);
}).catch(error => {
                alert('Error: ' + error.message);
});
 });
}
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


function resetPassword(id, email) {
return new Promise((resolve, reject) => {
 setTimeout(() => {
if (id && email) {
 resolve({ message: 'Password reset link sent to your email.' });
} else {
reject({ message: 'Invalid ID or Email.' });
}
}, 1000);
 });
}


document.querySelectorAll('nav a').forEach(link => {
    link.addEventListener('click', (event) => {
        console.log(`Navigating to ${event.target.textContent}`);
    });
});
