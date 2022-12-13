<?php

use App\Controller\User;
use App\Controller\Registration;


switch ($method){
    case 'GET':
        if (isset($id)){
            if (isset($_GET['s'])){
                User::get_users_posts($connect, $id, $_GET['s']);
            } else {
                User::get_user($connect, $id);
            }
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
