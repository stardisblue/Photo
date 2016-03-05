<?php

namespace rave\app\Controller;

use rave\app\model\CommentModel;
use rave\app\model\LikeModel;
use rave\app\model\PhotoModel;
use rave\app\model\TagModel;
use rave\lib\core\io\In;
use rave\lib\core\Security\Text;
use rave\lib\custom\Parsedown;

class Photo extends FrontController
{
    const COMMENT_LIMIT = 10;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $tags = [];
        $photos = PhotoModel::selectAll();
        $popularTags = TagModel::selectPopularTag(10);

        foreach ($photos as $photo) {
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
        $photoId = is_numeric($id) ? (int)$id : 0;

        $photo = PhotoModel::selectWithFormattedDate($photoId);

        if (is_null($photo)) {
            $this->redirect('photo');
        }

        $parser = Parsedown::instance();

        $tags = TagModel::selectPhotoTag($photoId);
        $comments = CommentModel::selectById($photoId, self::COMMENT_LIMIT);
        PhotoModel::update($photoId, ['photo_visit' => $photo->photo_visit + 1]);

        $this->loadView('display', [
            'tags' => $tags,
            'photo' => $photo,
            'parser' => $parser,
            'comments' => $comments,
        ]);
    }

    public function like($id)
    {
        $photoId = is_numeric($id) ? (int)$id : 0;

        if (LikeModel::liked(Text::hash($_SERVER['REMOTE_ADDR']), $photoId) === false) {
            $photo = PhotoModel::select($photoId);

            if ($photo !== false) {
                PhotoModel::update($photoId, ['photo_like' => $photo->photo_like + 1]);

                LikeModel::insert([
                    'photo_id' => $photoId,
                    'like_ip' => Text::hash($_SERVER['REMOTE_ADDR'])
                ]);

                echo PhotoModel::select($photoId)->photo_like;
            }
        } else {
            echo 'BAN';
        }
    }

    public function search()
    {
        if (In::isSetPost('search')) {
            $tags = [];
            $photos = PhotoModel::selectLikeQuery(In::post('search'));
            $popularTags = TagModel::selectPopularTag(10);

            foreach ($photos as $photo) {
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