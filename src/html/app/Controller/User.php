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
}
