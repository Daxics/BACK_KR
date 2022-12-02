<?php
require_once 'Base_API.php';
session_start();

class User extends Base_API
{

    public function checkUser($connection, $data){

        if (empty($data['nickName']) || empty($data['password'])) {
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => 'Some data is not filled',
                "data" => $data
            ];
        } else {
            $nickName = $data['nickName'];
            $password = $data['password'];
            $password = md5($password);
            $check_user = $connection->query("SELECT * FROM `users` WHERE `login` = '$nickName' AND `password` = '$password'");
            if (mysqli_num_rows($check_user) > 0) {
                $user = mysqli_fetch_assoc($check_user);
                $_SESSION['user'] = [
                    "id" => $user['id_user']
            ];
            }
            http_response_code(201);
            $res = [
                "status" => true,
                "post_id" => mysqli_insert_id($connection)
            ];
        }
        echo json_encode($res);
    }


    public function addUser($connection, $data)
    {
        if (empty($data['nickName']) || empty($data['e_mail']) || empty($data['password'])) {
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => 'Some data is not filled',
                "data" => $data
            ];
        } else {
            $nickName = $data['nickName'];
            $e_mail = $data['e_mail'];
            $password = $data['password'];
            $password = md5($password);
            $connection->query("INSERT INTO `users` (`id_user`,`nickName`,`e-mail`,`password`) VALUES
                                (NULL,'$nickName','$e_mail','$password');");
            http_response_code(201);
            $res = [
                "status" => true,
                "post_id" => mysqli_insert_id($connection)
            ];
        }
        echo json_encode($res);
    }
}
