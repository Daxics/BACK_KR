<?php

use App\Services\Page;

?>

<!DOCTYPE html>
<html lang="en">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<?php Page::part('head'); ?>
<link href="/assets/css/createPost.css" rel="stylesheet">
<link href="/assets/css/select2-bootstrap4.min.css" rel="stylesheet">

<body class="container-fluid p-3 px-5" id="">

<?php Page::part('navbar');?>


<div class="d-flex p-4 g-4 ">
    <div class=" d-flex flex-column align-items-stretch mt-2 me-4 border-end" style="min-width: 13rem; max-width: 14rem" id="post-information">
        <div class=" d-flex flex-column align-self-start">
            <div id="author">
                <div class="ps-3 fs-4 fw-semibold mt-2" >Author:</div>
            </div>
            <div id="characters">
                <div class="ps-3 fs-4 fw-semibold mt-2" >Characters:</div>
            </div>
            <div id="tags">
                <div class="ps-3 fs-4 fw-semibold mt-2" >Tags:</div>
            </div>
        </div>
        <div class=" d-flex flex-column align-self-start " style="min-width: 13rem; max-width: 14rem">
            <div id="information">
                <div class="ps-3 fs-4 fw-semibold mt-2" >Information:</div>
            </div>
        </div>
        <div class="me-5" id="btn-post">
            <?php
            if (($_SESSION['user']['id_role'] ?? 0 ) == 1){
                echo '<a class="pe-3" href="#edit-form" style="width: 100%"><button class="btn btn-outline-primary mt-3 me-3" type="button" id="edit" style="width: 100%">Edit post</button></a>';
                echo '<button class="btn btn-outline-danger mt-2" style="width: 100%" data-bs-toggle="modal" data-bs-target="#exampleModal"  type="button" id="delete">Delete post</button>';
            }
            ?>
        </div>


    </div>
    <div>
        <div class="border-bottom ">
            <div class="w-100 post " id="<?=$_GET['id'] ?? 0?>"></div>
            <div class="card-body">
                <h3 class="card-title my-3">Description</h3>
                <p class="card-text mb-3" id="dexc"></p>
            </div>
        </div>




        <form class="container post-form hide" id="edit-form">
            <h1 for="basic-url" class="form-label p-3">Post editing form</h1>

            <div class="search-border border border-0 form-control p-0">
                <select class="js-example form-control text-area" name="author">
                </select>
            </div>


            <div class="input-group mb-3 pt-3">
                <span class="input-group-text" id="basic-addon3">Image source</span>
                <input type="text" class="form-control text-area" aria-describedby="basic-addon3" name="src">
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
                <button class="btn btn-primary submit btn-lg mx-auto" type="button" id="edit-post"  style="width: 15rem;">Edit</button>
            </div>
        </form>






        <?php
        if(isset($_SESSION['user'])){
            echo '<div class="form-floating mt-4 comm-input" style="max-width: 50rem" id="' . $_SESSION['user']['id_user'] . '">';
            echo '<textarea class="form-control" placeholder="Leave a comment here" name="comment" id="floatingTextarea1" style="min-height: 100px"></textarea>';
            echo '<label for="floatingTextarea1" >Comment</label>';
            echo '<button class="btn btn-primary m-3 " type="submit" id="publish" name="publish">Publish</button>';
            echo '<button class="btn btn-primary m-3 hide" type="submit" id="comm-edit" name="comm-edit">Edit</button>';
            echo '</div>';
        }
        ?>
        <h3 class="mt-3 mb-4">Comments:</h3>
        <div id="comments"></div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm the action!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="accept-btn">Delete</button>
                    </div>
                </div>
            </div>
        </div>


</div>



<?php Page::part('scripts'); ?>
<script src="/assets/js/form.js"></script>
<script src="/assets/js/post.js"></script>
<script src="/assets/js/comments.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>