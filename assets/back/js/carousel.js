$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
});

console.log(document.querySelectorAll('.elem').length)

// TEST si moins de 4 elements, pas de carousel inférieur pour eviter les bugs
let slide;
if (document.querySelector('.slick-track').childNodes.length < 4) {
    slide = document.querySelectorAll('.elem').length;
}
else {
    slide = 3;
}
$('.slider-nav').slick({
    slidesToShow: slide,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    arrows: false,
    centerMode: true,
    focusOnSelect: true
});
// TEST click sur l'element .slick-current afin d'avoir le carousel actif

document.querySelectorAll('.elem').forEach(element => {
    if (element.classList.contains('slick-current')) {
        element.click()
        element.focus()
    }
});