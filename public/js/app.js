/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var root = "http://localhost/lvhang-sitebuild/";
var scrollTimer;
var lastScrollFireTime;

window.onload = function () {
  // kell a scrollozáskor logo összanyomáshoz
  var logoHolder = document.querySelector('.logo-holder');
  var logoHolderOrigPadding = getComputedStyle(logoHolder).paddingBottom;
  var logoHolderOrigPaddingNr = +logoHolderOrigPadding.substring(0, logoHolderOrigPadding.length - 2); // scrollozáskor meghívja a szükséges függvényeket

  document.addEventListener('scroll', function () {
    return push();
  });
  window.dispatchEvent(new CustomEvent('scroll')); // scrollozáskor átméretezi a logót

  function push() {
    var minScrollTime = 20;
    var now = new Date().getTime();

    function processScroll() {
      var scrollTop = document.documentElement.scrollTop;
      var headerOuterHeight = document.querySelector('.header-outer').clientHeight;
      var header = document.querySelector('.header');
      var hamburgerElement = document.querySelector('.hamburger');
      var hamburgerDisplay = getComputedStyle(hamburgerElement).display;
      var logoHolder = document.querySelector('.logo-holder');

      if (hamburgerDisplay === 'none') {
        if (scrollTop > 0 & scrollTop < headerOuterHeight - 60) {
          var paddingToSet = 10 + (logoHolderOrigPaddingNr - 10) * ((headerOuterHeight - 60 - scrollTop) / (headerOuterHeight - 60));
          header.style.height = headerOuterHeight - scrollTop + 'px';
          header.style.position = 'relative';
          header.style.background = 'transparent';
          logoHolder.style.paddingBottom = paddingToSet + 'px';
          logoHolder.style.paddingTop = paddingToSet + 'px';
        }

        if (scrollTop === 0) {
          header.style.height = '100%';
          header.style.position = 'relative';
          header.style.background = 'transparent';
          logoHolder.style.paddingBottom = '30px';
          logoHolder.style.paddingTop = '30px;';
        }

        if (scrollTop >= headerOuterHeight - 60) {
          if (header.style.position === 'relative') {
            header.style.position = 'fixed';
            header.style.top = '0px';
            header.style.zIndex = '10';
            header.style.height = '60px';
            header.style.background = 'black';
            logoHolder.style.paddingBottom = '10px';
            logoHolder.style.paddingTop = '10px';
          }
        }
      }
    }

    if (!scrollTimer) {
      if (now - lastScrollFireTime > minScrollTime || !lastScrollFireTime) {
        processScroll();
        lastScrollFireTime = now;
        ;
      }

      scrollTimer = true;
      setTimeout(function () {
        scrollTimer = false;
        lastScrollFireTime = new Date().getTime();
        processScroll();
      }, minScrollTime);
    }
  }

  ; // hamburger menü nyitás-zárás

  function openHamburger() {
    var body = document.querySelector('body');
    var navBar = document.querySelector('.nav-bar');
    hamburger.classList.toggle('hamburger-open');
    body.classList.toggle('modal-open');
    bodyOverlay.classList.toggle('hidden');
    navBar.classList.toggle('open-nav-bar');
    navBar.classList.toggle('closed-nav-bar');
  }

  var bodyOverlay = document.querySelector('.body-overlay');
  var hamburger = document.querySelector('.hamburger');
  hamburger.addEventListener('click', openHamburger);
  bodyOverlay.addEventListener('click', openHamburger);
};

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\wamp64\www\lvhang\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\wamp64\www\lvhang\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });