<?php

namespace App\Tables;

class Tag
{
    public static function addTag($connection, $tag)
    {
        if (empty($tag) or count(explode(' ', $tag)) > 1) {
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => 'Some data is not filled or you have entered too many values'
            ];
        } else {
            $check_tag = $connection->query("SELECT * FROM `tags_list` WHERE `tag_title` = '$tag'");
            if (mysqli_num_rows($check_tag) > 0) {
                $res = [
                    "status" => false,
                    "type" => 1,
                    "message" => "Такой тэг уже существует",
                ];
            } else{
                $connection->query("INSERT INTO tags_list (`tag_title`) VALUES ('$tag')");
                $connection->query("ALTER TABLE tags ADD COLUMN $tag BIT NOT NULL DEFAULT 0;");
                http_response_code(201);
                $res = [
                    "status" => true,
                    "post_id" => mysqli_insert_id($connection)
                ];
            }
        }
        echo json_encode($res);
    }

    public static function getTags($connection){
        $posts = $connection->query("SELECT * FROM tags_list");
        $postsList = [];
        while ($post = mysqli_fetch_assoc($posts)) {
            $postsList[] = $post;
        }
        echo json_encode($postsList);
    }

    public static function delTag($connection, $tag_title){
        $connection->query("DELETE FROM tags_list WHERE tags_list.tag_title = '$tag_title'");
        $connection->query("ALTER TABLE `tags` DROP COLUMN $tag_title");
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => 'Tag is deleted',
            "orderID" => $tag_title
        ];
        echo json_encode($res);
    }

}