<?php
require_once 'Base_API.php';
require_once 'Vendor/imgResize.php';

class Post extends Base_API
{

    public function getPosts($connection)
    {
        $posts = $connection->query("SELECT * FROM `posts` ORDER BY `id_post` DESC");
        $postsList = [];
        while ($post = mysqli_fetch_assoc($posts)) {
            if (isset($post['img'])){
//                    try {
////                    $image = new imgResize($post['img']);
////                    $image->resize(206, 0);
////                    $post['img'] = $image->getImg();
////                list($widh, $height, $type)=getimagesizefromstring($post['img']);
////
////                    echo $widh, '      ', $height, '       ', $type, '     ';
//                } catch (Exception $error)   {
//                    echo $error;
//                }
                $post['img'] = base64_encode($post['img']);
            }
            $postsList[] = $post;
        }
        echo json_encode($postsList);
    }


    public function getPost($connection, $id)
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
            if ($post['img'] !== NULL){
                $post['img'] = base64_encode($post['img']);
            }
            echo json_encode($post);
        }
    }

    public function addPost($connection, $data, $file_data)
    {
        if (empty($data['disc']) || empty($file_data['file'])) {
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => 'Some data is not filled'
            ];
        } else {
            $disc = $data['disc'];
            $img = addslashes(file_get_contents($file_data['file']['tmp_name']));
            $type = $file_data['file']['type'];
            $connection->query("INSERT INTO `posts` (`id_post`,`id_user`,`source`,`disc`,`dateTime`,`img_type`,`img`) VALUES
                                (NULL,1,NULL,'$disc',NULL,'$type','$img');");

            http_response_code(201);
            $res = [
                "status" => true,
                "post_id" => mysqli_insert_id($connection)
            ];
        }
        echo json_encode($res);
    }

    public function delPost($connection, $id)
    {
        $id = intval($id);
        $connection->query("DELETE FROM `posts` WHERE `posts`.`id_post` = '$id'");
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => 'Order is deleted',
            "orderID" => $id
        ];
        echo json_encode($res);
    }
}
