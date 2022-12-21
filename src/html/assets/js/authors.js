async function get_authors(){
    $.ajax({
        url: 'http://localhost:8000/api/vendor/authors',
        type: 'GET',
        dataType: 'json',
        data: '',
        success(data) {
            let count_auth = data.count;

            window.pagObj = $('#pagination').twbsPagination({
                totalPages: Math.ceil(count_auth/12),
                visiblePages: 10,
                onPageClick: function (event, page) {
                    console.info(page + ' (from options)');
                    $('#author').empty();
                    $.getJSON(
                        'http://localhost:8000/api/author?s=' + (page-1)*12,
                        function (comments) {
                            comments.forEach(function (comment) {
                                if (comment.role == 1) {
                                    let tags = $(`
                                   <div class="card mb-3 me-2 author" style="max-height: 4rem; min-width: 49%"  id="${comment.id_author}">
                                        <div class="card-body py-3">
                                            <div class="d-flex justify-content-between" >
                                                <div class="d-flex align-items-center">
                                                    <h5 class="card-title">${comment.author}</h5>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-3">Edit</button>
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-danger del-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal" >Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `);
                                    $('#author').append(tags);
                                } else {
                                    let tags = $(`
                                   <div class="card mb-3 me-2 author" style="max-height: 4rem; min-width: 49%"  id="${comment.id_author}">
                                        <div class="card-body py-3">
                                            <div class="d-flex justify-content-between" >
                                                <div class="d-flex align-items-center">
                                                    <h5 class="card-title">${comment.author}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `);
                                    $('#author').append(tags);
                                }
                            })

                            $('#author .author').each(function () {
                                let mid = this.firstElementChild.firstElementChild,
                                    btn_del = mid.lastElementChild.lastElementChild,
                                    btn_edit = mid.lastElementChild.firstElementChild,
                                    author_text = mid.firstElementChild.firstElementChild,
                                    author_id = $(this).attr('id');

                                $('.modal-body').text('Delete a comment?');
                                $('#accept-btn').removeClass('btn-primary').addClass('btn-danger').html('Delete');
                                $(btn_del).click(function () {
                                    $('#accept-btn').click(function () {
                                        $.ajax({
                                            url: 'http://localhost:8000/api/author/' + author_id,
                                            type: 'DELETE',
                                            success() {
                                                location.reload();
                                            },
                                        });
                                        $(this).off('click');
                                    })
                                });

                                author_text = $(author_text).text();
                                $(btn_edit).click(function (){
                                    $('[name="author"]').val(author_text);
                                    $('[name="publish"]').addClass('hide')
                                    $('[name="comm-edit"]').removeClass('hide')


                                    $('[name="comm-edit"]').click(function (e) {
                                        e.preventDefault();
                                        $("[name='comment']").removeClass('is-invalid');

                                        let author = $('[name="author"]').val(),
                                            data = {
                                                author: author
                                            }

                                        $.ajax({
                                            url: 'http://localhost:8000/api/author/' + author_id,
                                            type: 'PATCH',
                                            dataType: 'json',
                                            data: JSON.stringify(data),
                                            success(data) {
                                                if (data.status) {
                                                    $('[name="author"]').val('')
                                                    $('[name="publish"]').removeClass('hide')
                                                    $('[name="comm-edit"]').addClass('hide')
                                                    location.reload();
                                                } else {
                                                    if (data.type === 1) {
                                                        console.log(data);
                                                        $("[name='author']").addClass('is-invalid');
                                                    }
                                                }
                                            },
                                        });
                                    });

                                    $(this).off('click');
                                });

                            });
                        }
                    );
                }
            }).on('page', function (event, page) {
                console.info(page + ' (from event listening)');
            });

        },
    });
}

$(document).ready(function (){
    get_authors();
})

$('#publish').click(function (e) {
    e.preventDefault();

    $("[name='author']").removeClass('is-invalid');

    let author = $('[name="author"]').val()

    $.ajax({
        url: 'http://localhost:8000/api/author',
        type: 'POST',
        dataType: 'json',
        data: {
            author: author
        },
        success(data) {
            if (data.status) {
                $('[name="author"]').val('')
                location.reload();
            } else {
                if (data.type === 1) {
                    $("[name='author']").addClass('is-invalid');
                }
            }
        },
    });
});


