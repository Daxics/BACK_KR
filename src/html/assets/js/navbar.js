const pathname = window.location.pathname;

$('.navbar-nav .nav-link').each(function () {
    if ($(this).attr('href').split("?")[0] === pathname) {
        $(this).addClass("text-primary");
            // $(this).addClass("active");
    }
});