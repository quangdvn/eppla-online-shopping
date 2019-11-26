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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/utils/algoliaAutoComplete.js":
/*!***************************************************!*\
  !*** ./resources/js/utils/algoliaAutoComplete.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function () {
  var enterPressed = false;
  var searchClient = algoliasearch("VGYGZLD5IE", "08ef944b22bafb7eda508b643fe26518");
  var index = searchClient.initIndex("products"); //initialize autocomplete on search input (ID selector must match)

  autocomplete("#aa-search-input", {
    hint: true
  }, {
    source: autocomplete.sources.hits(index, {
      hitsPerPage: 10
    }),
    //value to be displayed in input control after user's suggestion selection
    displayKey: "name",
    //hash of templates used when rendering dataset
    templates: {
      //'suggestion' templating function used to render a single suggestion
      suggestion: function suggestion(_suggestion) {
        var markup = "\n                        <div class=\"algolia-result\">\n                            <span>\n                                <img src=\"".concat(window.location.origin, "/storage/").concat(_suggestion.image, "\" alt=\"img\" class=\"algolia-thumb\">\n                                ").concat(_suggestion._highlightResult.name.value, "\n                            </span>\n                            <span>$").concat((_suggestion.price / 100).toFixed(2), "</span>\n                        </div>\n                        <div class=\"algolia-details\">\n                            <span>").concat(_suggestion._highlightResult.details.value, "</span>\n                        </div>\n                    ");
        return markup;
      },
      empty: function empty(result) {
        return "Sorry, we did not find any results for ".concat(result.query);
      }
    }
  } //* Go direct to the detail page
  ).on("autocomplete:selected", function (event, suggestion, dataset) {
    window.location.href = window.location.origin + "/shop/" + suggestion.slug;
    enterPressed = true; //* Go to the search result page
  }).on('keyup', function (event) {
    if (event.keyCode == 13 && !enterPressed) {
      var queryString = document.getElementById('aa-search-input').value;
      window.location.href = window.location.origin + '/algoliasearch?query=' + queryString;
    }
  });
})();

/***/ }),

/***/ 4:
/*!*********************************************************!*\
  !*** multi ./resources/js/utils/algoliaAutoComplete.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! H:\Laravel\Laravel Project\eppla-online-shopping\resources\js\utils\algoliaAutoComplete.js */"./resources/js/utils/algoliaAutoComplete.js");


/***/ })

/******/ });
//# sourceMappingURL=algoliaAutoComplete.js.map