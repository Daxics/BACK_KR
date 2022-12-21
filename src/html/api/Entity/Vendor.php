<?php

use App\Controller\Post;
use App\Controller\Author;
use App\Controller\Character;
use App\Controller\Tag;

if ($method == "GET" && isset($id)){
    switch ($id){
        case 'posts':
            Post::getCount($connect, $_GET['author'] ?? '', $_GET['tags'] ?? '', $_GET['characters'] ?? '');
            break;
        case 'authors':
            Author::getCount($connect);
            break;
        case 'tags':
            Tag::getCount($connect);
            break;
        case 'characters':
            Character::getCount($connect);
            break;
    }
}
