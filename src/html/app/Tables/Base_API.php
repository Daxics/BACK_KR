<?php

namespace App\Tables;

class Base_API
{
    public function getAllOut($connection, $table)
    {
        $posts = $connection->query("SELECT * FROM $table");
        $postsList = [];
        while ($post = mysqli_fetch_assoc($posts)) {
            if (isset($post['img'])){
                $post['img'] = base64_encode($post['img']);
            }
            $postsList[] = $post;
        }
        echo json_encode($postsList);
    }

}
