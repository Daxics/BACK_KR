<?php

use App\Controller\Tag;


switch ($method){
    case 'GET':
        if(isset($id)){
            Tag::getPostsTags($connect, $id);
        } else {
            if (isset($_GET['s'])) {
                Tag::getTagLimmit($connect, $_GET['s'] ?? 0);
            } else {
                Tag::getTags($connect);
            }
        }
        break;
    case 'POST':
        Tag::addTag($connect, $_POST);
        break;
    case 'PATCH':
        if (isset($id)) {
            $data = json_decode(file_get_contents("php://input"), true);
            Tag::patchTag($connect, $data, $id);
        }
        break;
    case 'DELETE':
        Tag::delTag($connect, $id);
        break;

}