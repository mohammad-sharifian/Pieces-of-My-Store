/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/admin/layout.js ***!
  \**************************************/
$(function () {
  $(document).scroll(function () {
    if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
      $('#footer').addClass('scroll');
    }
  });
  $('#sidebar .links .link').focus(function () {
    $(this).children('.title').toggleClass('arrow-rotate');
    $(this).children('.sublinks').slideToggle(150).css('display', 'flex');
  });
  $('#sidebar .links .link').blur(function () {
    $(this).children('.title').delay(50).removeClass('arrow-rotate');
    $(this).children('.sublinks').delay(50).slideUp(150).css('display', 'flex');
  });
  $('#sidebar .sidebar-toggle').click(function () {
    $(this).toggleClass('active');
    $('#top-header-bg').toggleClass('s-toggle');
    $('#bottom-header-bg').toggleClass('s-toggle');
    $('#sidebar').toggleClass('s-toggle');
    $('#content').toggleClass('s-toggle');
    $('#header').toggleClass('s-toggle');
    $('#footer').toggleClass('s-toggle');
  });
  $('#header .header-toggle').click(function () {
    $('#top-header-bg').toggleClass('h-toggle');
    $('#bottom-header-bg').toggleClass('h-toggle');
    $('#sidebar').toggleClass('h-toggle');
    $('#content').toggleClass('h-toggle');
    $('#header').toggleClass('h-toggle');
    $('#footer').toggleClass('h-toggle');
  });
});
/******/ })()
;