<?php

use App\Services\Page;


if (empty($_SESSION['user'])) {
    header('Location: /');
}


?>

<!DOCTYPE html>
<html lang="en">

<?php Page::part('head'); ?>

<body class="container-fluid p-3 px-5">

<?php Page::part('navbar');?>

    <div class="container p-3">
        <div class="my-3">
            <input class="form-control" type="file" id="formFile"
                   accept="image/png, image/jpeg, image/bmp">
        </div>
        <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment
                        here" id="floatingTextarea2" style="min-height: 100px"></textarea>
            <label for="floatingTextarea2">Description</label>
        </div>
        <nav>
            <label class="form-label py-3">Post's tags selection</label>

            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-tags-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-tags" type="button" role="tab"
                        aria-controls="nav-tags" aria-selected="true">Tags</button>
                <button class="nav-link" id="nav-characters-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-characters" type="button"
                        role="tab"
                        aria-controls="nav-characters" aria-selected="false">Characters</button>
                <button class="nav-link" id="nav-authors-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-authors" type="button" role="tab"
                        aria-controls="nav-authors" aria-selected="false">Authors</button>
            </div>
        </nav>
        <div class="tab-content " id="nav-tabContent">

            <div class="tab-pane first-search fade show active" id="nav-tags"
                 role="tabpanel"
                 aria-labelledby="nav-tags-tab" tabindex="0">
                <div class="d-flex py-3" role="search">
                    <input class="form-control" type="search"
                           placeholder="Search" aria-label="Search">
                </div>
                <ul class="list-group first-list"></ul>
            </div>

            <div class="tab-pane second-search fade" id="nav-characters"
                 role="tabpanel"
                 aria-labelledby="nav-characters-tab" tabindex="0">
                <div class="d-flex py-3" role="search">
                    <input class="form-control second-search" type="search"
                           placeholder="Search" aria-label="Search">
                </div>
                <ul class="list-group second-list"></ul>
            </div>

            <div class="tab-pane third-search fade" id="nav-authors"
                 role="tabpanel"
                 aria-labelledby="nav-authors-tab" tabindex="0">
                <div class="d-flex py-3" role="search">
                    <input class="form-control third-search" type="search"
                           placeholder="Search" aria-label="Search">
                </div>
                <ul class="list-group third-list"></ul>
            </div>
        </div>
    </div>


<?php Page::part('scripts'); ?>
<script src="/assets/js/create_post.js"></script>
</body>

</html>