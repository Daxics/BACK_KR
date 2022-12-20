$(document).ready(function () {
    let id = $('.user-info').attr('id');

    $.getJSON(
        'http://localhost:8000/api/user/' + id,
        function(main){
            $('.id').text(main.id_user);
            $('.name').text(main.nickName);
            $('.e_mail').text(main.e_mail);
            $('.date').text(main.dateTime);
            $('.level').text(main.role);
            $('.uploads').text(main.posts_count);
            $('.comments').text(main.comments_count);

            let p_c = main.posts_count,
                p_com = main.comments_count,
                id_user_cur = main.id_user_current,
                id_role = main.id_role,
                name = main.nickName;

            console.log(id);
            console.log(id_user_cur);
            console.log(id_role);


            if ((id === id_user_cur) ||  (id_role === 1)){
                let btns = $(`
                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"  type="button" id="update">Edit Profile</button>
                                <button class="btn btn-outline-danger m-3"  data-bs-toggle="modal" data-bs-target="#exampleModal"  type="button" id="delete">Delete</button>
                            `);
                $('.btn-body').append(btns);

                $('.btn-body #update').click(function () {

                    let form = $(`
                                <form class="js-form"  style="min-width: 30rem;">
                                    <h4 class="mt-2 mb-3">Update profile information</h4>
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control js-input"
                                               name="nickName" value="${main.nickName}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input type="email" class="form-control js-input"
                                               name="e_mail" value="${main.e_mail}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control js-input"
                                               name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirm
                                            your password</label>
                                        <input type="password" class="form-control js-input"
                                               name="password_con">
                                    </div>
                                    <div class="d-grid gap-2 col-8 mx-auto">
                                        <div class="form-text text-danger msg d-none text-center"></div>
                                    </div>
                                
                                </form>
                            `);

                    $('.modal-body').empty().append(form);


                    $('#accept-btn').removeAttr('data-bs-dismiss').removeClass('btn-danger').addClass('btn-primary').html('Update').click(function () {

                        $(`input`).removeClass('is-invalid');

                        let nickName = $('input[name="nickName"]').val(), //получаем поле nickName
                            e_mail = $('input[name="e_mail"]').val(), //получаем поле e_mail
                            password = $('input[name="password"]').val(), //получаем поле password
                            password_con = $('input[name="password_con"]').val(); //получаем поле password_ex

                        console.log(nickName)
                        console.log(e_mail)
                        console.log(password)
                        console.log(password_con)
                        let datas = {
                            nickName: nickName,
                            e_mail: e_mail,
                            password: password,
                            password_con: password_con,
                        }


                        $.ajax({
                            url: 'http://localhost:8000/api/user/' + id,
                            type: 'PATCH',
                            data: JSON.stringify(datas),
                            success(data) {
                                if (data.status) {
                                    location.reload();
                                } else {
                                    if (data.type === 1) {
                                        data.fields.forEach(function (field) {
                                            $(`input[name="${field}"]`).addClass('is-invalid');
                                        });
                                    }
                                    $('.msg').removeClass('d-none').text(data.message);
                                }
                                $(this).off('click');
                            }
                        });
                    })
                });

                $('.btn-body #delete').click(function () {
                    $('.modal-body').text('Delete a profile?');
                    $('#accept-btn').removeClass('btn-primary');
                    $('#accept-btn').addClass('btn-danger');
                    $('#accept-btn').html('Delete');
                    $('#accept-btn').click(function () {
                        $.ajax({
                            url: 'http://localhost:8000/api/user/' + id,
                            type: 'DELETE',
                            success() {
                                document.location.href = '/logout';
                            },
                        });
                        $(this).off('click');
                    })
                });


            }



            $(function () {
                window.pagObj = $('.second-search #pagination').twbsPagination({
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





            $(function () {
                window.pagObj = $('.third-search #pagination').twbsPagination({
                    totalPages: Math.ceil(p_com/4),
                    visiblePages: 10,
                    onPageClick: function (event, page) {
                        console.info(page + ' (from options)');
                        $('#posts-list').empty();
                        $.getJSON(
                            'http://localhost:8000/api/user/' + id + '?cs=' + (page-1)*4,
                            function (comments) {
                                $(".third-search #comments-list").empty();
                                comments.forEach(function (comment) {
                                    console.log(comment.role)
                                    if (id_user_cur === id || comment.role == 1) {
                                        let tags = $(`
                                                    <div class="card mb-3 comment ms-5"  style="max-width: 50rem" id="${comment.id_comment}">
                                                        <div class="card-body py-3">
                                                            <div class="d-flex justify-content-between" >
                                                                <div class="d-flex align-items-center">
                                                                    <h5 class="card-title">${name}</h5>
                                                                    <h7 class="card-title ms-3 ">${comment.dateTime}</h7>
                                                                    <h6 class="card-title ms-4">Post ID:</h6>
                                                                    <a class="text-decoration-none text-break ms-2 card-title" href="/post?id=${comment.id_post}"><h7 class=" ">${comment.id_post}</h7></a>
                                                                </div>
                                                                <div class="d-flex justify-content-end">
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
                                        $('.third-search #comments-list').append(tags);
                                    } else {
                                        let tags = $(`
                                                    <div class="card mb-3 ms-5"  style="max-width: 50rem" >
                                                        <div class="card-body py-3" id="${comment.id_comment}">
                                                            <div class="d-flex justify-content-between" >
                                                                <div class="d-flex align-items-center">
                                                                    <h5 class="card-title">${comment.nickName}</h5>
                                                                    <h7 class="card-title ms-3 ">${comment.dateTime}</h7>
                                                                    <h5 class="card-title ms-3">Post ID:</h5>
                                                                    <a class="text-decoration-none text-break" href="/post?id=${comment.id_post}"><h7 class="card-title ms-3 ">${comment.dateTime}</h7></a>
                                                                </div>
                                                            </div>
                                                            <p class="card-text mt-3">${comment.text}</p>
                                                        </div>
                                                    </div>
                                                    `);
                                        $('.third-search #comments-list').append(tags);
                                    }

                                })

                                $('.comment').each(function () {
                                    let btn_del = this.firstElementChild.firstElementChild.lastElementChild,
                                        comment = this,
                                        comment_id = $(this).attr('id');

                                    console.log(comment);
                                    $('.modal-body').text('Delete a comment?');
                                    $('#accept-btn').removeClass('btn-primary');
                                    $('#accept-btn').addClass('btn-danger');
                                    $('#accept-btn').html('Delete');
                                    $(btn_del).click(function () {
                                        $('#accept-btn').click(function () {
                                            $.ajax({
                                                url: 'http://localhost:8000/api/comment/' + comment_id,
                                                type: 'DELETE',
                                                success() {
                                                    $(comment).remove();
                                                },
                                            });
                                            $(this).off('click');
                                        })
                                    });
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
