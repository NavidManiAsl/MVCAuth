<?php
require_once(APP_ROOT . "/views/partials/header.php");
?>
<div class="register_window">
    <h2 class="form_header">Register an account</h2>
    
    <div >
        <form action="<?php echo URI ?>/users/register" method="post" class="register_form">
            <input type="text" value="<?php echo $data['username']?>" placeholder="Username" name="username" class="<?php echo !empty($data['username_error']) ? "register_input_err" : "register_input" ?>">
            <span class="<?php echo !empty($data['username_error']) ? "register_span_err" : "register_span" ?>">
                <?php echo !empty($data['username_error']) ? $data['username_error'] : "" ?>
            </span>
            <input type="email" value="<?php echo $data['email']?>" placeholder="Email" name="email" class="<?php echo !empty($data['email_error']) ? "register_input_err" : "register_input" ?>">
            <span class="<?php echo !empty($data['email_error']) ? "register_span_err" : "register_span" ?>">
                <?php echo !empty($data['email_error']) ? $data['email_error'] : "" ?>
            </span>
            <input type="password" placeholder="Password" name="password" class="<?php echo !empty($data['password_error']) ? "register_input_err" : "register_input" ?>">
            <span class="<?php echo !empty($data['password_error']) ? "register_span_err" : "register_span" ?>">
                <?php echo !empty($data['password_error']) ? $data['password_error'] : "" ?>
            </span>
            <input type="password" placeholder="Re-enter password" name="password_confirmation" class="<?php echo !empty($data['password_confirmation_error']) ? "register_input_err" : "register_input" ?>" >
            <span class="<?php echo !empty($data['password_confirmation_error']) ? "register_span_err" : "register_span" ?>">
                <?php echo !empty($data['password_confirmation_error']) ? $data['password_confirmation_error'] : "" ?>
            </span>
            <button class="register_button">Register</button>
        </form>
        <hr>
        <a href="<?php echo URI .'users/login' ?>" class="form_link">Already have an account? Login!</a>
    </div>
</div>
<?php
require_once(APP_ROOT . "/views/partials/footer.php");
?> 