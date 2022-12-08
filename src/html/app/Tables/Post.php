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

        $user_id = $data['user_id'];
        $author_name = $data['author_name'];
        $src = $data['src'];
        if (isset($data['file'])) {
            $file = $data['file'];
        } else {
            $file = $file_data['file'];
        }
        $disc = $data['disc'];
        $tags_arr = json_decode($data['tags_arr']);
        $characters_arr = json_decode($data['characters_arr']);
        $tags = implode(",", $tags_arr) ;
        $characters = implode(",", $characters_arr);
        $error_fields = [];

        if ($author_name === '') {
            $error_fields[] = 'author_name';
        }

        if ($src === '') {
            $error_fields[] = 'src';
        }

        if (isset($data['file'])) {
            $file = $data['file'];
            if ($file) {
                $error_fields[] = 'file';
            }
        } else {
            $file = $file_data['file'];
            if ($file['name'] == "") {
                $error_fields[] = 'file';
            }
        }

        if (!empty($error_fields)) {
            $res = [
                "status" => false,
                "type" => 1,
                "message" => "Проверьте правильность полей",
                "fields" => $error_fields
            ];

            echo json_encode($res);



            die();
        }

        if (!is_dir('download/')) {
            mkdir('download/', '0777', true);
        }
        $extension = pathinfo($file_data['file']['name'], PATHINFO_EXTENSION);
        $file_name = time() . ".$extension";
        $file_path = 'download/' . $file_name;
        $file = $file_data['file']['tmp_name'];
        if (move_uploaded_file($file, $file_path)) {
            $req = ("INSERT INTO posts (id_user, id_author, source, disc, img_name, img)
                    SELECT p.id_user, a.id_author, p.source, p.disc, p.img_name, p.img
                    FROM (
                        SELECT '$user_id' id_user, '$author_name' author_name, '$src' source, '$disc' disc, '$file_name' img_name, '$file_path' img
                    ) p
                    JOIN authors a ON a.author = p.author_name");
            $connection->query("$req");

            $insert_id = mysqli_insert_id($connection);

            $connection->query("INSERT INTO tags VALUES ($insert_id,$tags)");
            $connection->query("INSERT INTO characters VALUES ('$insert_id',$characters)");
            $connection->query("UPDATE authors SET count = count + 1 WHERE authors.author = '$author_name'");


            http_response_code(201);
            $res = [
                "status" => true,
                "post_id" => $insert_id
            ];
        } else {
            http_response_code(200);
            $res = [
                "status" => false,
                "message" => "File can't be uploaded"
            ];
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
