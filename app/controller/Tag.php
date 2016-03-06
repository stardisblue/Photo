<?php
/**
 * Created by PhpStorm.
 * User: stardisblue
 * Date: 23/02/16
 * Time: 14:50
 */

namespace rave\app\controller;


use rave\app\model\PhotoModel;
use rave\app\model\TagModel;

class Tag extends FrontController
{

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
        $photos = PhotoModel::selectAllByTag($id);

        $this->loadView('gallery', ['photos' => $photos]);
    }

    public function displayAll()
    {
        $tags = TagModel::selectAll();

        $this->loadView('list', ['tags' => $tags]);

    }
}