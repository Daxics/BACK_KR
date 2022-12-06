$(document).ready(function () {
    let id = ($('.posts-list').attr('id') - 1) * 24;
    $.getJSON(
        'http://localhost:8000/api/posts?s=' + id,
        function (posts) {
            posts.forEach((post) => {
                let newImage = $(`
                    <div class="p-2">
                        <div class="card" style="width: 11.5rem;">
                        <a href="/post.php?id=${post.id_post}">
                            <img src="http://localhost:8000/api/${post.img}" class="card bd-placeholder-img rounded float-start"
                             style="width: 11.5rem;  alt="${post.img_name}">
                        </a>
                        </div>
                    </div>
                `);
                $('.posts-list').append(newImage);
            })
        }
    );
});

let req = $('body').attr('id');
console.log(req);
