<?php

use App\Tables\Post;

if ($method == "GET" && isset($id)){
    switch ($id){
        case 'posts':
            Post::getCount($connect, $_GET['author'] ?? '', $_GET['tags'] ?? '', $_GET['characters'] ?? '');
            break;
    }
}
