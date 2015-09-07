<?php

require_once 'Photo.php';

use Rave\Core\Controller;

use Rave\Library\Core\IO\In;
use Rave\Library\Core\Security\String;

use Rave\Application\Model\CommentModel;

class Comment extends Controller
{

    public function add($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->redirect('photo');
        }

        if (In::isSetPost(['author', 'message'])) {

            $photoId = is_numeric($id) ? (int) $id : 0;

            if (In::post('author') === '' || In::post('message') === '') {
                die ('ERROR');
            }

            if (CommentModel::posted(String::hash($_SERVER['REMOTE_ADDR']), $photoId) < 5) {
                CommentModel::insert([
                    'photo_id' => $photoId,
                    'comment_author' => In::post('author'),
                    'comment_message' => In::post('message'),
                    'comment_ip' => String::hash($_SERVER['REMOTE_ADDR'])
                ]);
            } else {
                echo 'BAN';
            }
        }
    }

}