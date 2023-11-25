document.addEventListener("DOMContentLoaded", function () {
    var message = REPLACE_WITH_PHP_MESSAGE;

    if (message) {
        showToast(message);
        setTimeout(function () { window.location.href = window.location.href; }, 5000);
    }
});

function showToast(message) {
    var toastContainer = document.createElement('div');
    toastContainer.className = 'toast-container';

    var toastBox = document.createElement('div');
    toastBox.className = 'toast-box';
    toastBox.textContent = message;

    toastContainer.appendChild(toastBox);
    document.body.appendChild(toastContainer);

    setTimeout(function () {
        toastContainer.remove();
    }, 3000); // Remove the toast after 3 seconds
}
