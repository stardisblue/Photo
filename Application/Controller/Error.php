<?php

namespace Rave\Application\Controller;

class Error extends FrontController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function internalServerError()
    {
        $this->loadView('internal_server_error');
    }

    public function forbidden()
    {
        $this->loadView('forbidden');
    }

    public function notFound()
    {
        $this->loadView('not_found');
    }

}