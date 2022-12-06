<?php

use App\Services\Pagination;

$page = $_GET['page'] ?? 1;
$per_page = 26;
$total = $_GET['z'] ?? 0;
$pagination = new Pagination((int)$page, $per_page, $total);
$start = $pagination->get_start();

echo $pagination;
