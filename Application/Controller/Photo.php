<?php

use Rave\Core\Controller;

use Rave\Library\Core\IO\In;

use Rave\Application\Model\TagModel;
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
        $tags = [];
        $photos = PhotoModel::selectAll();
        $popularTags = TagModel::selectPopularTag(10);

        foreach ($photos as $photo)
        {
            $tags[$photo->photo_id] = TagModel::selectPhotoTag($photo->photo_id);
        }

        $this->loadView('gallery', [
            'tags' => $tags,
            'photos' => $photos,
            'popularTags' => $popularTags
        ]);
    }

    public function display($id)
    {
        $photoId = is_numeric($id) ? (int) $id : 0;

        $photo = PhotoModel::selectWithFormattedDate($photoId);

        if ($photo === false) {
            $this->redirect('photo');
        }

        $tags = TagModel::selectPhotoTag($photoId);
        $comments = CommentModel::selectById($photoId);
        PhotoModel::update($photoId, ['photo_visit' => $photo->photo_visit + 1]);

        $this->loadView('display', [
            'tags' => $tags,
            'photo' => $photo,
            'comments' => $comments
        ]);
    }

    public function like($id)
    {
        $photoId = is_numeric($id) ? (int) $id : 0;

        $photo = PhotoModel::select($photoId);
        PhotoModel::update($photoId, ['photo_like' => $photo->photo_like + 1]);

        $this->redirect('photo');
    }

    public function search()
    {
        if (In::isSetPost('search')) {
            $tags = [];
            $photos = PhotoModel::selectLikeQuery(In::post('search'));
            $popularTags = TagModel::selectPopularTag(10);

            foreach ($photos as $photo)
            {
                $tags[$photo->photo_id] = TagModel::selectPhotoTag($photo->photo_id);
            }

            $this->loadView('gallery', [
                'tags' => $tags,
                'photos' => $photos,
                'popularTags' => $popularTags
            ]);
        } else {
            $this->redirect('photo');
        }
    }

}