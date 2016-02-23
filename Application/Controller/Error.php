<?php

namespace Rave\Application\Controller;

use Rave\Core\Controller;

class Error extends Controller
{

    public function __construct()
    {
        $this->setLayout('main');
        $this->setI18n(true);
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