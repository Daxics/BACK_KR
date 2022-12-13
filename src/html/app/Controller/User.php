<?php
namespace App\Controller;

class User
{
    public static function get_user($connection, $id)
    {
        $req = "SELECT id_user, role, nickName, e_mail, posts_count, comments_count, dateTime 
                    FROM users INNER JOIN roles ON users.id_role = roles.id_role 
                    WHERE users.id_user = '$id'";
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

    public static function get_users_posts($connection, $id, $start){
        $posts = $connection->query("SELECT posts.id_post, posts.img, posts.img_name
                                        FROM `posts` 
                                        WHERE posts.id_user = {$id}
                                        ORDER BY `id_post` 
                                        DESC LIMIT {$start},10 ");
        $postsList = [];
        while ($post = mysqli_fetch_assoc($posts)) {
            $postsList[] = $post;
        }
        echo json_encode($postsList);
    }

    public static function patch_user($connection, $id, $data)
    {
        $nickName = $data['nickName'];
        $e_mail = $data['e_mail'];
        $check_login = $connection->query("SELECT * FROM `users` WHERE `nickName` = '$nickName' AND id_user != $id");
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


        if ($e_mail === '' || !filter_var($e_mail, FILTER_VALIDATE_EMAIL)) {
            $error_fields[] = 'e_mail';
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


        $connection->query("UPDATE `users` SET nickName = '$nickName', e_mail = '$e_mail' WHERE id_user = $id");
        http_response_code(201);
        $response = [
            "status" => true,
            "message" => "Данные успешно обновились!",
        ];

        echo json_encode($response);
    }

    public static function delete_user($connection, $id)
    {
        $connection->query("DELETE FROM users WHERE users.id_user = $id");
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => 'Tag is deleted',
            "orderID" => $id
        ];
        echo json_encode($res);
    }

}
