<?php

use App\Controller\User;
use App\Controller\Registration;


switch ($method){
    case 'GET':
        if (isset($id)){
            if (isset($_GET['s'])){
                User::get_users_posts($connect, $id, $_GET['s']);
            } else if(isset($_GET['cs']))  {
                User::get_users_comments($connect, $id, $_GET['cs']);
            } else{
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
            User::patch_user($connect, $id, $data);
        }
        break;
    case 'DELETE':
        User::delete_user($connect, $id);
        break;

}
