<?php
require_once(APP_ROOT . "/views/partials/header.php");
?>
<div class="register_window">
    <h2 class="register_header">Login to your account</h2>
    
    <div >
        <form action="<?php echo URI ?>/users/register" method="post" class="register_form">
            <input type="email" placeholder="Email" name="email" class="<?php echo !empty($data['email_error']) ? "register_input_err" : "register_input" ?>">
            <span class="<?php echo !empty($data['email_error']) ? "register_span_err" : "register_span" ?>">
                <?php echo !empty($data['email_error']) ? $data['email_error'] : "" ?>
            </span>
            <input type="password" placeholder="Password" name="password" class="<?php echo !empty($data['password_error']) ? "register_input_err" : "register_input" ?>">
            <span class="<?php echo !empty($data['password_error']) ? "register_span_err" : "register_span" ?>">
                <?php echo !empty($data['password_error']) ? $data['password_error'] : "" ?>
            </span>
            <button class="register_button">Login</button>
        </form>
        <a href="<?php echo URI .'users/register' ?>">Do not have an account? Register!</a>
    </div>
</div>
<?php
require_once(APP_ROOT . "/views/partials/footer.php");
?> 