<?php

if (!empty($_SESSION['user'])) {
    header('Location: /');
}

use App\Services\Page;

?>

<!DOCTYPE html>
<html lang="en">

<?php Page::part('head'); ?>

<body class="container-fluid p-3 px-5">

<?php Page::part('navbar'); ?>

<form class="position-absolute top-50 start-50
            translate-middle border border-2 rounded p-3 js-form"  style="min-width: 30rem;">
    <h1 class="mt-2 mb-3">Sign Up</h1>
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control js-input"
               name="nickName">
    </div>
    <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control js-input"
               name="e_mail">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control js-input"
               name="password">
    </div>
    <div class="mb-3">
        <label class="form-label">Confirm
            your password</label>
        <input type="password" class="form-control js-input"
               name="password_con">
    </div>
    <div class="d-grid gap-2 col-8 mx-auto">
        <div class="form-text text-danger msg d-none text-center"></div>
        <button type="submit" class="btn btn-primary btn-lg btn-reg mt-2 mb-2">Register</button>
    </div>

</form>
<?php Page::part('scripts'); ?>
<script src="/assets/js/singUP.js"></script>
</body>

</html>