const fileInput = document.getElementById("formFile");

window.addEventListener('paste', e => {
    fileInput.files = e.clipboardData.files;
});

$(document).ready(function () {
    let authors_list = [];
    $.getJSON(
        'http://localhost:8000/api/author?t=authors',
        function (authors) {
            $.each(authors, function () {
                let mid_test = this['author'];
                authors_list.push(mid_test)
                $('.js-example').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    allowClear: Boolean($(this).data('allow-clear')),
                    closeOnSelect: !$(this).attr('multiple'),
                    theme: 'bootstrap4',
                    placeholder: "Select art's author",
                    data:authors_list
                });
            });
        });
});

$(document).ready(function () {
    $.getJSON(
        'http://localhost:8000/api/tag?t=tags_list',
        function (tags) {
            tags.forEach((tag) => {
                let newImage = $(`
                    <li class="list-group-item">
                        <input class="form-check-input me-1"
                               name="check"
                               type="checkbox"
                               value="" id="${tag.tag_title}">
                        <label class="form-check-label"
                               for="firstCheckbox">${tag.tag_title}</label>
                    </li>
                `);
                $('.first-list').append(newImage);
            })
        }
    );
});

$(document).ready(function () {
    $.getJSON(
        'http://localhost:8000/api/character?t=characters_list',
        function (characters) {
            characters.forEach((character) => {
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
            })
        }
    );
});

$('.first-search .form-control').keyup(function (e){
    let a = $(this).val().toLowerCase();
    if (a != ''){
        $('.first-list .list-group-item').each(function (){
            let inner_label_text = $(this.children[1]).html().toLowerCase(),
                sex = $(this.children[0]).is(':checked');
            if ((inner_label_text.search(a) == -1) && !sex){
                $(this).addClass('hide');
            } else {
                $(this).removeClass('hide');
            }
        });
    } else {
        $('.first-list .list-group-item').each(function () {
                $(this).removeClass('hide');
        });
    }
});

$('.third-search .form-control').keyup(function (e){
    let a = $(this).val().toLowerCase();
    if (a != ''){
        $('.third-list .list-group-item').each(function (){
            let inner_label_text = $(this.children[1]).html().toLowerCase(),
                sex = $(this.children[0]).is(':checked');

            if ((inner_label_text.search(a) == -1) && !sex){
                $(this).addClass('hide');
            } else {
                $(this).removeClass('hide');
            }
        });
    } else {
        $('.third-list .list-group-item').each(function () {
            $(this).removeClass('hide');
        });
    }
});

let file = false;
$('[name="file"]').change(function (e){
    file = e.target.files[0];
})


$('.post-form .submit').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('is-invalid');
    $(`textarea`).removeClass('is-invalid');
    $(`select`).removeClass('is-invalid');

    let user_id = $('body').attr('id'), //получаем поле nickName
        author_name = $('[name="author"]').val(), //получаем поле nickName
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

    console.log(user_id);
    console.log(author_name);
    console.log(src);
    console.log(file);
    console.log(disc);
    console.log(tags_arr);
    console.log(characters_arr);

    let formData = new FormData();
        formData.append('user_id', user_id);
        formData.append('author_name', author_name);
        formData.append('src', src);
        formData.append('file', file);
        formData.append('disc', disc);
        formData.append('tags_arr', JSON.stringify(tags_arr));
        formData.append('characters_arr', JSON.stringify(characters_arr));


    $.ajax({
        url: 'http://localhost:8000/api/post',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success(data) {
            if (data.status) {
                document.location.href = '/post?id=' + data.post_id;
                console.log('data.fields');

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
        error: function (jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect. Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found (404).');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error (500).');
            } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error. ' + jqXHR.responseText);
            }
        }
    });
});

