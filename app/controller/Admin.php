<?php

namespace Rave\Application\Controller;

use Exception;
use Rave\Application\Model\AdminModel;
use Rave\Application\Model\CommentModel;
use Rave\Application\Model\GalleryModel;
use Rave\Application\Model\IdentifyModel;
use Rave\Application\Model\PhotoModel;
use Rave\Application\Model\TagModel;
use Rave\Core\Controller;
use Rave\Core\Error;
use Rave\Library\Core\IO\File;
use Rave\Library\Core\IO\In;
use Rave\Library\Core\IO\Out;
use Rave\Library\Core\Security\Auth;
use Rave\Library\Core\Security\Password;
use Rave\Library\Core\Security\Text;
use Rave\Library\Custom\Photo;

class Admin extends Controller
{
    const DEFAULT_IMAGE_NAME = 'error';

    public function __construct()
    {
        $this->setLayout('admin', ['loggedIn' => Auth::check('admin')]);
    }

    public function beforeCall(string $method)
    {
        if ($method != 'index' && $method != 'login' && $method != 'logout') {
            $this->checkAdmin();
        }
    }

    public function index()
    {
        if (Auth::check('admin')) {
            $this->redirect('admin/manage');
        }

        $this->redirect('admin/login');
    }

    public function login()
    {
        if (!In::isSetPost('login', 'password')) {

            $info = In::session('login_info');
            $this->loadView('login_form', ["info" => $info]);
            Out::unsetSession('login_info');
            exit;
        }

        if (!AdminModel::exists(In::post('login'))) {
            Out::session('login_info', 'login_error');
            $this->redirect('admin/');
        }

        $admin = AdminModel::select(In::post('login'));

        if (!Password::verify(In::post('password'), $admin->admin_password)) {
            Out::session('login_info', 'password_error');
            $this->redirect('admin/');
        }

        Auth::login('admin');
        Out::session('login', $admin->admin_login);

        $this->redirect('admin/manage');
    }

    public function logout()
    {

        Out::unsetSession('admin');
        Out::session('login_info', 'logout_success');
        $this->redirect('admin/');
    }

    public function manage()
    {

        $this->loadView('manage', ['manage' => true]);
    }

    public function account()
    {


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

                $this->redirect('admin/modification-success');
            } else {
                $this->redirect('admin/wrong-password');
            }
        } else {
            AdminModel::update($login, ['admin_login' => In::post('login')]);
            Out::session('login', In::post('login'));
        }

        $this->redirect('admin/modification-success');
    }

    public function addPhoto()
    {


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
                'photo_slug' => Text::slug(In::post('title')),
                'photo_subtitle' => In::post('subtitle'),
                'photo_description' => In::post('description')
            ]);

            $tags = explode(',', str_replace(' ', null, str_replace('#', null, In::post('tags'))));

            $photoId = PhotoModel::lastInsertId();

            foreach ($tags as $tag) {
                if (TagModel::existsTagName($tag) === false) {
                    TagModel::insert(['tag_name' => $tag, 'tag_slug' => Text::slug($tag)]);
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

    public function addGallery()
    {


        if (In::isSetPost('photo')) {
            GalleryModel::insert(['photo_id' => In::post('photo')]);
        }

        $this->redirect('admin/gallery/manage');
    }

    public function managePhoto()
    {

        $photos = PhotoModel::selectAll();
        $this->loadView('manage_photo', ['photos' => $photos]);
    }

    public function updatePhoto($id)
    {

        $photoId = is_numeric($id) ? (int)$id : 0;

        if (In::isSetPost('title', 'subtitle', 'description', 'tags')) {
            PhotoModel::update($photoId, [
                'photo_title' => In::post('title'),
                'photo_slug' => Text::slug(In::post('title')),
                'photo_subtitle' => In::post('subtitle'),
                'photo_description' => In::post('description')
            ]);

            $tags = explode(',', str_replace(' ', null, str_replace('#', null, In::post('tags'))));

            IdentifyModel::deleteTagWherePhotoId($photoId);

            foreach ($tags as $tag) {
                if (TagModel::existsTagName($tag) === false) {
                    TagModel::insert(['tag_name' => $tag, 'tag_slug' => Text::slug($tag)]);
                }

                IdentifyModel::insert([
                    'photo_id' => $photoId,
                    'tag_id' => TagModel::selectTagId($tag)
                ]);
            }

            TagModel::deleteUnusedTags();

            $this->redirect('admin/photo/manage');
        } else {
            $photo = PhotoModel::select($photoId);

            if (!$photo) {
                $this->redirect('admin/photo/manage');
            }

            $tags = null;
            $tagArray = TagModel::selectPhotoTag($photoId);

            if (!empty($tagArray)) {
                foreach ($tagArray as $tag) {
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

        $photoId = is_numeric($id) ? (int)$id : 0;
        $photo = PhotoModel::select($photoId);
        PhotoModel::delete($photoId);
        TagModel::deleteUnusedTags();
        if (!PhotoModel::photoIsUsed($photo->photo_name)) {
            unlink(ROOT . '/public/img/photo/' . $photo->photo_name);
            unlink(ROOT . '/public/img/photo/gallery/' . $photo->photo_name);
        }

        $this->redirect('admin/photo/manage');
    }

    public function deleteGallery($id)
    {

        $photoId = is_numeric($id) ? (int)$id : 0;
        GalleryModel::delete($photoId);
        $this->redirect('admin/gallery/manage');
    }

    public function manageComment()
    {

        $comments = CommentModel::selectAll();
        $this->loadView('manage_comment', ['comments' => $comments]);
    }

    public function manageGallery()
    {

        $this->loadView('manage_gallery', [
            'select' => PhotoModel::selectNotInGallery(),
            'photos' => GalleryModel::selectPhoto()
        ]);
    }

    public function updateComment($id)
    {

        $commentId = is_numeric($id) ? (int)$id : 0;

        if (In::isSetPost('author', 'message')) {
            CommentModel::update($commentId, [
                'comment_author' => In::post('author'),
                'comment_message' => Text::clean(In::post('message'))
            ]);

            $this->redirect('admin/comment/manage');
        } else {
            $comment = CommentModel::select($commentId);

            if (!$comment) {
                $this->redirect('admin/comment/manage');
            }

            $this->loadView('update_comment', ['comment' => $comment]);
        }
    }

    public function deleteComment($id)
    {

        $commentId = is_numeric($id) ? (int)$id : 0;
        CommentModel::delete($commentId);
        $this->redirect('admin/comment/manage');
    }

    public function modificationSuccess()
    {
        $this->loadView('modification_success');
    }

    protected function checkAdmin()
    {
        if (!Auth::check('admin')) {
            $this->redirect('admin');
        }
    }

}