<?php

namespace rave\app\Controller;

use rave\app\model\CommentModel;
use rave\lib\core\io\In;
use rave\lib\core\Security\Text;

class Comment extends FrontController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add($id)
    {
        if (In::isSetPost('author', 'message')) {

            $photoId = is_numeric($id) ? (int)$id : 0;

            if (In::post('author') === '' || In::post('message') === '') {
                die('ERROR');
            }

            if (CommentModel::posted(Text::hash($_SERVER['REMOTE_ADDR']), $photoId) < 5) {
                CommentModel::insert([
                    'photo_id' => $photoId,
                    'comment_author' => In::post('author'),
                    'comment_message' => In::post('message'),
                    'comment_ip' => Text::hash($_SERVER['REMOTE_ADDR'])
                ]);
            } else {
                echo 'BAN';
            }
        }
    }

}