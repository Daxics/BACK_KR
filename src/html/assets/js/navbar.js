const pathname = window.location.pathname;

console.log(pathname);

$('.navbar-nav .nav-link').each(function () {
    if ($(this).attr('href') === pathname) {
        $(this).addClass("text-primary");
    }
});