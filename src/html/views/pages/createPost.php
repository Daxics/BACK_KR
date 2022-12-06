<?php

session_start();

use App\Services\Page;

?>

<!DOCTYPE html>
<html lang="en">

<?php Page::part('head'); ?>

<body class="container-fluid p-3 px-5">

<?php Page::part('navbar');?>

<div class="container p-3">
    <div class="mb-3">
        <label for="formFile" class="form-label">Default file input example</label>
        <input class="form-control" type="file" id="formFile" accept="image/png, image/jpeg, image/bmp">
    </div>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="min-height: 100px"></textarea>
        <label for="floatingTextarea2">Description</label>
    </div>
    <label class="form-label py-3">Default file input example</label>
    <form class="d-flex pb-3" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>
    <ul class="list-group">
        <li class="list-group-item">
            <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
            <label class="form-check-label" for="firstCheckbox">First checkbox</label>
        </li>
        <li class="list-group-item">
            <input class="form-check-input me-1" type="checkbox" value="" id="secondCheckbox">
            <label class="form-check-label" for="secondCheckbox">Second checkbox</label>
        </li>
        <li class="list-group-item">
            <input class="form-check-input me-1" type="checkbox" value="" id="thirdCheckbox">
            <label class="form-check-label" for="thirdCheckbox">Third checkbox</label>
        </li>
    </ul>
</div>

<?php Page::part('scripts'); ?>
<script src="/assets/js/create_post.js"></script>
</body>

</html>