<?php
$errorPage = true;
require_once(APP_ROOT . '/views/partials/header.php');
?>
<div class="error_container">
    <h1 class="error_code">500</h1>
    <p class="error_message">Server error!</p>
    <a href="<?php echo URI . 'users/index' ?>" class="error_link">
        Back to the main page
        <img src="<?php echo URI . '/../public/images/back-arrow.svg' ?>" class="error_arrow">
    </a>
</div>

<?php
require_once(APP_ROOT . '/views/partials/footer.php');
?>