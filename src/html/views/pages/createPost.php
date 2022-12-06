<?php

use App\Services\Page;

?>

<!DOCTYPE html>
<html lang="en">

<?php Page::part('head'); ?>

<body class="container-fluid p-3 px-5">

<?php Page::part('navbar');?>

    <div class="container p-3">
        <div class="my-3">
            <input class="form-control" type="file" id="formFile"
                   accept="image/png, image/jpeg, image/bmp">
        </div>
        <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment
                        here" id="floatingTextarea2" style="min-height: 100px"></textarea>
            <label for="floatingTextarea2">Description</label>
        </div>
        <nav>
            <label class="form-label py-3">Post's tags selection</label>

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
                <button class="nav-link" id="nav-authors-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-authors" type="button" role="tab"
                        aria-controls="nav-authors" aria-selected="false">Authors</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-tags"
                 role="tabpanel"
                 aria-labelledby="nav-tags-tab" tabindex="0">
                <div class="d-flex py-3" role="search">
                    <input class="form-control me-2" type="search"
                           placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <input class="form-check-input me-1"
                               type="checkbox"
                               value="" id="firstCheckbox">
                        <label class="form-check-label"
                               for="firstCheckbox">First
                            checkbox</label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input me-1"
                               type="checkbox"
                               value="" id="secondCheckbox">
                        <label class="form-check-label"
                               for="secondCheckbox">Second checkbox</label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input me-1"
                               type="checkbox"
                               value="" id="thirdCheckbox">
                        <label class="form-check-label"
                               for="thirdCheckbox">Third
                            checkbox</label>
                    </li>
                </ul>
            </div>

            <div class="tab-pane fade" id="nav-characters"
                 role="tabpanel"
                 aria-labelledby="nav-characters-tab" tabindex="0">
                <div class="d-flex py-3" role="search">
                    <input class="form-control me-2" type="search"
                           placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox"
                               value="" id="firstCheckbox">
                        <label class="form-check-label" for="firstCheckbox">First
                            checkbox</label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox"
                               value="" id="secondCheckbox">
                        <label class="form-check-label"
                               for="secondCheckbox">Second checkbox</label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox"
                               value="" id="thirdCheckbox">
                        <label class="form-check-label" for="thirdCheckbox">Third
                            checkbox</label>
                    </li>
                </ul>
            </div>

            <div class="tab-pane fade" id="nav-authors"
                 role="tabpanel"
                 aria-labelledby="nav-authors-tab" tabindex="0">
                <div class="d-flex py-3" role="search">
                    <input class="form-control me-2" type="search"
                           placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox"
                               value="" id="firstCheckbox">
                        <label class="form-check-label" for="firstCheckbox">First
                            checkbox</label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox"
                               value="" id="secondCheckbox">
                        <label class="form-check-label"
                               for="secondCheckbox">Second checkbox</label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox"
                               value="" id="thirdCheckbox">
                        <label class="form-check-label" for="thirdCheckbox">Third
                            checkbox</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>


<?php Page::part('scripts'); ?>
<script src="/assets/js/create_post.js"></script>
</body>

</html>