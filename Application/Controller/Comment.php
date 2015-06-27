<?php

use Rave\Core\Controller;
use Rave\Library\Core\IO\In;
use Rave\Application\Model\CommentModel;

class Comment extends Controller {

    public function __construct()
    {
        $this->setLayout('main');
    }

    public function add($id)
    {
        if (In::isSetPost(['title', 'author', 'content'])) {
            $photoId = is_numeric($id) ? (int) $id : 0;
            CommentModel::insert([
                'title' => In::post('title'),
                'author' => In::post('author'),
                'content' => In::post('content')
            ]);
        } else {
            $this->redirect('photo');
        }
    }

}