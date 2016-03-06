<?php

namespace rave\app\controller;

use rave\app\model\GalleryModel;
use rave\lib\custom\Cron;

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
