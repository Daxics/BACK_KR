<?php

namespace App\Tables;

class Post
{

    public static function getPost($connection, $id)
    {
        $post = $connection->query("SELECT posts.*, authors.author, users.nickName, authors.count FROM `posts`
                                    INNER JOIN authors ON authors.id_author = posts.id_author
                                    INNER JOIN users ON users.id_user = posts.id_user
                                    WHERE `id_post` = '$id'");
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
        $tags = implode(",", $tags_arr);
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

    public static function getSubtable($connection, $start, $author, $tags, $characters)
    {

        if ($author != '') {
            $author = " AND authors.author =  '$author'";
        }
        $tags_str = "";
        $characters_str = "";

        if ($tags != '') {
            $tags_str = " ";
            $tags = explode(" ", $tags);

            foreach ($tags as $tag) {
                $tags_str = $tags_str . "AND tags." . $tag . "='" . '0x01' . "' ";
            }
        }

        if ($characters != '') {
            $characters_str = " ";
            $characters = explode(" ", $characters);

            foreach ($characters as $character) {
                $characters_str = $characters_str . "AND characters." . $character . "='" . '0x01' . "' ";
            }
        }


        $request = "SELECT posts.id_post, posts.img, posts.img_name
                                        FROM posts
                                        INNER JOIN authors ON authors.id_author = posts.id_author $author
                                        INNER JOIN tags ON tags.id_post = posts.id_post" . $tags_str . "
                                        INNER JOIN characters ON characters.id_post = posts.id_post" . $characters_str . "
                                        ORDER BY `id_post`
                                        DESC LIMIT {$start},27";
//        echo $request;
        $posts = $connection->query("$request");
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
        if (file_exists('download/' . $result['img_name'])) {
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

    public static function getCount($connection, $author, $tags, $characters)
    {

        if ($author != '') {
            $author = " AND authors.author =  '$author'";
        }
        $tags_str = "";
        $characters_str = "";

        if ($tags != '') {
            $tags_str = " ";
            $tags = explode(" ", $tags);

            foreach ($tags as $tag) {
                $tags_str = $tags_str . "AND tags." . $tag . "='" . '0x01' . "' ";
            }
        }

        if ($characters != '') {
            $characters_str = " ";
            $characters = explode(" ", $characters);

            foreach ($characters as $character) {
                $characters_str = $characters_str . "AND characters." . $character . "='" . '0x01' . "' ";
            }
        }


        $request = "SELECT count(posts.id_post) count
                                        FROM posts
                                        INNER JOIN authors ON authors.id_author = posts.id_author $author
                                        INNER JOIN tags ON tags.id_post = posts.id_post" . $tags_str . "
                                        INNER JOIN characters ON characters.id_post = posts.id_post" . $characters_str;
//        echo $request;
        $posts = $connection->query("$request");
        $postsList = [];
        while ($post = mysqli_fetch_assoc($posts)) {
            $postsList[] = $post;
        }
        echo json_encode($postsList);
    }


    public static function patchPost($connection, $data, $id)
    {
        $author_name = $data['author_name'];
        $author_name_old = $data['author_name_old'];
        $src = $data['src'];

        $disc = $data['disc'];
        $tags_arr = json_decode($data['tags_arr']);
        $characters_arr = json_decode($data['characters_arr']);
        $tags = implode(",", $tags_arr);
        $characters = implode(",", $characters_arr);
        $error_fields = [];

        if ($author_name === '') {
            $error_fields[] = 'author_name';
        }

        if ($src === '') {
            $error_fields[] = 'src';
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
        $author_id = $connection->query("SELECT id_author FROM authors WHERE author = '$author_name'");

        $author_id = mysqli_fetch_assoc($author_id);
        $author_id = $author_id['id_author'];


        $req = ("UPDATE posts SET id_author = $author_id, source = '$src', disc = '$disc' WHERE posts.id_post = $id");
        $connection->query("$req");

        $connection->query("DELETE FROM tags  WHERE id_post = $id");
        $connection->query("DELETE FROM characters  WHERE id_post = $id");
        $connection->query("INSERT INTO tags VALUES ($id,$tags)");
        $connection->query("INSERT INTO characters VALUES ($id,$characters)");
        $connection->query("UPDATE authors SET count = count + 1 WHERE author = '$author_name'");
        $connection->query("UPDATE authors SET count = count - 1 WHERE author = '$author_name_old'");


        http_response_code(201);
        $res = [
            "status" => true,
            "post_id" => $id
        ];


        echo json_encode($res);
    }
}
