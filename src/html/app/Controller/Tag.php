<?php

namespace App\Controller;
session_start();

class Tag
{
    public static function addTag($connection, $tag)
    {
        if (empty($tag['tag']) or count(explode(' ', $tag['tag'])) > 1) {
            http_response_code(200);
            $res = [
                "status" => false,
                "message" => 'Some data is not filled or you have entered incorrect values'
            ];
        } else {
            $tag = $tag['tag'];
            $check_tag = $connection->query("SELECT * FROM `tags_list` WHERE `tag_title` = '$tag'");
            if (mysqli_num_rows($check_tag) > 0) {
                $res = [
                    "status" => false,
                    "type" => 1,
                    "message" => "Такой тэг уже существует",
                ];
            } else{
                $connection->query("INSERT INTO tags_list (`tag_title`) VALUES ('$tag')");
                $connection->query("ALTER TABLE tags ADD COLUMN $tag TINYINT NOT NULL DEFAULT 0;");
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

    public static function getPostsTags($connection, $id){
        $posts = $connection->query("SELECT * FROM tags WHERE id_post = $id");
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

    public static function patchTag($connection, $data, $id)
    {
        if (empty($data['tag']) or count(explode(' ', $data['tag'])) > 1) {
            http_response_code(200);
            $res = [
                "status" => false,
                "message" => 'Some data is not filled or you have entered incorrect values'
            ];
        } else {
            $tag = $data['tag'];
            $check_character = $connection->query("SELECT * FROM `tags_list` WHERE `tag_title` = '$id'");
            if (mysqli_num_rows($check_character) == 0) {
                $res = [
                    "status" => false,
                    "type" => 1,
                    "message" => "Такого тэга не существует",
                ];
            } else{
                $connection->query("UPDATE tags_list SET tag_title = '$tag' WHERE tag_title = '$id'");
                $connection->query("ALTER TABLE tags CHANGE $id $tag TINYINT");
                http_response_code(201);
                $res = [
                    "status" => true,
                    "post_id" => mysqli_insert_id($connection)
                ];
            }
        }
        echo json_encode($res);
    }


    public static function getTagLimmit($connection, $start)
    {
        $tags = $connection->query("SELECT * FROM tags_list ORDER BY tag_title LIMIT {$start},12 ");
        $tagsList = [];
        $role = $_SESSION['user']['id_user'] ?? 0;

        while ($character = mysqli_fetch_assoc($tags)) {
            $character['role'] = $role;
            $tagsList[] = $character;
        }
        echo json_encode($tagsList);
    }

    public static function getCount($connection)
    {
        $characters = $connection->query("SELECT count(*) count FROM tags_list");
        echo json_encode(mysqli_fetch_assoc($characters));
    }

}