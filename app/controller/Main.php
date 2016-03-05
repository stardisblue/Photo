<?php

namespace rave\app\controller;

use rave\core\Controller;

class Main extends Controller
{

    public function __construct()
    {

        $this->setLayout('main');
    }

    public function index()
    {
        $this->loadView('slider');
    }

}
