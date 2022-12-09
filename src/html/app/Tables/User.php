<?php
namespace App\Tables;

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
}