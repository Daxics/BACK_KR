const pathname = window.location.pathname;
const search = window.location.search;

$('.navbar-nav .nav-link').each(function () {
    if ($(this).attr('href').split("?")[0] === pathname) {
        $(this).addClass("text-primary");

        if (($(this).attr('href').split("?")[0] === '/profile') && ('?' + $(this).attr('href').split("?")[1] !== search)){
            $(this).removeClass("text-primary");
        }
    }
});
