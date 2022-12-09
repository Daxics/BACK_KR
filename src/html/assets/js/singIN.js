$('.btn-log').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('is-invalid');

    let nickName = $('input[name="nickName"]').val(), //получаем поле name
        password = $('input[name="password"]').val(); //получаем поле password

    $.ajax({
        url: 'http://localhost:8000/api/user/check',
        type: 'POST',
        dataType: 'json',
        data: {
            nickName: nickName,
            password: password
        },
        success(data) {
            if (data.status) {
                document.location.href = '/posts';
            } else {
                if (data.type === 1) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('is-invalid');
                    });
                }
                $('.msg').removeClass('d-none').text(data.message);
            }
        }
    });
});
