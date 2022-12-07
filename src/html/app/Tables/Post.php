<?php

namespace App\Tables;

class Post
{

    public static function getPosts($connection, $start)
    {
        $posts = $connection->query("SELECT posts.id_post, posts.img, posts.img_name FROM `posts` ORDER BY `id_post` DESC LIMIT {$start},24");
        $postsList = [];
        while ($post = mysqli_fetch_assoc($posts)) {
            $postsList[] = $post;
        }
        echo json_encode($postsList);
    }

    public static function getPost($connection, $id)
    {
        $post = $connection->query("SELECT * FROM `posts` WHERE `id_post` = '$id'");
        if (mysqli_num_rows($post) === 0) {
            http_response_code(404);
            $res = [
                "status" => false,
                "massage" => "Post not found"
            ];
            echo json_encode($res);
        } else {
            $post = mysqli_fetch_assoc($post);
            echo json_encode($post);
        }
    }

    public static function addPost($connection, $data, $file_data)
    {
        if (empty($data['disc']) || empty($file_data['file'])) {

            http_response_code(400);
            $res = [
                "status" => false,
                "message" => 'Some data is not filled'
            ];
        } else {
            if (!is_dir('download/')){
                mkdir('download/', '0777', true);
            }
            $extension = pathinfo($file_data['file']['name'], PATHINFO_EXTENSION);
            $file_name = time() . ".$extension";
            $file_path =  'download/'. $file_name;
            $file = $file_data['file']['tmp_name'];
            if (move_uploaded_file($file, $file_path)){
                $disc = $data['disc'];
                $tags = explode(' ', $data['tags']);
//                print_r($tags);
                $connection->query("INSERT INTO `posts` (`id_post`,`id_user`,`source`,`disc`,`img_name`,`img`) VALUES
                                (NULL,1,NULL,'$disc','$file_name','$file_path');");

                http_response_code(201);
                $res = [
                    "status" => true,
                    "post_id" => mysqli_insert_id($connection)
                ];
            } else {
                http_response_code(400);
                $res = [
                    "status" => false,
                    "message" => "File can't be uploaded"
                ];
            }

        }
        echo json_encode($res);
    }

    public static function getSubtable($connection, $query){
        print_r($query);
            $posts = $connection->query("SELECT posts.id_post, posts.img, posts.img_name
                                        FROM posts INNER JOIN post_tags, post_authors ON ");
        $postsList = [];
        while ($post = mysqli_fetch_assoc($posts)) {
            $postsList[] = $post;
        }
        echo json_encode($postsList);
    }

    public static function delPost($connection, $id)
    {
        $id = intval($id);

        $result = $connection->query("SELECT img_name FROM `posts` WHERE `posts`.`id_post` = '$id'");
        $result = mysqli_fetch_assoc($result);
        if (file_exists('download/' . $result['img_name'])){
            unlink('download/' . $result['img_name']);
        };

        $connection->query("DELETE FROM `posts` WHERE `posts`.`id_post` = '$id'");
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => 'Post is deleted',
            "orderID" => $id
        ];
        echo json_encode($res);
    }

    public static function getCount($connection)
    {
        $posts = $connection->query("SELECT count FROM count_posts");
        echo(mysqli_fetch_assoc($posts)['count']);
    }
}
