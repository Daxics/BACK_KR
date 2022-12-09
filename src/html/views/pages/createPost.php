<?php

use App\Services\Page;


if (empty($_SESSION['user'])) {
    header('Location: /');
}


?>

<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<?php Page::part('head'); ?>
<link href="/assets/css/createPost.css" rel="stylesheet">
<link href="/assets/css/select2-bootstrap4.min.css" rel="stylesheet">

<body class="container-fluid p-3 px-5" id="<?=$_SESSION['user']['id_user']?>">

<?php Page::part('navbar');?>

    <form class="container post-form">
        <h1 for="basic-url" class="form-label p-3">Post creating form</h1>

        <div class="search-border border border-0 form-control p-0">
            <select class="js-example form-control text-area" name="author">
                <option value=""></option>
            </select>
        </div>


            <div class="input-group mb-3 pt-3">
                <span class="input-group-text" id="basic-addon3">Image source</span>
                <input type="text" class="form-control text-area" aria-describedby="basic-addon3" name="src">
            </div>
        <div class="mb-3">
            <input class="form-control text-area" type="file" id="formFile"
                   accept="image/png, image/jpeg, image/bmp" name="file">
        </div>
        <div class="form-floating">
                    <textarea class="form-control text-area" placeholder="Leave a comment
                        here" id="floatingTextarea2" style="min-height: 100px" name="disc"></textarea>
            <label for="floatingTextarea2">Description</label>
        </div>
        <nav>
            <div class="d-flex pt-3">
                <h4 class="form-label p-3">Post's tags selection</h4>
            </div>


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
                <div data-bs-smooth-scroll="true" class="scrollspy-example bg-light p-3  rounded-2" style="overflow: auto; max-height:300px;">
                <ul class="list-group first-list"></ul>
                </div>
            </div>

            <div class="tab-pane second-search fade" id="nav-characters"
                 role="tabpanel"
                 aria-labelledby="nav-characters-tab" tabindex="0">
                <div class="d-flex py-3" role="search">
                    <input class="form-control second-search" type="search"
                           placeholder="Search" aria-label="Search">
                </div>
                <div data-bs-smooth-scroll="true" class="scrollspy-example bg-light p-3  rounded-2" style="overflow: auto; max-height:300px;">
                <ul class="list-group second-list"></ul>
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 p-3">
            <div class="form-text text-danger msg d-none text-center"></div>
            <button class="btn btn-primary submit btn-lg mx-auto" type="button"  style="width: 15rem;">Button</button>
        </div>
    </form>


<?php Page::part('scripts'); ?>
<script src="/assets/js/create_post.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>