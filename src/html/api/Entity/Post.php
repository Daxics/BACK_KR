<?php

use App\Controller\Post;


switch ($method){
    case 'GET':
        if(isset($id)){
            Post::getPost($connect, $id);
        } if(isset($_GET['p'])) {
            Post::getSubtable($connect, $_GET['p'] ?? 0, $_GET['author'] ?? '', $_GET['tags'] ?? '', $_GET['characters'] ?? '');
        }

        break;
    case 'POST':
        Post::addPost($connect, $_POST, $_FILES);
        break;
    case 'PATCH':
        if (isset($id)) {
            $data = json_decode(file_get_contents("php://input"), true);
//            print_r($data);
            Post::patchPost($connect, $data, $id);
        }
        break;
    case 'DELETE':
        Post::delPost($connect, $id);
        break;
}

//Post::getCount($connect);
//Post::getSubtable($connect, $_GET['s'] ?? '');
