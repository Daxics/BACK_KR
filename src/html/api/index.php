<?php

$connect = new mysqli("db", "user", "password", "appDB");
if(mysqli_connect_errno()) {
    throw new Exception("Couldn't connect to database.");
}

require_once "../vendor/autoload.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

$params = explode('/', $_GET['q']);


$method = $_SERVER['REQUEST_METHOD'];

$method_type = $params[0];
if (isset($params[1])) {
    $id = $params[1];
}

//Base_API::getAllOut($connect, $_GET['t'] ?? '');
//Base_API::getCount($connect, $_GET['t'] ?? '');


switch ($method_type){
    case "author":
        require_once __DIR__. "/Entity/Author.php";
        break;
    case "character":
        require_once __DIR__. "/Entity/Character.php";
        break;
    case "comment":
        require_once __DIR__. "/Entity/Comment.php";
        break;
    case "post":
        require_once __DIR__. "/Entity/Post.php";
        break;
    case "tag":
        require_once __DIR__. "/Entity/Tag.php";
        break;
    case "user":
        require_once __DIR__. "/Entity/User.php";
        break;
    case "vendor":
        require_once __DIR__ . "/Entity/Vendor.php";
        break;
}

