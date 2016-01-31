<?php

namespace Rave\Application\Controller;

use Rave\Core\Controller;

use Rave\Library\Core\IO\In;
use Rave\Library\Custom\Parsedown;
use Rave\Library\Core\Security\Text;

use Rave\Application\Model\TagModel;
use Rave\Application\Model\LikeModel;
use Rave\Application\Model\PhotoModel;
use Rave\Application\Model\CommentModel;

class Photo extends Controller
{
    const COMMENT_LIMIT = 10;

    public function __construct()
    {
        $this->setLayout('main');
        $this->setI18n(true);
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
        $photoId = is_numeric($id) ? (int) $id : 0;

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