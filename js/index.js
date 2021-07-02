function showPassword() {
    const eye = document.getElementById('eye');
    const eyeSlash = document.getElementById('eye-slash');
    const fieldPassword = document.getElementById('field-password');
    if (eye.style.display === 'none') {
        eye.style.display = 'block';
        eyeSlash.style.display = 'none';
        fieldPassword.type = 'text';
    } else {
        eye.style.display = 'none';
        eyeSlash.style.display = 'block';
        fieldPassword.type = 'password';
    }
};

document.getElementById('btn-login').addEventListener('click', function(e) {
    e.preventDefault();
    const userCheck = document.querySelector('input').value;
    const fieldPassword = document.getElementById('field-password').value;
    if (userCheck === "dw@vemcogroup.com.br", fieldPassword === "123") {
        window.location.href = "./ticket.php";
    } else {
        alert('Dados incorretos ou vazios');
    }

});

document.getElementById('btn-new').addEventListener('click', function() {
    window.location.href = "www.yoursite.com";
});