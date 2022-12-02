<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");
require 'requires.php';

$q = $_GET['q'];
$params = explode('/', $q);

$type = $params[0];
if (isset($params[1])) {
    $id = $params[1];
    if (isset($params[2])){
        $column = $params[2];
    }
}

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        if (isset($id)) {
            switch ($type) {
                case 'users':
                    break;
                case 'posts':
                    $post = new Post;
                    $post->getPost($connect, $id);
                    break;
            }
        } else {
            $content = new Base_API;
            $content->getAllOut($connect, $type);
        }
        break;
    case 'POST':
        switch ($type){
            case 'posts':
                $post = new Post;
                $post->addPost($connect, $_POST, $_FILES);
                break;
            case 'users':
                $user = new User;
                $user->addUser($connect, $_POST);
                break;
        }
        break;
    case 'PATCH':
        if ($type === 'orders') {
            if (isset($id) && isset($column)) {
                $data = json_decode(file_get_contents("php://input"), true);
                $update = new Base_API;
                $update->patch($connect, $type, $id, $column, $data);
            }
        }
        break;
    case 'DELETE':
        switch ($type) {
            case 'users':
                break;
            case 'posts':
                $post = new Post;
                $post->delPost($connect, $id);
                break;
        }
        break;
}
