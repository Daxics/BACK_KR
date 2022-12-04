$('.btn-reg').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('border-danger');

    let nickName = $('input[name="nickName"]').val(), //получаем поле nickName
        e_mail = $('input[name="e_mail"]').val(), //получаем поле e_mail
        password = $('input[name="password"]').val(), //получаем поле password
        password_con = $('input[name="password_con"]').val(); //получаем поле password_ex


    $.ajax({
        url: 'http://localhost:8080/api/userAdd',
        type: 'POST',
        data: {
            nickName: nickName,
            e_mail: e_mail,
            password: password,
            password_con: password_con,
        },
        success(data) {
            if (data.status) {
                document.location.href = '/singIN.php';
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
