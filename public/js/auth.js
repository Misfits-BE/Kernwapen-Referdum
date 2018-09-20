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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 47);
/******/ })
/************************************************************************/
/******/ ({

/***/ 47:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(48);


/***/ }),

/***/ 48:
/***/ (function(module, exports) {

$(function () {
    $("input[type='password'][data-eye]").each(function (i) {
        var $this = $(this);

        $this.wrap($("<div/>", {
            style: 'position:relative'
        }));

        $this.css({
            paddingRight: 60
        });

        $this.after($("<div/>", {
            html: 'Bekijke',
            class: 'btn btn-primary btn-sm',
            id: 'passeye-toggle-' + i,
            style: 'position:absolute;right:10px;top:50%;transform:translate(0,-50%);padding: 2px 7px;font-size:12px;cursor:pointer;'
        }));

        $this.after($("<input/>", {
            type: 'hidden',
            id: 'passeye-' + i
        }));

        $this.on("keyup paste", function () {
            $("#passeye-" + i).val($(this).val());
        });

        $("#passeye-toggle-" + i).on("click", function () {
            if ($this.hasClass("show")) {
                $this.attr('type', 'password');
                $this.removeClass("show");
                $(this).removeClass("btn-outline-primary");
            } else {
                $this.attr('type', 'text');
                $this.val($("#passeye-" + i).val());
                $this.addClass("show");
                $(this).addClass("btn-outline-primary");
            }
        });
    });
});

/***/ })

/******/ });