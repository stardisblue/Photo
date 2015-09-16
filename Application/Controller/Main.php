<?php

namespace Rave\Application\Controller;

use Rave\Core\Controller;
use Rave\Library\Custom\Cron;
use Rave\Application\Model\PhotoModel;

class Main extends Controller
{

    public function __construct()
    {
        $this->setLayout('main');
    }

    public function index()
    {
	    $this->loadView('slider', ['photos' => PhotoModel::selectAll()]);

        Cron::execute();
    }

}
