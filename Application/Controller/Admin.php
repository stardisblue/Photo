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
        $this->check('admin/logout-error');
        Session::delete('admin');
        $this->redirect('admin/logout-success');
    }
    
    public function manage()
    {
        $this->check();
        $this->loadView('manage', ['manage' => true]);
    }

    public function account()
    {
        $this->check();

        $login = Session::get('login');

        if (In::isSetPost('login')) {
            if (In::isSetPost(['changePassword', 'oldPassword', 'newPassword'])) {
                $admin = AdminModel::select($login);

                if (String::hash(In::post('oldPassword')) === $admin->password) {
                    AdminModel::update($login, [
                        'login' => In::post('login'),
                        'password' => String::hash(In::post('newPassword'))
                    ]);
                    Session::set('login', In::post('login'));

                    $this->redirect('admin/modification-success');
                } else {
                    $this->redirect('admin/wrong-password');
                }
            } else {
                AdminModel::update($login, ['login' => In::post('login')]);
                Session::set('login', In::post('login'));
            }
            $this->redirect('admin/modification-success');
        } else {
            $this->loadView('account', ['login' => trim($login)]);
        }
    }

    public function add_photo()
    {
        $this->check();

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
    }

    public function manage_photo()
    {
        $this->check();
        $photos = PhotoModel::selectAll();
        $this->loadView('managePhoto', ['photos' => $photos]);
    }

    public function manage_comment()
    {
        $this->check();
        $comments = CommentModel::selectAll();
        $this->loadView('manageComment', ['comments' => $comments]);
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

    public function modification_success()
    {
        $this->loadView('modificationSuccess');
    }

    private function check($page = 'admin')
    {
        if (Session::check('admin') === false) {
            $this->redirect('admin');
        }
    }

}