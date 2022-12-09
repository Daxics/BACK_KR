<?php

use App\Tables\Character;


switch ($method){
    case 'GET':
        if(isset($id)){

        } else {
            Character::getCharacters($connect);
        }
        break;
    case 'POST':
        Character::addCharacter($connect, $_GET['name'] ?? '');
        break;
    case 'PATCH':
        if (isset($id)) {
            $data = json_decode(file_get_contents("php://input"), true);
        }
        break;
    case 'DELETE':
        Character::delCharacter($connect, $id);
        break;

}