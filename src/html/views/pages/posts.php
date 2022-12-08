<?php

$page = $_GET['page'] ?? 1;
$request = $_GET['r'] ?? 0; //request

use App\Services\Page;

?>


<!DOCTYPE html>
<html lang="ru">

<?php Page::part('head'); ?>

<body class="container-fluid p-3 px-5" id="<?=$request?>">

<?php Page::part('navbar');?>




<div class="d-flex p-4 g-4">
    <div class=" d-flex flex-column align-self-start mt-2" style="min-width: 10rem;">
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>

    </div>
    <div class=" d-flex flex-column container-fluid">
        <div class="d-flex flex-wrap posts-list" id="<?=$page?> " style="min-height: 640px;"></div>
        <?php Page::part('pagination'); ?>
    </div>
</div>



<?php Page::part('scripts'); ?>
<script src="/assets/js/posts.js"></script>
</body>

</html>