<?php

namespace App\Controller;


class Author
{
    public static function getAuthorLimmit($connection, $start){
        $authors = $connection->query("SELECT * FROM authors LIMIT {$start},12");
        $authorsList = [];
        while ($author = mysqli_fetch_assoc($authors)) {
            $authorsList[] = $author;
        }
        echo json_encode($authorsList);
    }

    public static function getAuthors($connection){
        $authors = $connection->query("SELECT * FROM authors");
        $authorsList = [];
        while ($author = mysqli_fetch_assoc($authors)) {
            $authorsList[] = $author;
        }
        echo json_encode($authorsList);
    }

    public static function getAuthor($connection, $id) {
        $post = $connection->query("SELECT * FROM `authors` WHERE `id_author` = '$id'");
        if (mysqli_num_rows($post) === 0) {
            http_response_code(404);
            $res = [
                "status" => false,
                "massage" => "Author not found"
            ];
            echo json_encode($res);
        } else {
            $post = mysqli_fetch_assoc($post);
            echo json_encode($post);
        }
    }


    public static function setAythor($connection, $author)
    {
        if (empty($author['author'])) {
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => 'Some data is not filled or you have entered incorrect values'
            ];
        } else {
            $author = $author['author'];
            $check_author = $connection->query("SELECT * FROM authors WHERE `author` = '$author'");
            if (mysqli_num_rows($check_author) > 0) {
                http_response_code(400);
                $res = [
                    "status" => false,
                    "type" => 1,
                    "message" => "Такой автор уже существует",
                ];
            } else {
                $connection->query("INSERT INTO authors (`author`) VALUES ('$author')");
                http_response_code(201);
                $res = [
                    "status" => true,
                    "post_id" => mysqli_insert_id($connection)
                ];
            }
        }
        echo json_encode($res);
    }

    public static function updateAuthor($connection, $id, $data){

        if(empty($data['name'])){
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => 'Some data is not filled'
            ];

            echo json_encode($res);
            return;
        }

        $author_name = $data['name'];
        $connection->query("UPDATE authors SET author = '$author_name'WHERE id_author = '$id'");

        http_response_code(200);
        $res = [
            "status" => true,
            "message" => 'Author is updated'
        ];

        echo json_encode($res);
    }

    public static function deliteAuthor($connection, $id){

        $id = intval($id);

        $connection->query("DELETE FROM authors WHERE authors.id_author = '$id'");
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => 'Author is deleted',
            "orderID" => $id
        ];
        echo json_encode($res);
    }
}