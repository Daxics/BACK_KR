<?php

use App\Tables\Comment;


switch ($method){
    case 'GET':
        if($id){

        } else {

        }
        break;
    case 'POST':
        break;
    case 'PATCH':
        if (isset($id)) {
            $data = json_decode(file_get_contents("php://input"), true);
        }
        break;
    case 'DELETE':
        break;

}