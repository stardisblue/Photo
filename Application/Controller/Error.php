<?php

use Rave\Core\Controller;

class Error extends Controller
{
    
    public function __construct()
    {
        $this->setLayout('main');
    }

    public function internal_server_error()
    {
        $this->loadView('internal_server_error');
    }
    
    public function not_found()
    {
        $this->loadView('not_found');
    }
    
    public function forbidden()
    {
        $this->loadView('forbidden');
    }

}