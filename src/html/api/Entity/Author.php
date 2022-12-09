<?php

use App\Tables\Author;


switch ($method){
    case 'GET':
        if(isset($id)){
            Author::getAuthor($connect, $id);
        } else {
            if (isset($_GET['s'])) {
                Author::getAuthorLimmit($connect, $_GET['s'] ?? '');
            } else {
                Author::getAuthors($connect);
            }
        }
        break;
    case 'POST':
        Author::setAythor($connect, $_POST);
        break;
    case 'PATCH':
        if (isset($id)) {
            $data = json_decode(file_get_contents("php://input"), true);
            Author::updateAuthor($connect, $id, $data);
        }
        break;
    case 'DELETE':
        Author::deliteAuthor($connect, $id);
        break;

}
