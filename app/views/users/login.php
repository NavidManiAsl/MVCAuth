<?php
require_once(APP_ROOT . "/views/partials/header.php");
?>
<div class="register_window">
    <?php flash('success');?>    
    <?php flash('login_failed');?>    
    <h2 class="form_header">Login to your account</h2>
    <div >
        <form action="<?php echo URI ?>/users/login" method="post" class="register_form">
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
        <hr>
        <a href="<?php echo URI .'users/register' ?>" class="form_link">Do not have an account? Register!</a>
    </div>
</div>
<?php
require_once(APP_ROOT . "/views/partials/footer.php");
?> 