/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/home/layout.js ***!
  \*************************************/
//  For Setting Content - Header
$('#header .main-header-wrap .right-header .setting').click(function () {
  $(this).children('.setting-content').toggleClass('show');
});
$('#header .main-header-wrap .right-header .setting').blur(function () {
  function blur() {
    $('#header .main-header-wrap .right-header .setting .setting-content').removeClass('show');
  }

  setTimeout(blur, 100);
}); //  For Cart Content - Header

$('#header .main-header-wrap .right-header .cart-detail').click(function () {
  $(this).children('.cart-content').toggleClass('show');
});
$('#header .main-header-wrap .right-header .cart-detail').blur(function () {
  function blur() {
    $('#header .main-header-wrap .right-header .cart-detail .cart-content').removeClass('show');
  }

  setTimeout(blur, 100);
});
/******/ })()
;