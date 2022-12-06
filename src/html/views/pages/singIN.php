<?php
session_start();

if (!empty($_SESSION['user'])) {
    header('Location: /posts.php');
}

use App\Services\Page;

?>

<!DOCTYPE html>
<html lang="en">

<?php Page::part('head'); ?>

<body class="container-fluid p-3 px-5">

<?php Page::part('navbar'); ?>

<form class="position-absolute top-50 start-50
            translate-middle border border-2 rounded p-3" style="min-width: 30rem;">
    <h1 class="mt-2 mb-3">Sign In</h1>

    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control"
               name="nickName">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control"
               name="password">
    </div>
<!--    <div class="mb-3 form-check">-->
<!--        <input type="checkbox" class="form-check-input"-->
<!--               id="exampleCheck1">-->
<!--        <label class="form-check-label" for="exampleCheck1">Check me out</label>-->
<!--    </div>-->
    <div class="d-grid gap-2 col-8 mx-auto">
        <div class="form-text text-danger msg d-none text-center"></div>

        <button type="submit" class="btn btn-primary btn-lg btn-log mt-2 mb-2">Login</button>
    </div>

</form>

<?php Page::part('scripts'); ?>
<script src="/assets/js/singIN.js"></script>
</body>

</html>