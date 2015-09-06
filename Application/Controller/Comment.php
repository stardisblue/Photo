<?php

use Rave\Core\Controller;
use Rave\Library\Core\IO\In;
use Rave\Application\Model\CommentModel;

class Comment extends Controller
{

    public function add($id)
    {
        if (In::isSetPost(['author', 'message'])) {
            $photoId = is_numeric($id) ? (int) $id : 0;

            CommentModel::insert([
                'photo_id' => $photoId,
                'comment_author' => In::post('author'),
                'comment_message' => In::post('message')
            ]);

            $this->redirect('photo/display/' . $photoId);
        } else {
            $this->redirect('photo');
        }
    }

}