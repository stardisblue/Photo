<?php

use Rave\Core\Controller;
use Rave\Application\Model\PhotoModel;
use Rave\Application\Model\CommentModel;

class Photo extends Controller
{

    public function __construct()
    {
        $this->setLayout('main');
    }

    public function index()
    {
        $photos = PhotoModel::selectAll();
        $this->loadView('allPhotos', ['photos' => $photos]);
    }

    public function display($id)
    {
        $photoId = is_numeric($id) ? (int) $id : 0;
        $photo = PhotoModel::select($photoId);
        $comments = CommentModel::selectById($photoId);

        $this->loadView('display', ['photo' => $photo, 'comment' => $comments]);
    }

}