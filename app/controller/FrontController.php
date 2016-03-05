<?php
/**
 * Created by PhpStorm.
 * User: stardisblue
 * Date: 28/02/16
 * Time: 21:27
 */

namespace rave\app\Controller;

use rave\core\Controller;
use rave\lib\core\security\Auth;

class FrontController extends Controller
{
    public function __construct()
    {
        $this->setLayout('main');
        $this->data['admin'] = Auth::check('admin');
    }
}