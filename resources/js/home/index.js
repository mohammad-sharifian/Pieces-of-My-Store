
// For Swiper Slider
const swiper = new Swiper('#content .slider .swiper-container', {
    // Optional parameters
    direction: 'vertical',
    loop: true,

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets'
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true
    },

    direction: 'horizontal',

    effect: 'fade',
    fadeEffect: {
    crossFade: true
    },
});

$('#content .slider .swiper-container .swiper-wrapper .swiper-slide .wrapper .content').css({'left':'0', 'opacity':'1'});
$('#content .slider .swiper-container .swiper-wrapper .swiper-slide .wrapper img').css({'right':'0', 'opacity':'1'});

swiper.on('click', function ()
{
    $('#content .slider .swiper-container').focus();
});
