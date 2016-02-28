<?php

namespace Rave\Application\Controller;

use Rave\Application\Model\GalleryModel;
use Rave\Library\Custom\Cron;

class Main extends FrontController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->loadView('slider', ['photos' => GalleryModel::selectPhoto()]);

        Cron::execute();
    }

}
