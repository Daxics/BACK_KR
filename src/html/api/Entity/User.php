<?php

use App\Tables\User;
use App\Tables\Registration;


switch ($method){
    case 'GET':
        if(isset($id)){
            User::get_user($connect, $id);
        } else {

        }
        break;
    case 'POST':
        switch ($id) {
            case 'check':
                Registration::check_user($connect, $_POST);
                break;
            case 'register':
                Registration::add_user($connect, $_POST);
        }
        break;
    case 'PATCH':
        if (isset($id)) {
            $data = json_decode(file_get_contents("php://input"), true);
        }
        break;
    case 'DELETE':
        break;

}
