<?php

use App\Services\Router;

Router::page('/test.php', 'test.php');
Router::page('/test2', 'test2');

Router::enable();