<?php
session_start();

use App\Services\Page;

?>


<!DOCTYPE html>
<html lang="ru">

<?php Page::part('head'); ?>

<body class="container-fluid p-3 px-5">

<?php
if (!empty($_SESSION['user'])) {
    Page::part('navbarUser');

} else{
    Page::part('navbar');
}
?>

<div class="d-flex p-4 g-4">
    <div class=" d-flex flex-column align-self-start mt-2" style="min-width: 10rem;">
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>
        <div class="ps-3">.col-6 .col-sm-3</div>

    </div>
    <div class="d-flex flex-wrap posts-list"></div>
</div>

<!--    col-sm-2-->


<?php Page::part('scripts'); ?>
<script src="/assets/js/posts.js"></script>
</body>

</html>