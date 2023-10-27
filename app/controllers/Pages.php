<?php

use app\libraries\Controller;

class Pages extends Controller
{

    public function index()
    {
       
        $this->view('pages.index');
    }


}

