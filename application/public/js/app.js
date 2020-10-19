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
/***/ (function(module, exports) {

function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

//('govuk-frontend/all')
// used by the cookie banner component
// used by the cookie banner component
(function (root) {
  'use strict';

  window.GOVUK = window.GOVUK || {};
  var DEFAULT_COOKIE_CONSENT = {
    'essential': true,
    'settings': false,
    'usage': false,
    'campaigns': false
  };
  var COOKIE_CATEGORIES = {
    'cookies_policy': 'essential',
    'seen_cookie_message': 'essential',
    'cookie_preferences_set': 'essential',
    'cookies_preferences_set': 'essential',
    '_email-alert-frontend_session': 'essential',
    'licensing_session': 'essential',
    'govuk_contact_referrer': 'essential',
    'global_bar_seen': 'settings',
    'govuk_browser_upgrade_dismisssed': 'settings',
    'govuk_not_first_visit': 'settings',
    'analytics_next_page_call': 'usage',
    '_ga': 'usage',
    '_gid': 'usage',
    '_gat': 'usage',
    'JS-Detection': 'usage',
    'TLSversion': 'usage'
  };
  /*
    Cookie methods
    ==============
    Usage:
      Setting a cookie:
      GOVUK.cookie('hobnob', 'tasty', { days: 30 });
      Reading a cookie:
      GOVUK.cookie('hobnob');
      Deleting a cookie:
      GOVUK.cookie('hobnob', null);
  */

  window.GOVUK.cookie = function (name, value, options) {
    if (typeof value !== 'undefined') {
      if (value === false || value === null) {
        return window.GOVUK.setCookie(name, '', {
          days: -1
        });
      } else {
        // Default expiry date of 30 days
        if (typeof options === 'undefined') {
          options = {
            days: 30
          };
        }

        return window.GOVUK.setCookie(name, value, options);
      }
    } else {
      return window.GOVUK.getCookie(name);
    }
  };

  window.GOVUK.setDefaultConsentCookie = function () {
    window.GOVUK.setConsentCookie(DEFAULT_COOKIE_CONSENT);
  };

  window.GOVUK.approveAllCookieTypes = function () {
    var approvedConsent = {
      'essential': true,
      'settings': true,
      'usage': true,
      'campaigns': true
    };
    window.GOVUK.setCookie('cookies_policy', JSON.stringify(approvedConsent), {
      days: 0
    });
  };

  window.GOVUK.setUsageCookieValue = function (value) {
    var consentCookie = window.GOVUK.getConsentCookie();
    consentCookie['usage'] = value;
    window.GOVUK.setCookie('cookies_policy', JSON.stringify(consentCookie), {
      days: 0
    });
  };

  window.GOVUK.getConsentCookie = function () {
    var consentCookie = window.GOVUK.cookie('cookies_policy');
    var consentCookieObj;

    if (consentCookie) {
      try {
        consentCookieObj = JSON.parse(consentCookie);
      } catch (err) {
        return null;
      }

      if (_typeof(consentCookieObj) !== 'object' && consentCookieObj !== null) {
        consentCookieObj = JSON.parse(consentCookieObj);
      }
    } else {
      return null;
    }

    return consentCookieObj;
  };

  window.GOVUK.setConsentCookie = function (options) {
    var cookieConsent = window.GOVUK.getConsentCookie();

    if (!cookieConsent) {
      cookieConsent = JSON.parse(JSON.stringify(DEFAULT_COOKIE_CONSENT));
    }

    for (var cookieType in options) {
      cookieConsent[cookieType] = options[cookieType]; // Delete cookies of that type if consent being set to false

      if (!options[cookieType]) {
        for (var cookie in COOKIE_CATEGORIES) {
          if (COOKIE_CATEGORIES[cookie] === cookieType) {
            window.GOVUK.deleteCookie(cookie);
          }
        }
      }
    }

    window.GOVUK.setCookie('cookies_policy', JSON.stringify(cookieConsent), {
      days: 0
    });
  };

  window.GOVUK.checkConsentCookieCategory = function (cookieName, cookieCategory) {
    var currentConsentCookie = window.GOVUK.getConsentCookie(); // If the consent cookie doesn't exist, but the cookie is in our known list, return true

    if (!currentConsentCookie && COOKIE_CATEGORIES[cookieName]) {
      return true;
    }

    currentConsentCookie = window.GOVUK.getConsentCookie(); // Sometimes currentConsentCookie is malformed in some of the tests, so we need to handle these

    try {
      return currentConsentCookie[cookieCategory];
    } catch (e) {
      console.error(e);
      return false;
    }
  };

  window.GOVUK.checkConsentCookie = function (cookieName, cookieValue) {
    // If we're setting the consent cookie OR deleting a cookie, allow by default
    if (cookieName === 'cookies_policy' || cookieValue === null || cookieValue === false) {
      return true;
    } // Survey cookies are dynamically generated, so we need to check for these separately


    if (cookieName.match('^govuk_surveySeen') || cookieName.match('^govuk_taken')) {
      return window.GOVUK.checkConsentCookieCategory(cookieName, 'settings');
    }

    if (COOKIE_CATEGORIES[cookieName]) {
      var cookieCategory = COOKIE_CATEGORIES[cookieName];
      return window.GOVUK.checkConsentCookieCategory(cookieName, cookieCategory);
    } else {
      // Deny the cookie if it is not known to us
      return false;
    }
  };

  window.GOVUK.setCookie = function (name, value, options) {
    if (window.GOVUK.checkConsentCookie(name, value)) {
      if (typeof options === 'undefined') {
        options = {};
      }

      var cookieString = name + '=' + value + '; path=/';

      if (options.days) {
        var date = new Date();
        date.setTime(date.getTime() + options.days * 24 * 60 * 60 * 1000);
        cookieString = cookieString + '; expires=' + date.toGMTString();
      }

      if (document.location.protocol === 'https:') {
        cookieString = cookieString + '; Secure';
      }

      document.cookie = cookieString;
    }
  };

  window.GOVUK.getCookie = function (name) {
    var nameEQ = name + '=';
    var cookies = document.cookie.split(';');

    for (var i = 0, len = cookies.length; i < len; i++) {
      var cookie = cookies[i];

      while (cookie.charAt(0) === ' ') {
        cookie = cookie.substring(1, cookie.length);
      }

      if (cookie.indexOf(nameEQ) === 0) {
        return decodeURIComponent(cookie.substring(nameEQ.length));
      }
    }

    return null;
  };

  window.GOVUK.getCookieCategory = function (cookie) {
    return COOKIE_CATEGORIES[cookie];
  };

  window.GOVUK.deleteCookie = function (cookie) {
    window.GOVUK.cookie(cookie, null);

    if (window.GOVUK.cookie(cookie)) {
      // We need to handle deleting cookies on the domain and the .domain
      document.cookie = cookie + '=;expires=' + new Date() + ';';
      document.cookie = cookie + '=;expires=' + new Date() + ';domain=' + window.location.hostname + ';path=/';
    }
  };

  window.GOVUK.deleteUnconsentedCookies = function () {
    var currentConsent = window.GOVUK.getConsentCookie();

    for (var cookieType in currentConsent) {
      // Delete cookies of that type if consent being set to false
      if (!currentConsent[cookieType]) {
        for (var cookie in COOKIE_CATEGORIES) {
          if (COOKIE_CATEGORIES[cookie] === cookieType) {
            window.GOVUK.deleteCookie(cookie);
          }
        }
      }
    }
  };
})(window);

window.GOVUKFrontend.CookieBanner = {
  init: function init() {
    window.GOVUK = window.GOVUK || {}; // console.log("cookie banner");

    this.cookieBanner = document.querySelector('.gem-c-cookie-banner');
    this.cookieBannerConfirmationMessage = document.querySelector('.gem-c-cookie-banner__confirmation');
    this.setUpCookieMessage();
  },
  setUpCookieMessage: function setUpCookieMessage() {
    this.hideLink = document.querySelector('button[data-hide-cookie-banner]');

    if (this.hideLink) {
      this.hideLink.addEventListener('click', this.hideCookieMessage);
    }

    this.acceptCookiesLink = document.querySelector('button[data-accept-cookies]');

    if (this.acceptCookiesLink) {
      this.acceptCookiesLink.addEventListener('click', this.setCookieConsent.bind(this));
    }

    this.showCookieMessage();
  },
  showCookieMessage: function showCookieMessage() {
    var shouldHaveCoookieMessage = window.GOVUK.cookie('cookies_preferences_set') !== 'true';

    if (shouldHaveCoookieMessage) {
      this.cookieBanner.style.display = 'block';

      if (!window.GOVUK.cookie('cookies_policy')) {
        window.GOVUK.setDefaultConsentCookie();
      }

      window.GOVUK.deleteUnconsentedCookies();
    } else {
      this.cookieBanner.style.display = 'none';
    }
  },
  hideCookieMessage: function hideCookieMessage(event) {
    if (this.cookieBanner) {
      this.cookieBanner.style.display = 'none';
      window.GOVUK.cookie('cookies_preferences_set', 'true', {
        days: 0
      });
    }

    if (event && event.target) {
      event.preventDefault();
    }
  },
  showConfirmationMessage: function showConfirmationMessage() {
    this.cookieBannerMainContent = document.querySelector('.gem-c-cookie-banner__wrapper');
    this.cookieBannerMainContent.style.display = 'none';
    this.cookieBannerConfirmationMessage.style.display = 'block';
  },
  setCookieConsent: function setCookieConsent() {
    window.GOVUK.approveAllCookieTypes();
    this.showConfirmationMessage();
    this.cookieBannerConfirmationMessage.focus();
    window.GOVUK.cookie('cookies_preferences_set', value, {
      days: 0
    });

    if (window.GOVUK.analyticsInit) {
      window.GOVUK.analyticsInit();
    }
  }
};
/**
 * Fix maxlength for numeric fields`
 */

var _iterator = _createForOfIteratorHelper(document.querySelectorAll('[type="number"]')),
    _step;

try {
  for (_iterator.s(); !(_step = _iterator.n()).done;) {
    var element = _step.value;
    element.addEventListener('keypress', function (event) {
      var maxlength = this.getAttribute('maxlength');

      if (this.value.length >= maxlength) {
        event.preventDefault();
      }
    });
  }
} catch (err) {
  _iterator.e(err);
} finally {
  _iterator.f();
}

window.GOVUK.canTrackUsage = function () {
  var policy = JSON.parse(window.GOVUK.getCookie('cookies_policy'));
  return policy['usage'] || true;
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

/***/ "./resources/sass/application-ie8.scss":
/*!*********************************************!*\
  !*** ./resources/sass/application-ie8.scss ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***************************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ./resources/sass/application-ie8.scss ***!
  \***************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! D:\Projects\Clients\MoD\mod-ssr\application\resources\js\app.js */"./resources/js/app.js");
__webpack_require__(/*! D:\Projects\Clients\MoD\mod-ssr\application\resources\sass\app.scss */"./resources/sass/app.scss");
module.exports = __webpack_require__(/*! D:\Projects\Clients\MoD\mod-ssr\application\resources\sass\application-ie8.scss */"./resources/sass/application-ie8.scss");


/***/ })

/******/ });