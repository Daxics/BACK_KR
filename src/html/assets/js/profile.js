$(document).ready(function () {
    let id = $('.user-info').attr('id');
    console.log(id);
    $.getJSON(
        'http://localhost:8000/api/user/' + id,
        function(main){
            $('.id').text(main.id_user);
            $('.name').text(main.nickName);
            $('.e_mail').text(main.e_mail);
            $('.date').text(main.dateTime);
            $('.level').text(main.role);
            $('.uploads').text(main.count_posts);
        }
    );
    $.getJSON(
        'http://localhost:8000/api/count_comm/' + id,
        function(comm){
            $('.comments').text(comm.count);
        }
    );
});


$('.navbar-nav .user').each(function () {
    let id = $('.user-info').attr('id');
    let hr = $(this).attr('href').split("?")[1].split('&')[0].split('=')[1];
    console.log(hr);
    if (hr !== id) {
        $(this).removeClass("text-primary");
    }
});
