<?php

namespace App\Tables;

class Character
{
    public static function addCharacter($connection, $character)
    {
        if (empty($character) or count(explode(' ', $character)) > 1) {
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => 'Some data is not filled or you have entered incorrect values'
            ];
        } else {
            $check_character = $connection->query("SELECT * FROM `characters_list` WHERE `character_title` = '$character'");
            if (mysqli_num_rows($check_character) > 0) {
                $res = [
                    "status" => false,
                    "type" => 1,
                    "message" => "Такой персонаж уже существует",
                ];
            } else{
                $connection->query("INSERT INTO characters_list (`character_title`) VALUES ('$character')");
                $connection->query("ALTER TABLE characters ADD COLUMN $character BIT NOT NULL DEFAULT 0;");
                http_response_code(201);
                $res = [
                    "status" => true,
                    "post_id" => mysqli_insert_id($connection)
                ];
            }
        }
        echo json_encode($res);
    }

    public static function getCharacters($connection){
        $characters = $connection->query("SELECT * FROM characters_list");
        $postsList = [];
        while ($post = mysqli_fetch_assoc($characters)) {
            $postsList[] = $post;
        }
        echo json_encode($postsList);
    }

    public static function getPostsCharacters($connection, $id){
        $posts = $connection->query("SELECT * FROM characters WHERE id_post = $id");
        $postsList = [];
        while ($post = mysqli_fetch_assoc($posts)) {
            $postsList[] = $post;
        }
        echo json_encode($postsList);
    }

    public static function delCharacter($connection, $character_title){
        $connection->query("DELETE FROM characters_list WHERE characters_list.character_title = '$character_title'");
        $connection->query("ALTER TABLE `characters` DROP COLUMN $character_title");
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => 'Tag is deleted',
            "orderID" => $character_title
        ];
        echo json_encode($res);
    }

}