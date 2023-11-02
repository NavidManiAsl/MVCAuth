<?php


/** 
 * Rediret to a certain page
 * @param string $page
 * @return void
 */
function redirect($page)
{
    header('location:' . URI . $page);
}

/**
 * displays a flash message.
 * @param string $name 
 * @param string|null $message
 * @return void;
 */
function flash($name, $message = null)
{
    if (!empty($name) && !empty($message)) {
        if (!empty($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }

        $_SESSION[$name] = $message;
    }

    if (!empty($_SESSION[$name]) && !empty($name) && empty($message)) {
        echo ('<div id="flash-msg">' . $_SESSION[$name] . '</div>');
        unset($_SESSION[$name]);
    }
}

/**
 * Add user info to the session after auth.
 * @param User
 * @return void
 */

function sessionUserAdd($user) 
{
    $_SESSION['user_id'] = $user->id; 
    $_SESSION['username'] = $user->username;
    $_SESSION['email'] = $user->email;
    
}

