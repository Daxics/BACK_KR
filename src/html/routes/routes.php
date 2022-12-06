<?php

use App\Services\Router;

Router::page('/singUP', 'singUP');
Router::page('/singIN', 'singIN');
Router::page('/post', 'post');
Router::page('/posts', 'posts');
Router::page('/profile', 'profile');
Router::page('/tags', 'tags');
Router::page('/authors', 'authors');
Router::page('/createPost', 'createPost');
Router::page('/logout', 'logOUT');
Router::page('/comments', 'comments');

Router::enable();