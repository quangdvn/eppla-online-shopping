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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/utils/algoliaInstantSearch.js":
/*!****************************************************!*\
  !*** ./resources/js/utils/algoliaInstantSearch.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function () {
  // Returns a slug from the category name.
  // Spaces are replaced by "+" to make
  // the URL easier to read and other
  // characters are encoded.
  function getCategorySlug(name) {
    return name.split(' ').map(encodeURIComponent).join('+');
  } // Returns a name from the category slug.
  // The "+" are replaced by spaces and other
  // characters are decoded.


  function getCategoryName(slug) {
    return slug.split('+').map(decodeURIComponent).join(' ');
  }

  var searchClient = algoliasearch("VGYGZLD5IE", "08ef944b22bafb7eda508b643fe26518");
  var search = instantsearch({
    indexName: "products",
    searchClient: searchClient,
    routing: {
      router: instantsearch.routers.history({
        windowTitle: function windowTitle(_ref) {
          var category = _ref.category,
              query = _ref.query;
          var queryTitle = query ? "Results for \"".concat(query, "\"") : 'Search'; // if (category) {
          //     return `${category} – ${queryTitle}`;
          // }

          return queryTitle;
        },
        createURL: function createURL(_ref2) {
          var qsModule = _ref2.qsModule,
              routeState = _ref2.routeState,
              location = _ref2.location;
          var urlParts = location.href.match(/^(.*?)\/algoliasearch/);
          var baseUrl = "".concat(urlParts ? urlParts[1] : '', "/"); // const categoryPath = routeState.category
          //     ? `${getCategorySlug(routeState.category)}/`
          //     : '';

          var queryParameters = {};

          if (routeState.query) {
            queryParameters.query = encodeURIComponent(routeState.query);
          }

          if (routeState.page !== 1) {
            queryParameters.page = routeState.page;
          }

          if (routeState.brands) {
            queryParameters.brands = routeState.brands.map(encodeURIComponent);
          }

          var queryString = qsModule.stringify(queryParameters, {
            addQueryPrefix: true // arrayFormat: 'repeat'

          }); // return `${baseUrl}algoliasearch/${categoryPath}${queryString}`;

          return "".concat(baseUrl, "algoliasearch").concat(queryString);
        },
        parseURL: function parseURL(_ref3) {
          var qsModule = _ref3.qsModule,
              location = _ref3.location;
          var pathnameMatches = location.pathname.match(/algoliasearch\/(.*?)?$/); // const category = getCategoryName(
          //     (pathnameMatches && pathnameMatches[1]) || ''
          // );

          var _qsModule$parse = qsModule.parse(location.search.slice(1)),
              _qsModule$parse$query = _qsModule$parse.query,
              query = _qsModule$parse$query === void 0 ? '' : _qsModule$parse$query,
              page = _qsModule$parse.page,
              _qsModule$parse$brand = _qsModule$parse.brands,
              brands = _qsModule$parse$brand === void 0 ? [] : _qsModule$parse$brand; // `qs` does not return an array when there's a single value.
          // const allBrands = Array.isArray(brands)
          //     ? brands
          //     : [brands].filter(Boolean);


          return {
            query: decodeURIComponent(query),
            page: page // brands: allBrands.map(decodeURIComponent),
            // category

          };
        }
      }),
      stateMapping: {
        stateToRoute: function stateToRoute(uiState) {
          var indexUiState = uiState['products'] || {};
          return {
            query: indexUiState.query,
            page: indexUiState.page // brands: indexUiState.refinementList && indexUiState.refinementList.brand,
            // category: indexUiState.menu && indexUiState.menu.categories

          };
        },
        routeToState: function routeToState(routeState) {
          return {
            instant_search: {
              query: routeState.query,
              page: routeState.page,
              menu: {
                categories: routeState.category
              },
              refinementList: {
                brand: routeState.brands
              }
            }
          };
        }
      }
    }
  });
  search.addWidgets([instantsearch.widgets.searchBox({
    container: "#searchbox",
    placeholder: "Filter your wishes products here ..."
  }), instantsearch.widgets.hits({
    container: "#hits",
    templates: {
      empty: "No results",
      item: function item(_item) {
        var markup = "\n                        <a href=\"".concat(window.location.origin, "/shop/").concat(_item.slug, "\">\n                        <div class=\"instantsearch-result\">\n                            <div>\n                                <img src=\"").concat(window.location.origin, "/storage/").concat(_item.image, "\" alt=\"img\" class=\"algolia-thumb-result\">\n                            </div>\n                            <div>\n                                <div class=\"result-title\">\n                                    ").concat(_item._highlightResult.name.value, "\n                                </div>\n                                <div class=\"result-details\">\n                                    ").concat(_item._highlightResult.details.value, "\n                                </div>\n                                <div class=\"result-price\">\n                                    $").concat((_item.price / 100).toFixed(2), "\n                                </div>\n                            </div>\n                        </div>\n                    </a>\n                    <hr>\n                    ");
        return markup;
      }
    }
  }), instantsearch.widgets.pagination({
    container: "#pagination"
  }), instantsearch.widgets.stats({
    container: "#stats"
  }), instantsearch.widgets.refinementList({
    container: "#refinement-list",
    attribute: "categories"
  })]);
  search.start();
})();

/***/ }),

/***/ 5:
/*!**********************************************************!*\
  !*** multi ./resources/js/utils/algoliaInstantSearch.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! H:\Laravel\Laravel Project\eppla-online-shopping\resources\js\utils\algoliaInstantSearch.js */"./resources/js/utils/algoliaInstantSearch.js");


/***/ })

/******/ });
//# sourceMappingURL=algoliaInstantSearch.js.map