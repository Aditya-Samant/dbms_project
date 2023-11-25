document.addEventListener("DOMContentLoaded", function () {
    var message = REPLACE_WITH_PHP_MESSAGE;
    
    if (message) {
        alert(message);
        setTimeout(function() { window.location.href = window.location.href; }, 1000);
    }
});
