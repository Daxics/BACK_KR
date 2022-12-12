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
