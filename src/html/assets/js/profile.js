$(document).ready(function () {
    let id = $('.user-info').attr('id');
    console.log(id);
    $.getJSON(
        'http://localhost:8080/api/user/' + id,
        function(post){

            $('.post').append(newImage);
        }
    );
});


$('.navbar-nav .user').each(function () {
    let id = $('.user-info').attr('id');
    let hr = $(this).attr('href').split("?")[1].split('&')[0].split('=')[1];
    if (hr !== id) {
        $(this).removeClass("text-primary");
    }
});
