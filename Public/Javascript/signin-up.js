
const form = document.getElementById('loginForm');
const submitBtn = document.getElementById('submitBtn');
const errorMessage = document.getElementById('error-message');

submitBtn.addEventListener('click', (event) => {
    event.preventDefault();

    const formData = new FormData(form);

    fetch('./Controller/login-controller.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())

    .then(data => {
        console.log(data);
        if (data.success) {
            console.log("si paso");
            if (data.type === 1) {
                window.location.href = '/DigitalLibrary/index.php';
            } else if (data.type === 0) {
                window.location.href = '/DigitalLibrary/admin.php?rute=books';
            }
           
        } else {
            errorMessage.textContent = data.message;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        errorMessage.textContent = "Error al iniciar sesión.";
    });
});