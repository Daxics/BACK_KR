async function getComments() {
    let id_user = $('.user-info').attr('id');



};

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
            $('.uploads').text(main.posts_count);
            p_c = main.posts_count;

            $('.comments').text(main.comments_count);



            $(function () {
                window.pagObj = $('#pagination').twbsPagination({
                    totalPages: Math.ceil(p_c/10),
                    visiblePages: 10,
                    onPageClick: function (event, page) {
                        console.info(page + ' (from options)');
                        let id_u = $('.user-info').attr('id');
                        $('#posts-list').empty();
                        $.getJSON(
                            'http://localhost:8000/api/user/' + id_u + '?s=' + (page-1)*10,
                            function (posts) {
                                posts.forEach((post) => {
                                    let newImage = $(`
                    <a href="/post?id=${post.id_post}" class="m-1 images">
                            <img
                                src="http://localhost:8000/api/${post.img}"
                                class="card bd-placeholder-img
                                rounded float-start"
                                style="width: 11rem"
                                alt="${post.img_name}">
                        </a>
                `);
                                    $('.posts-list').append(newImage);
                                })
                            }
                        );
                    }
                }).on('page', function (event, page) {
                    console.info(page + ' (from event listening)');
                });
            });

        }
    );
});
