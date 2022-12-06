$(document).ready(function () {
    let id = $('.post').attr('id');
    $.getJSON(
        'http://localhost:8080/api/post/' + id,
        function(post){
            let newImage = $('<img src="http://localhost:8080/api/' + post.img + '"' +
                'class="card bd-placeholder-img "' +
                'alt="${post.img_name}">');
            $('.post').append(newImage);
        }
    );
});

// float-end