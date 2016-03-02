<?php
/**
 * Created by PhpStorm.
 * User: stardisblue
 * Date: 28/02/16
 * Time: 21:27
 */

namespace Rave\Application\Controller;

use Rave\Core\Controller;
use Rave\Library\Core\Security\Auth;

class FrontController extends Controller
{
    public function __construct()
    {
        $this->setLayout('main');
        $this->setI18n(true);
        $this->data['admin'] = Auth::check('admin');
    }
}