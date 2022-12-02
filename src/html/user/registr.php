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


<form onsubmit="return false" class="position-absolute top-50 start-50
            translate-middle border border-2 rounded p-3 js-form"
      id="prospects_form">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input type="text" class="form-control js-input"
               name="nickName">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control js-input" name="e-mail">
        <div id="emailHelp" class="form-text">We'll never share your
            email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control js-input"
               name="password">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Confirm
            your password</label>
        <input type="password" class="form-control js-input"
               name="password-ex">
        <div id="passHelp" class="form-text text-danger"></div>
    </div>
    <div class="d-grid gap-2 col-8 mx-auto">
        <button type="submit" class="btn btn-primary btn-lg"
                onclick="sex()">Register</button>
        <div class="text-center">
             <a href="index.php" class="text-decoration-none">Login</a>
        </div>
    </div>

</form>


<script src="JS/register.js"></script>
</body>

</html>