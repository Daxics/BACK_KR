<?php

namespace App\Tables;

class Tag
{
    public static function addTag($connection, $tag)
    {
        if (empty($tag)) {
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => 'Some data is not filled'
            ];
        } else {
                $connection->query("INSERT INTO tags (`id_tag`,`regularTag`) VALUES
                                    (NULL,'$tag');");
                http_response_code(201);
                $res = [
                    "status" => true,
                    "post_id" => mysqli_insert_id($connection)
                ];
        }
        echo json_encode($res);
    }

    public static function delTag($connection, $id){
        $id = intval($id);
        $connection->query("DELETE FROM tags WHERE tags.id_tag = '$id'");
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => 'Tag is deleted',
            "orderID" => $id
        ];
        echo json_encode($res);
    }

}