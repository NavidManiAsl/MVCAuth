<nav class="navbar_container">
<?php
if (empty($_SESSION['username'])): ?>   
    <a href="<?php echo URI . 'users/login'; ?>"><button class="register_button">Login</button></a>
    <a href="<?php echo URI . 'users/register'; ?>"><button class="register_button">Signin</button></a>
    
<?php else: ?>
    <div id="user_banner"><p id="user_banner_text"><?php echo ucfirst($_SESSION['username'][0]) ?></p></div>
    <p class="navbar_text"><?php echo ucfirst($_SESSION['username'])?></p>
    <a href="<?php echo URI . 'users/logout'; ?>"><button class="register_button">Logout</button></a>
<?php endif; ?>

</nav>