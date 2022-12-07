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

$('.second-search .form-control').keyup(function (e){
    let a = $(this).val().toLowerCase();
    if (a != ''){
        $('.second-list .list-group-item').each(function (){
            let inner_label_text = $(this.children[1]).html().toLowerCase(),
                sex = $(this.children[0]).is(':checked');

            if ((inner_label_text.search(a) == -1) && !sex){
                $(this).addClass('hide');
            } else {
                $(this).removeClass('hide');
            }
        });
    } else {
        $('.second-list .list-group-item').each(function () {
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


$(document).ready(function () {
    $.getJSON(
        'http://localhost:8000/api/all?t=tags_list',
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
        'http://localhost:8000/api/all?t=authors',
        function (authors) {
            authors.forEach((author) => {
                let newImage = $(`
                    <li class="list-group-item">
                        <input class="form-check-input me-1"
                               name="check"
                               type="checkbox"
                               value="" id="${author.id_author}">
                        <label class="form-check-label"
                               for="firstCheckbox">${author.author}</label>
                    </li>
                `);
                $('.second-list').append(newImage);
            })
        }
    );
});

$(document).ready(function () {
    $.getJSON(
        'http://localhost:8000/api/all?t=characters',
        function (tags) {
            tags.forEach((tag) => {
                let newImage = $(`
                    <li class="list-group-item">
                        <input class="form-check-input me-1"
                               name="check"
                               type="checkbox"
                               value="" id="${tag.id_character}">
                        <label class="form-check-label"
                               for="firstCheckbox">${tag.character}</label>
                    </li>
                `);
                $('.third-list').append(newImage);
            })
        }
    );
});
