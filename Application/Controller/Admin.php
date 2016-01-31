<?php

namespace Rave\Application\Controller;

use Exception;

use Rave\Core\Error;
use Rave\Core\Controller;

use Rave\Library\Core\IO\In;
use Rave\Library\Core\IO\Out;
use Rave\Library\Core\IO\File;
use Rave\Library\Core\Security\Auth;
use Rave\Library\Core\Security\Password;

use Rave\Library\Custom\Photo;

use Rave\Application\Model\TagModel;
use Rave\Application\Model\AdminModel;
use Rave\Application\Model\PhotoModel;
use Rave\Application\Model\CommentModel;
use Rave\Application\Model\IdentifyModel;

class Admin extends Controller
{
    const DEFAULT_IMAGE_NAME = 'error';

    public function __construct()
    {
        $this->setLayout('admin', ['loggedIn' => Auth::check('admin')]);
    }
    
    public function index()
    {
        if (Auth::check('admin')) {
            $this->redirect('admin-manage');
        }

        $this->redirect('admin-login');
    }
    
    public function login()
    {
        if (!In::isSetPost('login', 'password')) {
            $this->loadView('login_form');
            exit;
        }

        if (!AdminModel::exists(In::post('login'))) {
            $this->redirect('admin-wrong-login');
        }

        $admin = AdminModel::select(In::post('login'));

        if (!Password::verify(In::post('password'), $admin->admin_password)) {
            $this->redirect('admin-wrong-password');
        }

        Auth::login('admin');
        Out::session('login', $admin->admin_login);

        $this->redirect('admin-manage');
    }

    public function logout()
    {
        $this->check();
        Out::unsetSession('admin');
        $this->redirect('admin-logout-success');
    }
    
    public function manage()
    {
        $this->check();
        $this->loadView('manage', ['manage' => true]);
    }

    public function account()
    {
        $this->check();

        $login = In::session('login');

        if (!In::isSetPost('login')) {
            $this->loadView('account', ['login' => trim($login)]);
            exit;
        }

        if (In::isSetPost('changePassword', 'oldPassword', 'newPassword')) {
            $admin = AdminModel::select($login);

            if (Password::verify(In::post('oldPassword'), $admin->admin_password)) {
                AdminModel::update($login, [
                    'admin_login' => In::post('login'),
                    'admin_password' => Password::hash(In::post('newPassword'))
                ]);

                Out::session('login', In::post('login'));

                $this->redirect('admin-modification-success');
            } else {
                $this->redirect('admin-wrong-password');
            }
        } else {
            AdminModel::update($login, ['admin_login' => In::post('login')]);
            Out::session('login', In::post('login'));
        }

        $this->redirect('admin-modification-success');
    }

    public function addPhoto()
    {
        $this->check();

        if (In::isSetPost('title', 'subtitle', 'description', 'tags')) {
            $fileName = self::DEFAULT_IMAGE_NAME;

            try {
                $fileName = File::moveUploadedFile('photo', 'public/img/photo', ['.jpg', '.jpeg', '.png']);
            } catch (Exception $exception) {
                Error::create($exception->getMessage(), '500');
            }

            $extension = strrchr($fileName, '.');

            $type = $extension === '.png' ? Photo::TYPE_PNG : Photo::TYPE_JPEG;

            try {
                $photo = new Photo(ROOT . '/public/img/photo/' . $fileName, $type);
                $photo->createResizedWidth(ROOT . '/public/img/photo/gallery/' . $fileName, 545);
            } catch (Exception $exception) {
                Error::create($exception->getMessage(), '500');
            }

            PhotoModel::insert([
                'photo_name' => $fileName,
                'photo_title' => In::post('title'),
                'photo_subtitle' => In::post('subtitle'),
                'photo_description' => In::post('description')
            ]);

            $tags = explode(',', str_replace(' ', null, str_replace('#', null, In::post('tags'))));

            $photoId = PhotoModel::lastInsertId();

            foreach ($tags as $tag)
            {
                if (TagModel::existsTagName($tag) === false) {
                    TagModel::insert(['tag_name' => $tag]);
                }

                IdentifyModel::insert([
                    'photo_id' => $photoId,
                    'tag_id' => TagModel::selectTagId($tag)
                ]);
            }

            $this->redirect('admin');
        } else {
            $this->loadView('add_photo');
        }
    }

    public function managePhoto()
    {
        $this->check();
        $photos = PhotoModel::selectAll();
        $this->loadView('manage_photo', ['photos' => $photos]);
    }

    public function updatePhoto($id)
    {
        $this->check();
        $photoId = is_numeric($id) ? (int) $id : 0;

        if (In::isSetPost(['title', 'subtitle', 'description', 'tags'])) {
            PhotoModel::update($photoId, [
                'photo_title' => In::post('title'),
                'photo_subtitle' => In::post('subtitle'),
                'photo_description' => In::post('description')
            ]);

            $tags = explode(',', str_replace(' ', null, str_replace('#', null, In::post('tags'))));

            $photoId = PhotoModel::lastInsertId();

            IdentifyModel::deleteTagWherePhotoId($photoId);

            foreach ($tags as $tag)
            {
                if (TagModel::existsTagName($tag) === false) {
                    TagModel::insert(['tag_name' => $tag]);
                }

                IdentifyModel::insert([
                    'photo_id' => $photoId,
                    'tag_id' => TagModel::selectTagId($tag)
                ]);
            }

            $this->redirect('admin-manage-photo');
        } else {
            $photo = PhotoModel::select($photoId);

            if (!$photo) {
                $this->redirect('admin-manage-photo');
            }

            $tags = null;
            $tagArray = TagModel::selectPhotoTag($photoId);

            if (!empty($tagArray)) {
                foreach ($tagArray as $tag)
                {
                    $tags .= '#' . trim($tag->tag_name) . ', ';
                }

                $tags = rtrim($tags, ', ');
            }

            $this->loadView('update_photo', [
                'tags' => $tags,
                'photo' => $photo
            ]);
        }
    }

    public function deletePhoto($id)
    {
        $this->check();
        $photoId = is_numeric($id) ? (int) $id : 0;
        $photo = PhotoModel::select($photoId);
        PhotoModel::delete($photoId);
        unlink(ROOT . '/public/img/photo/' . $photo->photo_name);
        unlink(ROOT . '/public/img/photo/gallery/' . $photo->photo_name);
        $this->redirect('admin-manage-photo');
    }

    public function manageComment()
    {
        $this->check();
        $comments = CommentModel::selectAll();
        $this->loadView('manage_comment', ['comments' => $comments]);
    }

    public function updateComment($id)
    {
        $this->check();
        $commentId = is_numeric($id) ? (int) $id : 0;

        if (In::isSetPost('author', 'message')) {
            CommentModel::update($commentId, [
                'comment_author' => In::post('author'),
                'comment_message' => String::clean(In::post('message'))
            ]);

            $this->redirect('admin-manage-comment');
        } else {
            $comment = CommentModel::select($commentId);

            if (!$comment) {
                $this->redirect('admin-manage-comment');
            }

            $this->loadView('update_comment', ['comment' => $comment]);
        }
    }

    public function deleteComment($id)
    {
        $this->check();
        $commentId = is_numeric($id) ? (int) $id : 0;
        CommentModel::delete($commentId);
        $this->redirect('admin-manage-comment');
    }

    public function wrongLogin()
    {
        $this->loadView('wrong_login');
    }

    public function wrongPassword()
    {
        $this->loadView('wrong_password');
    }

    public function logoutSuccess()
    {
        $this->loadView('logout_success');
    }

    public function logoutError()
    {
        $this->loadView('logout_error');
    }

    public function modificationSuccess()
    {
        $this->loadView('modification_success');
    }

    private function check()
    {
        if (!Auth::check('admin')) {
            $this->redirect('admin');
        }
    }

}