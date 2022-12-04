$('.btn-log').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('border-danger');

    let nickName = $('input[name="nickName"]').val(), //получаем поле name
        password = $('input[name="password"]').val(); //получаем поле password

    $.ajax({
        url: 'http://localhost:8080/api/userCheck',
        type: 'POST',
        dataType: 'json',
        data: {
            nickName: nickName,
            password: password
        },
        success(data) {
            if (data.status) {
                document.location.href = '/posts.php';
            } else {
                if (data.type === 1) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('border-danger');
                    });
                }
                $('.msg').removeClass('d-none').text(data.message);
            }
        }
    });
});
