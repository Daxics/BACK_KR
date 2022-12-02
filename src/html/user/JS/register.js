let formData = document.querySelectorAll('.js-input'),
    form = document.querySelector('.js-form'),

    nickName = form.querySelector('[name="nickName"]'), //получаем поле name
    e_mail = form.querySelector('[name="e-mail"]'), //получаем поле age
    password = form.querySelector('[name="password"]'), //получаем поле terms
    password_ex = form.querySelector('[name="password-ex"]'); //получаем поле plan

const validateEmail = (email) => {
    return String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
};

async function sex() {
    let formData_body = new FormData();
    formData_body.append('nickName',nickName.value);
    formData_body.append('e_mail',e_mail.value);
    formData_body.append('password',password.value);

    console.log(formData);
    formData.forEach(function (input) {
        if (input.value === '') {
            input.classList.add('border-danger');
        } else {
            input.classList.remove('border-danger');
        }
    });
    if (password.value !== password_ex.value) {
        formData[2].classList.add('border-danger');
        formData[3].classList.add('border-danger');
        document.getElementById('passHelp').textContent = "Passwords don't match";
    } else {
        formData[2].classList.remove('border-danger');
        formData[3].classList.remove('border-danger');
        document.getElementById('passHelp').textContent = '';
        if (validateEmail(e_mail.value)) {
            const res = await fetch('http://localhost:8080/api/users',{
                method: 'POST',
                body: formData_body
            });
            const data_str = await res.json();
            console.log(data_str);
            window.location.replace("/user/index.php");
        }
    }

}