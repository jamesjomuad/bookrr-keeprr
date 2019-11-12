$(function(){
    $('[href="'+window.location.hash+'"]').click();
    $('.nav-tabs a').click(function (e) {
        window.location.hash = this.hash;
    });
});