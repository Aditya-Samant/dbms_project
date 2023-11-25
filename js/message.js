document.addEventListener("DOMContentLoaded", function () {
    <?php
    if (isset($_SESSION['message'])) {
        echo "alert('{$_SESSION['message']}');";
        echo "setTimeout(function() { window.location.href = window.location.href; }, 1000);"; // Reload the page after 1 second
        unset($_SESSION['message']);
    }
    ?>
});
