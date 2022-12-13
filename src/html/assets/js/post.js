$(document).ready(function () {
    let id_post = $('.post').attr('id');
    let id_user = $('.comm-input').attr('id');
    $.getJSON(
        'http://localhost:8000/api/post/' + id_post,
        function(post){
            let newImage = $(`<img src="http://localhost:8000/api/${post.img}"
                class="card bd-placeholder-img mb-4"
            alt="${post.img_name}" style="max-width: 95.5rem; max-height: 70rem">`);
            $('.post').append(newImage);

            let author = $(`<a class="text-decoration-none" href="http://localhost:8000/posts?author=${post.author + ''}&tags=&characters="><div class="ps-3 fs-5">${post.author + ''}  ${post.count + ''}</div></a>`);
            $('#author').append(author);

            let id = $(`<div class="d-flex fs-5 pe-3">ID:<div class="ps-2 fs-5">${post.id_post + ''}</div></div>`);
            $('#information').append(id);
            let uploader = $(`<div class="d-flex fs-5 pe-3">Uploader:<a class="text-decoration-none" href="/profile?id=${post.id_user + ''}"><div class="px-1 fs-5">${post.id_user + ''}</div></a></div>`);
            $('#information').append(uploader);
            let date = $(`<div class="d-flex fs-5 pe-3">Date:<div class="px-2 fs-5">${post.dateTime + ''}</div></div>`);
            $('#information').append(date);
            let source = $(`<div class="d-flex fs-5 pe-3">Source:<a class="text-decoration-none" href="${post.source + ''}"><div class="px-1 fs-5">${post.source + ''}</div></a></div>`);
            $('#information').append(source);
            $('#dexc').text(post.disc);

            if ((id_user == post.id_user) && ($("#edit").get(0) === undefined)){

                let btn = $(`<a class="px-3" href="#edit-form" style="width: 100%"><button class="btn btn-primary mt-3 me-3" type="button" id="edit" style="width: 100%">Edit post</button></a>`);
                $('#post-information').append(btn);
            }

            if ($("#edit").get(0) !== undefined){
                $('#edit').click(function () {
                        $('#edit-form').removeClass('hide');

                        let authors_list = [post.author];
                        $.getJSON(
                            'http://localhost:8000/api/author?t=authors',
                            function (authors) {
                                $.each(authors, function () {
                                    let mid_text = this['author'];
                                    if (mid_text != post.author) {
                                        authors_list.push(mid_text)
                                    }
                                    $('.js-example').select2({
                                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                                        allowClear: Boolean($(this).data('allow-clear')),
                                        closeOnSelect: !$(this).attr('multiple'),
                                        theme: 'bootstrap4',
                                        placeholder: "Select art's author",
                                        data: authors_list
                                    });
                                });
                            });


                        $.getJSON(
                            'http://localhost:8000/api/tag?t=tags_list',
                            function (tags) {
                                let i = 0;
                                $('.first-list').empty();
                                tags.forEach((tag) => {
                                    let sex = $('.tags')[i];
                                    let mid = $(sex).text();

                                    if (tag.tag_title === mid) {
                                        let newImage = $(`
                                                <li class="list-group-item tags-list">
                                                    <input class="form-check-input"
                                                           type="checkbox" value=""
                                                           id="${tag.tag_title}" checked>
                                                    <label class="form-check-label" 
                                                        for="flexCheckChecked">${tag.tag_title}</label>
                                                </li>
                                            `);
                                        $('.first-list').append(newImage);
                                        i++
                                    } else {
                                        let newImage = $(`
                                                <li class="list-group-item tags-list">
                                                    <input class="form-check-input me-1"
                                                           name="check"
                                                           type="checkbox"
                                                           value="" id="">
                                                    <label class="form-check-label"
                                                           for="firstCheckbox">${tag.tag_title}</label>
                                                </li>   
                                            `);
                                        $('.first-list').append(newImage);
                                    }
                                });
                            }
                    );

                    $.getJSON(
                        'http://localhost:8000/api/character?t=characters_list',
                        function (characters) {
                            let i = 0;
                            $('.second-list').empty();
                            characters.forEach((character) => {
                                let sex = $('.characters')[i];
                                let mid = $(sex).text();

                                if (character.character_title === mid) {
                                    let newImage = $(`
                                            <li class="list-group-item">
                                                <input class="form-check-input me-1"
                                                       name="check"
                                                       type="checkbox"
                                                       value="" id="${character.character_title}" checked>
                                                <label class="form-check-label"
                                                       for="firstCheckbox">${character.character_title}</label>
                                            </li>
                                        `);
                                    $('.second-list').append(newImage);
                                    i++
                                } else {
                                    let newImage = $(`
                                            <li class="list-group-item">
                                                <input class="form-check-input me-1"
                                                       name="check"
                                                       type="checkbox"
                                                       value="" id="${character.character_title}">
                                                <label class="form-check-label"
                                                       for="firstCheckbox">${character.character_title}</label>
                                            </li>
                                        `);
                                    $('.second-list').append(newImage);
                                }
                            })
                        }
                    );

                    $('[name="src"]').val(post.source);
                    $('[name="disc"]').val(post.disc);

                    $('#edit-post').click(function (e) {
                        e.preventDefault();

                        $(`input`).removeClass('is-invalid');
                        $(`textarea`).removeClass('is-invalid');
                        $(`select`).removeClass('is-invalid');

                        let author_name = $('[name="author"]').val(), //получаем поле nickName
                            author_name_old = post.author, //получаем поле nickName
                            src = $('[name="src"]').val(), //получаем поле e_mail
                            disc = $('[name="disc"]').val(), //получаем поле password
                            tags_arr = [], //получаем поле password
                            characters_arr = []; //получаем поле password_ex
                        $('.first-list .form-check-input').each(function (){
                            tags_arr.push(+$(this).is(':checked'));
                        });
                        $('.second-list .form-check-input').each(function (){
                            characters_arr.push(+$(this).is(':checked'));
                        });

                        let datas = {
                            author_name: author_name,
                            author_name_old: author_name_old,
                            src: src,
                            disc: disc,
                            tags_arr:  JSON.stringify(tags_arr),
                            characters_arr: JSON.stringify(characters_arr)
                        }

                        $.ajax({
                            url: 'http://localhost:8000/api/post/' + id_post,
                            type: 'PATCH',
                            dataType: 'json',
                            data: JSON.stringify(datas),
                            success(data) {
                                if (data.status) {
                                    document.location.href = '/post?id=' + data.post_id;
                                    console.log('data.fields');
                                    $('#edit-form').addClass('hide');
                                } else {
                                    if (data.type === 1) {
                                        console.log('data.fields');
                                        data.fields.forEach(function (field) {
                                            if (field === "author_name"){
                                                $(`.search-border`).removeClass('border-0');
                                                $(`.search-border`).addClass('border-danger');
                                            }{
                                                $(`[name="${field}"]`).addClass('is-invalid');
                                            }
                                        });
                                    }
                                    console.log('data.fields');
                                    $('.msg').removeClass('d-none').text(data.message);
                                }
                            },
                        });
                    })

                });
            }
        }
    );
});


$(document).ready(function (){
    let id = $('.post').attr('id');

    $.getJSON(
        'http://localhost:8000/api/character/' + id,
        function(characters_list){
            $.getJSON(
                'http://localhost:8000/api/character',
                function(characters){
                    let i = 0;

                    characters.forEach(function (character){
                        console.log();
                        if (characters_list[0][character.character_title + ''] == 1){
                            let characters = $(`<a class="text-decoration-none" href="http://localhost:8000/posts?author=&tags=&characters=${character.character_title + ''}"><div class="ps-3 fs-5 characters">${character.character_title + ''}</div></a>`);
                            $('#characters').append(characters);

                            i++
                        }
                    })
                }
            );
        }
    );

    $.getJSON(
        'http://localhost:8000/api/tag/' + id,
        function(tags_list){
            $.getJSON(
                'http://localhost:8000/api/tag',
                function(tags){
                    let i = 0;


                    tags.forEach(function (tag){
                        console.log();
                        if (tags_list[0][tag.tag_title + ''] == 1){
                            let tags = $(`<a class="text-decoration-none" href="http://localhost:8000/posts?author=&tags=${tag.tag_title + ''}&characters="><div class="ps-3 fs-5 tags">${tag.tag_title + ''}</div></a>`);
                            $('#tags').append(tags);
                            i++
                        }
                    })
                }
            );
        }
    );

})

$('#btn-post').each(function (){
    let btn = this.lastElementChild;
    $(btn).click(function () {
        $('.modal-body').text('Delete a post?');
        console.log('sex')
        let id_post = $('.post').attr('id');
        $('#accept-btn').click(function () {
            console.log(id_post)
            $.ajax({
                url: 'http://localhost:8000/api/post/' + id_post,
                type: 'DELETE',
                success() {
                    document.location.href = '/posts';
                },
            });
            $(this).off('click');
        })
    })
});



