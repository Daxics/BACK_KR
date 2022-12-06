<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid ma fs-5">
        <a class="navbar-brand ma fs-4" href="/posts.php">My Service</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="/posts">Posts</a>
                <a class="nav-link" href="/tags">Tags</a>
                <a class="nav-link" href="/authors">Authors</a>
                <?php if (!empty($_SESSION['user'])) {
                    ?>
                    <a class="nav-link" href="/createPost">Create Post</a>
                    <?php
                }?>
            </div>
        </div>
        <div class="navbar-nav">
            <?php
            if (!empty($_SESSION['user'])) {
            ?>
                <a class="nav-link user" href="/profile?id=<?=$_SESSION['user']['id_user']?>">Profile</a>
                <a class="nav-link user text-danger" href="/logout?>">Log Out</a>
                <?php
            } else{
            ?>
                <a class="nav-link" href="/singIN">Login</a>
                <a class="nav-link" href="/singUP">Register</a>
                <?php
            }
            ?>
        </div>
    </div>
</nav>