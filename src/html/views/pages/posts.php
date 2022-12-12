<?php

use App\Services\Page;

?>


<!DOCTYPE html>
<html lang="ru">

<?php Page::part('head'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous">
<link href="/assets/css/select2-bootstrap4.min.css" rel="stylesheet">
<body class="container-fluid p-3 px-5" id="">

<?php Page::part('navbar');?>



<div class="py-3 d-flex ">
    <div class="px-3" style="min-width: 15rem">
        <select data-placeholder="Choose Author" id="select-author"
                data-allow-clear="1">
            <option></option>
        </select>
    </div>
    <div class="px-3 container-fluid">
        <select multiple data-placeholder="Choose Tags" id="select-tags"
                data-allow-clear="1">
        </select>
    </div>
    <div class="px-3 container-fluid">
        <select multiple data-placeholder="Choose Characters" id="select-characters"
                data-allow-clear="1">
        </select>
    </div>
    <button class="btn btn-primary" type="submit" id="search">Search</button>

</div>
<div class="d-flex px-4  g-4">
    <div class=" d-flex flex-column container-fluid">
        <div class="d-flex flex-wrap posts-list" style="min-height: 47rem;" id="posts-list"></div>
        <nav aria-label="Page navigation" class="d-flex flex-wrap justify-content-center ">
            <ul class="pagination " id="pagination"></ul>
        </nav>
    </div>
</div>



<?php Page::part('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" integrity="sha256-AFAYEOkzB6iIKnTYZOdUf9FFje6lOTYdwRJKwTN5mks=" crossorigin="anonymous"></script>
<script src="/assets/js/pagination.js"></script>
<script src="/assets/js/posts.js"></script>

</body>

</html>