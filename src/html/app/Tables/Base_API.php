<?php

namespace App\Tables;

class Base_API
{
    public static function getAllOut($connection, $table)
    {
        $posts = $connection->query("SELECT * FROM $table");
        $postsList = [];
        while ($post = mysqli_fetch_assoc($posts)) {
            $postsList[] = $post;
        }
        echo json_encode($postsList);
    }

    public static function getCount($connection, $table){
        $res = $connection->query("SELECT COUNT(*) FROM $table");
        $res = mysqli_fetch_assoc($res);
        echo json_encode($res);
    }


}
