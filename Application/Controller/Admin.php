<?php

use Rave\Core\Error;
use Rave\Core\Controller;

use Rave\Library\Core\IO\In;

use Rave\Application\Model\AdminModel;
use Rave\Application\Model\PhotoModel;
use Rave\Application\Model\CommentModel;

use Rave\Library\Core\Security\File;
use Rave\Library\Core\Security\String;
use Rave\Library\Core\Security\Session;


class Admin extends Controller
{
    const DEFAULT_IMAGE_NAME = 'error';

    public function __construct()
    {
        $this->setLayout('admin', ['loggedIn' => Session::check('admin')]);
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
        if (In::isSetPost(['login', 'password'])) {
            if (AdminModel::exists(In::post('login'))) {
                $admin = AdminModel::select(In::post('login'));

                if (String::hash(In::post('password')) === $admin->password) {
                    Session::login('admin');
                    Session::set('login', $admin->login);

                    $this->redirect('admin/manage');
                } else {
                    $this->redirect('admin/wrong-password');
                }
            } else {
                $this->redirect('admin/wrong-login');
            }
        } else {
            $this->loadView('loginForm');
        }
    }

    public function logout()
    {
        if (Session::check('admin')) {
            Session::delete('admin');
            $this->redirect('admin/logout-success');
        } else {
            $this->redirect('admin/logout-error');
        }
    }
    
    public function manage()
    {
        if (Session::check('admin')) {
            $this->loadView('manage', ['manage' => true]);
        } else {
            $this->redirect('admin');
        }
    }

    public function account()
    {
        $login = Session::get('login');

        if (Session::check('admin')) {
            if (In::isSetPost('login')) {
                AdminModel::update($login, ['login' => In::post('login')]);
                $this->redirect('admin');
            } else {
                $this->loadView('account', ['login' => $login]);
            }
        } else {
            $this->redirect('admin');
        }
    }

    public function add_photo()
    {
        if (Session::check('admin')) {
            if (In::isSetPost(['title', 'description'])) {
                $fileName = self::DEFAULT_IMAGE_NAME;

                try {
                    $fileName = File::moveUploadedFile('photo', 'public/photo', ['.jpg', '.png']);
                } catch (Exception $exception) {
                    Error::create($exception->getMessage(), '500');
                }

                PhotoModel::insert([
                    'name' => $fileName,
                    'title' => In::post('title'),
                    'description' => In::post('description')
                ]);

                $this->redirect('admin');
            } else {
                $this->loadView('addPhoto');
            }
        } else {
            $this->redirect('admin');
        }
    }

    public function manage_photo()
    {
        if (Session::check('admin')) {
            $photos = PhotoModel::selectAll();
            $this->loadView('managePhoto', ['photos' => $photos]);
        } else {
            $this->redirect('admin');
        }
    }

    public function manage_comment()
    {
        if (Session::check('admin')) {
            $comments = CommentModel::selectAll();
            $this->loadView('manageComment', ['comments' => $comments]);
        } else {
            $this->redirect('admin');
        }
    }

    public function wrong_login()
    {
        $this->loadView('wrongLogin');
    }

    public function wrong_password()
    {
        $this->loadView('wrongPassword');
    }

    public function logout_success()
    {
        $this->loadView('logoutSuccess');
    }

    public function logout_error()
    {
        $this->loadView('logoutError');
    }

}