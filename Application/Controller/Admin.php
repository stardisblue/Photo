<?php

use Rave\Core\Controller;
use Rave\Library\Core\IO\In;
use Rave\Application\Model\AdminModel;
use Rave\Library\Core\Security\String;
use Rave\Library\Core\Security\Session;

class Admin extends Controller
{
    
    public function __construct()
    {
        $this->setLayout('admin');
    }
    
    public function index()
    {
        if (Session::check('admin')) {
            $this->redirect('admin/manage');
        } else {
            $this->redirect('admin/login');
        }
    }
    
    public function login()
    {
        if (In::isSetPost(['login', 'password']) && AdminModel::count(In::post('login')) > 0) {
            $admin = AdminModel::select(In::post('login'));
                
            if (String::hash(In::post('password')) === $admin->password) {
                Session::login('admin');
                $this->redirect('admin');
            } else {
                $this->redirect('admin/wrong-password');
            }
        } else {
            $this->loadView('loginForm');
        }
    }
    
    public function manage()
    {
        if (Session::check('admin')) {
            echo 'lelo';
        } else {
            $this->redirect('admin');
        }
    }
    
    public function wrong_password()
    {
        $this->loadView('wrongPassword');
    }

}
