<?php

namespace Rave\Application\Controller;

use Rave\Application\Model\GalleryModel;
use Rave\Core\Controller;
use Rave\Library\Custom\Cron;

class Main extends Controller
{

    public function __construct()
    {
        $this->setLayout('main');
        $this->setI18n(true);
    }

    public function index()
    {
        $this->loadView('slider', ['photos' => GalleryModel::selectPhoto()]);

        Cron::execute();
    }

}
