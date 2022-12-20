<?php

use App\Services\Page;

$id = $_GET['id'] ?? NULL;

?>


<!DOCTYPE html>
<html lang="ru">

<?php Page::part('head'); ?>

<body class="container-fluid p-3 px-5">


<?php Page::part('navbar');?>



<div class="container mx-auto pt-5 user-info" id="<?=$id?>">
            <div class="col-md-9 mx-auto">
                <div class="d-flex">
                    <div class="p-2 w-100">
                        <h1 class="name text-primary">
                            Wrong user
                        </h1>
                    </div>

                    <div class="p-2 flex-shrink-1 btn-body"></div>

                </div>
            </div>

    <nav>
        <div class="nav nav-tabs col-md-9 mx-auto mb-5" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-about-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#nav-about" type="button"
                    role="tab"
                    aria-controls="nav-about" aria-selected="true">About</button>
            <button class="nav-link" id="nav-uploads-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#nav-uploads" type="button"
                    role="tab"
                    aria-controls="nav-uploads" aria-selected="false">Uploads</button>
            <button class="nav-link" id="nav-comments-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#nav-comments" type="button"
                    role="tab"
                    aria-controls="nav-comments" aria-selected="false">Comments</button>
        </div>
    </nav>




    <div class="tab-content " id="nav-tabContent">

        <div class="tab-pane first-search fade show active" id="nav-about"
             role="tabpanel"
             aria-labelledby="nav-about-tab" tabindex="0">
            <div class="col-md-7  mx-auto ">
                <div class="row">
                    <div class="col-md-8">
                        <label>User Id</label>
                    </div>
                    <div class="col-md-4 text-primary">
                        <p class="id">0</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label>Name</label>
                    </div>
                    <div class="col-md-4 text-primary">
                        <p class="name text-primary">Wrong user</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label>Email</label>
                    </div>
                    <div class="col-md-4 text-primary">
                        <p class="e_mail">0</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label>Join Date</label>
                    </div>
                    <div class="col-md-4 text-primary">
                        <p class="date">0</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label>Level</label>
                    </div>
                    <div class="col-md-4 text-primary">
                        <p class="level">0</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label>Uploads</label>
                    </div>
                    <div class="col-md-4 text-primary">
                        <p class="uploads">0</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label>Comments</label>
                    </div>
                    <div class="col-md-4 text-primary">
                        <p class="comments">0</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane second-search fade"
             id="nav-uploads"
             role="tabpanel"
             aria-labelledby="nav-uploads-tab" tabindex="0">
            <div class="col-md-9 mx-auto mb-3 container-fluid" >
                <div class="d-flex flex-wrap posts-list justify-content-center"
                     style="min-height:33rem;" id="posts-list"></div>

                <nav aria-label="Page navigation" class="d-flex flex-wrap justify-content-center">
                    <ul class="pagination" id="pagination"></ul>
                </nav>
            </div>
        </div>



        <div class="tab-pane third-search fade"
             id="nav-comments"
             role="tabpanel"
             aria-labelledby="nav-comments-tab" tabindex="0">
            <div class="col-md-9 mx-auto mb-3 container-fluid" >
                <div id="comments-list" style="min-height:33rem;"></div>

                <nav aria-label="Page navigation" class="d-flex flex-wrap justify-content-center">
                    <ul class="pagination" id="pagination"></ul>
                </nav>

            </div>
        </div>

    </div>


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


<?php Page::part('scripts'); ?>
<script src="/assets/js/pagination.js"></script>
<script src="/assets/js/profile.js"></script>
<!--<script src="/assets/js/profile_comments.js"></script>-->
</body>

</html>