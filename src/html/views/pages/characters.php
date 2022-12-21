<?php

use App\Services\Page;

?>


<!DOCTYPE html>
<html lang="ru">

<?php Page::part('head'); ?>
<link href="/assets/css/createPost.css" rel="stylesheet">

<body class="container-fluid p-3 px-5">

<?php Page::part('navbar');?>


<div class="container">

    <?php
    if(($_SESSION['user']['id_user'] ?? 0) == 1){
        echo '<div class="form-floating mt-4 comm-input" style="max-width: 50rem">';
        echo '<input type="text" class="form-control" id="floatingInputValue" name="author">';
        echo '<label for="floatingInputValue">Author name</label>';
        echo '<button class="btn btn-primary m-3 " type="submit" id="publish" name="publish">Create new author</button>';
        echo '<button class="btn btn-primary m-3 hide" type="submit" id="comm-edit" name="comm-edit">Edit</button>';
        echo '</div>';
    }
    ?>
    <h3 class="mt-3 mb-4">Authors:</h3>

    <div class="d-flex flex-wrap" id="author" style="min-height:33rem;"></div>

    <nav aria-label="Page navigation" class="d-flex flex-wrap justify-content-center">
        <ul class="pagination" id="pagination"></ul>
    </nav>
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
<script src="/assets/js/characters.js"></script>
</body>

</html>
