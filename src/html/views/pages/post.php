<?php

session_start();

use App\Services\Page;

?>

<!DOCTYPE html>
<html lang="en">

<?php Page::part('head'); ?>

<body class="container-fluid p-3 px-5">

<?php Page::part('navbar');?>


<div class="d-flex p-4 g-4">
    <div class=" d-flex flex-column align-self-start mt-2" style="min-width: 13rem;">
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>

    </div>
    <div class="w-100 post" id="<?=$_GET['id']?>"></div>
</div>



<?php Page::part('scripts'); ?>
<script src="/assets/js/post.js"></script>
</body>

</html>