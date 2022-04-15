$(function(){
    $('header .dropdown').hover(function() {
        $(this).find(".dropdown-toggle").addClass("show");
        $(this).find(".dropdown-toggle").prop("aria-expanded", "true");
        $(this).find(".dropdown-menu").addClass("show");
    },
    function() {
        $(this).find(".dropdown-toggle").removeClass("show");
        $(this).find(".dropdown-toggle").prop("aria-expanded", "false");
        $(this).find(".dropdown-menu").removeClass("show");
    });
});