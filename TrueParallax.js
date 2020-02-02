$(function(){
    var $el = $('#parallax, #parallax1, #parallax2, #parallax3');     
    $(window).scroll(function () {
        para($el);
    });
    para($el);
});
var speed = 0.2;
function para($el) {
    var diff = $(window).scrollTop() - $el.offset().top;
    var yPos = -(diff * speed);
    var coords = '50% ' + yPos + 'px';
    $el.css({
        backgroundPosition: coords
    });
}