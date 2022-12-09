<?php

use App\Tables\Tag;


switch ($method){
    case 'GET':
        if(isset($id)){

        } else {
            Tag::getTags($connect);
        }
        break;
    case 'POST':
        Tag::addTag($connect, $_GET['name'] ?? '');
        break;
    case 'PATCH':
        if (isset($id)) {
            $data = json_decode(file_get_contents("php://input"), true);
        }
        break;
    case 'DELETE':
        Tag::delTag($connect, $id);
        break;

}