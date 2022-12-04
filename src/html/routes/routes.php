<?php

use App\Services\Router;

Router::page('/singUP.php', 'singUP.php');
Router::page('/singIN.php', 'singIN.php');
Router::page('/post.php', 'post.php');
Router::page('/posts.php', 'posts.php');
Router::page('/profile.php', 'profile.php');
Router::page('/tags.php', 'tags.php');
Router::page('/authors.php', 'authors.php');

Router::enable();