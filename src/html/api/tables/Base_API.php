<?php

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




    public function patch($connection, $table, $id, $column, $data){
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
}
