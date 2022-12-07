const pathname = window.location.pathname;
console.log('sex');

$('.navbar-nav .nav-link').each(function () {
    if ($(this).attr('href').split("?")[0] === pathname) {
        $(this).addClass("text-primary");
            // $(this).addClass("active");
    }
});


$.get('http://localhost:8000/api/count_all_posts', function(data) {
    $('.navbar-nav .posts').each(function () {
        let hr = $(this).attr('href');
        $(this).attr("href",hr + "?z=" + data);
    });
    // this.attr('href');
});
