

$(function () {
    let href = document.URL;
    let author, //получаем поле nickName
        tags, //получаем поле nickName
        characters; //получаем поле e_mail
    console.log((href.split('?')))
    if ((href.split('?'))[1]) {
        href = href.split('?');
        href = href[1].split('&');
        author = href[0].split('=')[1]; //получаем поле nickName
        tags = href[1].split('=')[1]; //получаем поле nickName
        characters = href[2].split('=')[1]; //получаем поле e_mail
        if (!author) author = '';
        if (!tags) tags = '';
        if (!characters) characters = '';
    } else {
        if (!author) author = '';
        if (!tags) tags = '';
        if (!characters) characters = '';
    }

    console.log(author)
    console.log(tags)
    console.log(characters)

    let count = 0;

    $.getJSON(
        `http://localhost:8000/api/vendor/posts?author=${author}&characters=${characters}&tags=${tags}`,
        function (posts) {
            count = posts[0].count
            window.pagObj = $('#pagination').twbsPagination({
                totalPages: Math.ceil(count / 27),
                visiblePages: 10,
                onPageClick: function (event, page) {
                    console.info(page + ' (from options)');
                    $('#posts-list').empty();

                    $.getJSON(
                        `http://localhost:8000/api/post?p=${(page - 1) * 27}&author=${author}&characters=${characters}&tags=${tags}`,
                        function (posts) {
                            posts.forEach((post) => {
                                let newImage = $(`
                                    <div class="p-2">
                                        <div class="card" style="width: 11rem;">
                                        <a href="/post?id=${post.id_post}">
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
                }
            }).on('page', function (event, page) {
                console.info(page + ' (from event listening)');
            });
        })
});



$(document).ready(function () {
    let authors_list = [],
        tags_list = [],
        characters_list = [];
    $.getJSON(
        'http://localhost:8000/api/author?t=authors',
        function (authors) {
            $.each(authors, function () {
                let mid_test = this['author'];
                authors_list.push(mid_test)
                $('#select-author').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    allowClear: Boolean($(this).data('allow-clear')),
                    closeOnSelect: !$(this).attr('multiple'),
                    theme: 'bootstrap4',
                    placeholder: "Select art's author",
                    data:authors_list
                });
            });
        });

    $.getJSON(
        'http://localhost:8000/api/tag?t=tags_list',
        function (tags) {
            $.each(tags, function () {
                let mid_test = this['tag_title'];
                tags_list.push(mid_test)
                $('#select-tags').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    allowClear: Boolean($(this).data('allow-clear')),
                    closeOnSelect: !$(this).attr('multiple'),
                    theme: 'bootstrap4',
                    placeholder: "Select art's author",
                    data:tags_list
                });
            });
        });

    $.getJSON(
        'http://localhost:8000/api/character?t=characters_list',
        function (characters) {
            $.each(characters, function () {
                let mid_test = this['character_title'];
                characters_list.push(mid_test)
                $('#select-characters').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    allowClear: Boolean($(this).data('allow-clear')),
                    closeOnSelect: !$(this).attr('multiple'),
                    theme: 'bootstrap4',
                    placeholder: "Select art's author",
                    data:characters_list
                });
            });
        });
});


$('#search').click(function (e) {
    e.preventDefault();
    let author = $('#select-author').val(), //получаем поле nickName
        tags = $('#select-tags').val(), //получаем поле nickName
        characters = $('#select-characters').val(), //получаем поле e_mail
        tags_str = '', //получаем поле e_mail
        characters_str = ''; //получаем поле e_mail

    $(tags).each(function (i){
        tags_str = tags_str + tags[i] + '+'
    });
    $(characters).each(function (i){
        characters_str = characters_str + characters[i] + '+'
    });
    tags_str = tags_str.slice(0, tags_str.length - 1);
    characters_str = characters_str.slice(0, characters_str.length - 1);
    document.location.href = `/posts?author=${author}&tags=${tags_str}&characters=${characters_str}`;
});

