$(document).ready(function () {
    $(".menu-btn a").click(function () {
        $(".nav").fadeToggle(200); // ok
        $('.menu-btn a i').toggleClass('fa-ellipsis-h').toggleClass('fa-times'); // ok
    });
    $('.nav').on('click', function () {
        $(".nav").fadeToggle(200); // ok
        $(".menu-btn a i").toggleClass('fa-ellipsis-h').toggleClass('fa-times'); // ok
    });
    $('.menu a').on('click', function () {
        $(".nav").fadeToggle(200);
        $(".menu-btn a i").toggleClass('fa-ellipsis-h').toggleClass('fa-times');
    });
    $('.container-fluid').on('click', function(){
        $(".nav").fadeOut(200);
        $(".menu-btn a i").removeClass('fa-times');
        $(".menu-btn a i").addClass('fa-ellipsis-h');
    });
});