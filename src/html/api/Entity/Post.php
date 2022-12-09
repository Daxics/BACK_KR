<?php

use App\Tables\Post;


switch ($method){
    case 'GET':
        if(isset($id)){
            Post::getPost($connect, $id);
        } else {
            Post::getPosts($connect, $_GET['s'] ?? '');
        }
        break;
    case 'POST':
        Post::addPost($connect, $_POST, $_FILES);
        break;
    case 'PATCH':
        if (isset($id)) {
            $data = json_decode(file_get_contents("php://input"), true);
        }
        break;
    case 'DELETE':
        Post::delPost($connect, $id);
        break;
}

//Post::getCount($connect);
//Post::getSubtable($connect, $_GET['s'] ?? '');
