async function getComments() {
    let id_post = $('.post').attr('id'),
        id_user = $('.comm-input').attr('id');

    $.getJSON(
        'http://localhost:8000/api/comment/' + id_post,
        function (comments) {
            $("#comments").empty();
            comments.forEach(function (comment) {
                if (id_user === comment.id_user || comment.role === 1) {
                    let tags = $(`
                                <div class="card mb-3 comment"  style="max-width: 50rem" id="${comment.id_comment}">
                                    <div class="card-body py-3">
                                        <div class="d-flex justify-content-between" >
                                            <div class="d-flex align-items-center">
                                                <h5 class="card-title">${comment.nickName}</h5>
                                                <h7 class="card-title ms-3 ">${comment.dateTime}</h7>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <a href="#floatingTextarea1"><button type="button" class="btn btn-sm btn-outline-primary mx-3">Edit</button></a>
                                                 <button type="button"
                                                         class="btn btn-sm btn-outline-danger del-btn"
                                                         data-bs-toggle="modal"
                                                         data-bs-target="#exampleModal" >Delete</button>
                                            </div>  
                                        </div>
                                        <p class="card-text mt-3">${comment.text}</p>
                                    </div>
                                </div>
                                `);
                    $('#comments').append(tags);
                } else {
                    let tags = $(`
                                <div class="card mb-3"  style="max-width: 50rem" >
                                    <div class="card-body py-3" id="${comment.id_comment}">
                                        <div class="d-flex justify-content-between" >
                                            <div class="d-flex align-items-center">
                                                <h5 class="card-title">${comment.nickName}</h5>
                                                <h7 class="card-title ms-3 ">${comment.dateTime}</h7>
                                            </div>
                                        </div>
                                        <p class="card-text mt-3">${comment.text}</p>
                                    </div>
                                </div>
                                `);
                    $('#comments').append(tags);
                }
            })


            $('.comment').each(function () {
                let btn_del = this.firstElementChild.firstElementChild.lastElementChild.lastElementChild,
                    btn_edit = this.firstElementChild.firstElementChild.lastElementChild.firstElementChild,
                    comment_text = this.firstElementChild.lastElementChild,
                    comment_id = $(this).attr('id');
                $('.modal-body').text('Delete a comment?');

                $(btn_del).click(function (e) {
                    $('#accept-btn').click(function () {
                        console.log(comment_id)
                        $.ajax({
                            url: 'http://localhost:8000/api/comment/' + comment_id,
                            type: 'DELETE',
                            success() {
                                getComments();
                            },
                        });
                        $(this).off('click');
                    })
                });
                comment_text = $(comment_text).text();
                $(btn_edit).click(function (){
                    $('[name="comment"]').val(comment_text);
                    $('[name="publish"]').addClass('hide')
                    $('[name="comm-edit"]').removeClass('hide')


                    $('[name="comm-edit"]').click(function (e) {
                        e.preventDefault();
                        $("[name='comment']").removeClass('is-invalid');

                        let text = $('[name="comment"]').val(),
                            data = {
                            text: text
                        }

                        $.ajax({
                            url: 'http://localhost:8000/api/comment/' + comment_id,
                            type: 'PATCH',
                            dataType: 'json',
                            data: JSON.stringify(data),
                            success(data) {
                                if (data.status) {
                                    $('[name="comment"]').val('')
                                    $('[name="publish"]').removeClass('hide')
                                    $('[name="comm-edit"]').addClass('hide')
                                    getComments();
                                } else {
                                    if (data.type === 1) {
                                        console.log(data);
                                        $("[name='comment']").addClass('is-invalid');
                                    }
                                }
                            },
                        });
                    })



                    $(this).off('click');
                })
            })
        }
    );
};

$(document).ready(function (){
    getComments();

})

$('#publish').click(function (e) {
    let id_post = $('.post').attr('id'),
        id_user = $('.comm-input').attr('id');
    e.preventDefault();

    $("[name='comment']").removeClass('is-invalid');

    let text = $('[name="comment"]').val()

    $.ajax({
        url: 'http://localhost:8000/api/comment',
        type: 'POST',
        dataType: 'json',
        data: {
            text: text,
            id_user: id_user,
            id_post: id_post
        },
        success(data) {
            if (data.status) {
                $('[name="comment"]').val('')
                getComments();
            } else {
                if (data.type === 1) {
                    $("[name='comment']").addClass('is-invalid');
                }
            }
        },
    });
});


