$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
});


console.log(document.querySelector('.elem'))

// TEST si moins de 4 element, pas de carousel inférieur pour eviter les bugs
if(document.querySelector('.slick-track').childNodes.length < 4){
    $('.slider-nav').slick({
        slidesToShow: document.querySelector('.slick-track').childNodes.length,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        centerMode: true,
        focusOnSelect: true
    });
console.log('Moins de 4 éléments')
} else {
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        centerMode: true,
        focusOnSelect: true
    });
    console.log('Plus de 4 éléments')
}

console.log(document.querySelectorAll('.elem'));

// TEST click sur le premier element afin d'avoir le carousel actif
document.querySelectorAll('.elem').forEach(element => {
    if(!element.classList.contains('slick-cloned')){
        console.log(element);
        element.click();
    }
    
});
