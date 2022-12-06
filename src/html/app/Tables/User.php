<?php
namespace App\Tables;
session_start();

class User
{
    public static function get_user($connection, $id)
    {
        $req = "SELECT id_user, id_role, nickName, e_mail, posts_count, comments_count, dateTime FROM users WHERE users.id_user = '$id'";
        $post = $connection->query($req);
        if (mysqli_num_rows($post) === 0) {
            http_response_code(404);
            $res = [
                "status" => false,
                "massage" => "User not found"
            ];
            echo json_encode($res);
        } else {
            $post = mysqli_fetch_assoc($post);
            echo json_encode($post);
        }
    }

    public static function get_count_comm($connection, $id){
        $res = $connection->query("SELECT COUNT(*) count FROM comments WHERE id_user = '$id'");
        $res = mysqli_fetch_assoc($res);
        echo json_encode($res);

    }

    public static function check_user($connection, $data)
    {

        $error_fields = [];
        $nickName = $data['nickName'];
        $password = $data['password'];

        if ($nickName === '') {
            $error_fields[] = 'nickName';
        }

        if ($password === '') {
            $error_fields[] = 'password';
        }

        if (!empty($error_fields)) {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => "Проверьте правильность полей",
                "fields" => $error_fields
            ];

            echo json_encode($response);

            die();
        }
        $password = md5($password);
        $check_user = $connection->query("SELECT * FROM `users` WHERE `nickName` = '$nickName' AND `password` = '$password'");
        if (mysqli_num_rows($check_user) > 0) {
            $user = mysqli_fetch_assoc($check_user);
            $_SESSION['user'] = [
                "id_user" => $user['id_user'],
                "id_role" => $user['id_role']
            ];
            $response = [
                "status" => true
            ];

        } else {
            $response = [
                "status" => false,
                "message" => 'Не верный логин или пароль'
            ];

        }
        echo json_encode($response);
    }

    public static function add_user($connection, $data)
    {
        $nickName = $data['nickName'];
        $e_mail = $data['e_mail'];
        $password = $data['password'];
        $password_con = $data['password_con'];
        $check_login = $connection->query("SELECT * FROM `users` WHERE `nickName` = '$nickName'");
        if (mysqli_num_rows($check_login) > 0) {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => "Такой логин уже существует",
                "fields" => ['login']
            ];

            echo json_encode($response);
            die();
        }

        $error_fields = [];

        if ($nickName === '') {
            $error_fields[] = 'nickName';
        }

        if ($password === '') {
            $error_fields[] = 'password';
        }


        if ($e_mail === '' || !filter_var($e_mail, FILTER_VALIDATE_EMAIL)) {
            $error_fields[] = 'e_mail';
        }

        if ($password_con === '') {
            $error_fields[] = 'password_con';
        }


        if (!empty($error_fields)) {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => "Проверьте правильность полей",
                "fields" => $error_fields
            ];

            echo json_encode($response);

            die();
        }


        if ($password === $password_con) {
            $password = md5($password);
            $connection->query("INSERT INTO `users` (`id_user`,`nickName`,`e_mail`,`password`) VALUES
                                (NULL,'$nickName','$e_mail','$password');");
            http_response_code(201);
            $response = [
                "status" => true,
                "message" => "Регистрация прошла успешно!",
            ];
        } else {
            $response = [
                "status" => false,
                "message" => "Пароли не совпадают",
            ];
        }
        echo json_encode($response);
    }
}