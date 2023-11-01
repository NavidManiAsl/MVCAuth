<?php
session_start();

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
 * Save a key value pair in session.
 * @param string $name
 * @param string $value
 * @return void
 */
function setSession($name, $value) 
{
    try {
        $_SESSION[$name] = $value;
    } catch (\Throwable $th) {
        
    }
}

/**
 * Return a value from the session if its exist.
 * @param string $name
 * @return string|null
 */
function getSession($name) 
{
    return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
}

/**
 * Clear a key value pair from the session
 * @param string $name
 * @return void
 */
function clearSession($name)
{
    unset($_SESSION[$name]);
}