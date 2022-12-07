<?php

$connect = new mysqli("db", "user", "password", "appDB");
if(mysqli_connect_errno()) {
    throw new Exception("Couldn't connect to database.");
}

require_once "../vendor/autoload.php";

use App\Tables\Base_API;
use App\Tables\Post;
use App\Tables\User;
use App\Tables\Tag;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

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
                case 'post':
                    Post::getPost($connect, $id);
                    break;
                    case 'user':
                    User::get_user($connect, $id);
                    break;
            }
        } else {
            switch ($type) {
                case 'posts':
                    Post::getPosts($connect, $_GET['s'] ?? '');
                    break;
                case 'count':
                    Base_API::getCount($connect, $_GET['t'] ?? '');
                    break;
                case 'all':
                    Base_API::getAllOut($connect, $_GET['t'] ?? '');
                    break;
                case 'users':
                    Base_API::getAllOut($connect, $type);
                    break;
                case 'count_all_posts':
                    Post::getCount($connect);
                    break;
                case 'tags':
                    Tag::getTags($connect);
                    break;
                case 'subTable':
                    switch ($_GET['t']) {
                        case 'posts':
                            Post::getSubtable($connect, $_GET['s'] ?? '');
                            break;
                    }
                    break;
            }
        }
        break;
    case 'POST':
        switch ($type){
            case 'postAdd':
                Post::addPost($connect, $_POST, $_FILES);
                break;
            case 'userAdd':
                User::add_user($connect, $_POST);
                break;
            case 'userCheck':
                User::check_user($connect, $_POST);
                break;
            case 'tag':
                Tag::addTag($connect, $_GET['name'] ?? '');
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
            case 'user':
                break;
            case 'post':
                Post::delPost($connect, $id);
                break;
                case 'tags':
                Tag::delTag($connect, $id);
                break;
        }
        break;
}
