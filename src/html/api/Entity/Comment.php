<?php

use App\Tables\Comment;


switch ($method){
    case 'GET':
        if($id){
        Comment::getPostsComments($connect, $id);
        } else {

        }
        break;
    case 'POST':
        Comment::addComment($connect, $_POST);
        break;
    case 'PATCH':
        if (isset($id)) {
            $data = json_decode(file_get_contents("php://input"), true);
            Comment::editComment($connect, $id, $data);
        }
        break;
    case 'DELETE':
        Comment::delComment($connect, $id);
        break;

}