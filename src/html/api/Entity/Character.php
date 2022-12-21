<?php

use App\Controller\Character;


switch ($method){
    case 'GET':
        if(isset($id)){
            Character::getPostsCharacters($connect, $id);
        } else {
            if (isset($_GET['s'])) {
                Character::getCharacterLimmit($connect, $_GET['s'] ?? 0);
            } else {
                Character::getCharacters($connect);
            }
        }
        break;
    case 'POST':
        Character::addCharacter($connect, $_POST);
        break;
    case 'PATCH':
        if (isset($id)) {
            $data = json_decode(file_get_contents("php://input"), true);
            Character::patchCharacter($connect, $data, $id);
        }
        break;
    case 'DELETE':
        Character::delCharacter($connect, $id);
        break;

}