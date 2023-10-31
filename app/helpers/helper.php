<?php

/** 
 * Rediret to a certain page
 * @return void
 */
function rediret($page)
{
    header('location:' . URI . $page);
}