<?php
session_start();

if (!empty($_SESSION['user'])) {
    header('Location: ../index.html');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>


<form class="position-absolute top-50 start-50
            translate-middle border border-2 rounded p-3">
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
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input"
               id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <div class="d-grid gap-2 col-8 mx-auto">
        <div class="form-text text-danger msg d-none"></div>

        <button type="submit" class="btn btn-primary btn-lg btn-log">Login</button>
        <div class="text-center">
            <a href="registr.php" class="text-decoration-none">Registration</a>
        </div>
    </div>

</form>

<script src="JS/jquery-3.6.1.min.js"></script>
<script
        src="JS/singIN.js"></script>
</body>

</html>