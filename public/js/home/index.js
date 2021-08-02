/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/home/index.js ***!
  \************************************/
var _Swiper;

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

// For Swiper Slider
var swiper = new Swiper('#content .slider .swiper-container', (_Swiper = {
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
    prevEl: '.swiper-button-prev'
  },
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true
  }
}, _defineProperty(_Swiper, "direction", 'horizontal'), _defineProperty(_Swiper, "effect", 'fade'), _defineProperty(_Swiper, "fadeEffect", {
  crossFade: true
}), _Swiper));
$('#content .slider .swiper-container .swiper-wrapper .swiper-slide .wrapper .content').css({
  'left': '0',
  'opacity': '1'
});
$('#content .slider .swiper-container .swiper-wrapper .swiper-slide .wrapper img').css({
  'right': '0',
  'opacity': '1'
});
swiper.on('click', function () {
  $('#content .slider .swiper-container').focus();
});
/******/ })()
;