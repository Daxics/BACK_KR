<?php

function getPosts($connection)
{
    $posts = $connection->query("SELECT * FROM posts");
    $postsList = [];
    while ($post = mysqli_fetch_assoc($posts)) {
        $postsList[] = $post;
    }
    echo json_encode($postsList);
}

function getPost($connection, $id)
{
    $post = $connection->query("SELECT * FROM `posts` WHERE `id` = '$id'");
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


function addPosts($connection, $data, $file_data)
{
    if (empty($data['disc']) || empty($file_data['file'])) {
        http_response_code(400);
        $res = [
            "status" => false,
            "message" => 'Some data is not filled'
        ];
        echo json_encode($res);
    } else {
        $disc = $data['disc'];
        $img = addslashes(file_get_contents($file_data['file']['tmp_name']));
        $img = base64_encode($img);
        $connection->query("INSERT INTO posts VALUES (NULL, '$disc' ,'$img')");
        http_response_code(201);
        $res = [
            "status" => true,
            "post_id" => mysqli_insert_id($connection)
        ];
        echo json_encode($res);
    }
}

function updateOrder($connection, $id, $data)
{
    if (empty($data['name']) || empty($data['order'])) {
        http_response_code(400);
        $res = [
            "status" => false,
            "message" => 'Some data is not filled'
        ];

        echo json_encode($res);
        return;
    }

    $name = $data['name'];
    $order = $data['order'];
    $connection->query("UPDATE `orders` SET `name` = '$name', `order` = '$order' WHERE `orderID` = '$id'");

    http_response_code(200);
    $res = [
        "status" => true,
        "message" => 'Order is updated'
    ];

    echo json_encode($res);
}

function deleteOrder($connection, $id)
{
    $id = intval($id);
    $connection->query("DELETE FROM `orders` WHERE `orders`.`orderID` = '$id'");
    http_response_code(200);
    $res = [
        "status" => true,
        "message" => 'Order is deleted',
        "orderID" => $id
    ];

    echo json_encode($res);
}

function deleteFile($connection, $id)
{
    $id = intval($id);
    $result = $connection->query("SELECT name FROM `uploaded_files` WHERE `uploaded_files`.`id` = '$id'");
    $result = mysqli_fetch_assoc($result);
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/download/' . $result['name'])) {
        unlink($_SERVER['DOCUMENT_ROOT'] . '/download/' . $result['name']);
    };
    $connection->query("DELETE FROM `uploaded_files` WHERE `uploaded_files`.`id` = '$id'");
    http_response_code(200);
    $res = [
        "status" => true,
        "message" => 'File is deleted',
        "fileID" => $id
    ];
    echo json_encode($res);
}
