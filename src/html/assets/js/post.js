$(document).ready(function () {
    let id = $('.post').attr('id');
    $.getJSON(
        'http://localhost:8000/api/post/' + id,
        function(post){
            let newImage = $(`<img src="http://localhost:8000/api/${post.img}"
                class="card bd-placeholder-img"
            alt="${post.img_name}" style="max-width: 95.5rem">`);
            $('.post').append(newImage);
        }
    );
});