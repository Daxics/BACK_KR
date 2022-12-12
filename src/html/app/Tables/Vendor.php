<?php

namespace App\Tables;

class Vendor
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
        $res = $connection->query("SELECT COUNT(*) count FROM $table");
        $res = mysqli_fetch_assoc($res);
        echo json_encode($res);
    }


}
