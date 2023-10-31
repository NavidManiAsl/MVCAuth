<?php

/** 
 * Rediret to a certain page
 * @return void
 */
function redirect($page)
{
    header('location:' . URI . $page);
}