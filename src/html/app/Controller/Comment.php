<?php

namespace App\Controller;
session_start();

class Comment
{
    public static function addComment($connection, $comment)
    {
        if (empty($comment['text'])) {
            http_response_code(200);
            $res = [
                "type" => 1,
                "status" => false,
                "message" => 'Some data is not filled or you have entered incorrect values'
            ];
        } else {
            $id_post = $comment['id_post'];
            $id_user = $comment['id_user'];
            $text = $comment['text'];
            $connection->query("INSERT INTO comments (`id_post`,`id_user`,`text`) VALUES ($id_post, $id_user, '$text')");
            http_response_code(201);
            $res = [
                "type" => 0,
                "status" => true,
                "post_id" => mysqli_insert_id($connection)
            ];
        }
        echo json_encode($res);
    }

    public static function getPostsComments($connection, $id){
        $role = $_SESSION['user']['id_user'] ?? 0;


        $comments = $connection->query("SELECT comments.*, users.nickName  FROM comments
                                            INNER JOIN users
                                            ON users.id_user = comments.id_user
                                            WHERE id_post = $id     
                                            ORDER BY dateTime DESC");
        $postsList = [];
        while ($post = mysqli_fetch_assoc($comments)) {
            $post['role'] = $role;
            $postsList[] = $post;
        }
        echo json_encode($postsList);
    }

    public static function getCommentsByUser($connection, $id){
        $characters = $connection->query("SELECT * FROM comments WHERE id_user = $id ORDER BY dateTime DESC");
        $postsList = [];
        while ($post = mysqli_fetch_assoc($characters)) {
            $postsList[] = $post;
        }
        echo json_encode($postsList);
    }

    public static function delComment($connection, $id){
        $connection->query("DELETE FROM comments WHERE id_comment = $id");
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => 'Comment is deleted',
            "orderID" => $id
        ];
        echo json_encode($res);
    }

    public static function editComment($connection, $id, $data){
        if(empty($data['text'])){
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => 'Some data is not filled'
            ];

            echo json_encode($res);
            return;
        }

        $text = $data['text'];
        $connection->query("UPDATE `comments` SET `text` = '$text' WHERE `id_comment` = '$id'");

        http_response_code(200);
        $res = [
            "status" => true,
            "message" => 'Comment is updated'
        ];

        echo json_encode($res);
    }
}
