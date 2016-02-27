<?php
/**
 * Created by PhpStorm.
 * User: stardisblue
 * Date: 23/02/16
 * Time: 14:50
 */

namespace Rave\Application\Controller;


use Rave\Application\Model\PhotoModel;
use Rave\Application\Model\TagModel;
use Rave\Core\Controller;
use Rave\Library\Core\Security\Text;

class Tag extends Controller
{

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
        $photos = PhotoModel::selectAllByTag($id);

        $this->loadView('gallery', ['photos' => $photos]);
    }

    public function displayAll()
    {
        $tags = TagModel::selectAll();

        $this->loadView('list', ['tags' => $tags]);

    }
}