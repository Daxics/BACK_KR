<?php

use App\Services\Router;

Router::page('/test.php', 'test.php');
Router::page('/singUP.php', 'singUP.php');
Router::page('/singIN.php', 'singIN.php');
Router::page('/home.php', 'singIN.php');

Router::enable();