<?php
session_start();

use App\Services\Page;

$id = $_GET['id'] ?? NULL;

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




<div class="container mx-auto pt-5 user-info" id="<?=$id?>">
            <div class="col-md-9 mx-auto">
                <div class="d-flex">
                    <div class="p-2 w-100">
                        <h2>
                            Kshiti Ghelani
                        </h2>
                        <h6 class="mt-3">
                            <a class="text-primary">Log Out</a>
                        </h6>
                    </div>
                    <div class="p-2 flex-shrink-1">
                        <button type="button" class="btn btn-outline-primary">Edit Profile</button>
                        <button type="button" class="btn btn-outline-danger m-3">Delete</button>
                    </div>
                </div>
            </div>
    <ul class="nav nav-tabs col-md-9 mx-auto mb-5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab">About</a>
        </li>
    </ul>
    <div class="col-md-7  mx-auto ">
        <div class="row">
            <div class="col-md-8">
                <label>User Id</label>
            </div>
            <div class="col-md-4 text-primary">
                <p>Kshiti123</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <label>Name</label>
            </div>
            <div class="col-md-4 text-primary">
                <p>Kshiti Ghelani</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <label>Email</label>
            </div>
            <div class="col-md-4 text-primary">
                <p>kshitighelani@gmail.com</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <label>Join Date</label>
            </div>
            <div class="col-md-4 text-primary">
                <p>kshitighelani@gmail.com</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <label>Uploads</label>
            </div>
            <div class="col-md-4 text-primary">
                <p>123 456 7890</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <label>Comments</label>
            </div>
            <div class="col-md-4 text-primary">
                <p>Web Developer and Designer</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <label>Level</label>
            </div>
            <div class="col-md-4 text-primary">
                <p>Web Developer and Designer</p>
            </div>
        </div>
    </div>
</div>





<?php Page::part('scripts'); ?>
<script src="/assets/js/profile.js"></script>
</body>

</html>