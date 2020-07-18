/******/ (function(modules) { // webpackBootstrap
/******/ 	// install a JSONP callback for chunk loading
/******/ 	function webpackJsonpCallback(data) {
/******/ 		var chunkIds = data[0];
/******/ 		var moreModules = data[1];
/******/ 		var executeModules = data[2];
/******/
/******/ 		// add "moreModules" to the modules object,
/******/ 		// then flag all "chunkIds" as loaded and fire callback
/******/ 		var moduleId, chunkId, i = 0, resolves = [];
/******/ 		for(;i < chunkIds.length; i++) {
/******/ 			chunkId = chunkIds[i];
/******/ 			if(Object.prototype.hasOwnProperty.call(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 				resolves.push(installedChunks[chunkId][0]);
/******/ 			}
/******/ 			installedChunks[chunkId] = 0;
/******/ 		}
/******/ 		for(moduleId in moreModules) {
/******/ 			if(Object.prototype.hasOwnProperty.call(moreModules, moduleId)) {
/******/ 				modules[moduleId] = moreModules[moduleId];
/******/ 			}
/******/ 		}
/******/ 		if(parentJsonpFunction) parentJsonpFunction(data);
/******/
/******/ 		while(resolves.length) {
/******/ 			resolves.shift()();
/******/ 		}
/******/
/******/ 		// add entry modules from loaded chunk to deferred list
/******/ 		deferredModules.push.apply(deferredModules, executeModules || []);
/******/
/******/ 		// run deferred modules when all chunks ready
/******/ 		return checkDeferredModules();
/******/ 	};
/******/ 	function checkDeferredModules() {
/******/ 		var result;
/******/ 		for(var i = 0; i < deferredModules.length; i++) {
/******/ 			var deferredModule = deferredModules[i];
/******/ 			var fulfilled = true;
/******/ 			for(var j = 1; j < deferredModule.length; j++) {
/******/ 				var depId = deferredModule[j];
/******/ 				if(installedChunks[depId] !== 0) fulfilled = false;
/******/ 			}
/******/ 			if(fulfilled) {
/******/ 				deferredModules.splice(i--, 1);
/******/ 				result = __webpack_require__(__webpack_require__.s = deferredModule[0]);
/******/ 			}
/******/ 		}
/******/
/******/ 		return result;
/******/ 	}
/******/
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// object to store loaded and loading chunks
/******/ 	// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 	// Promise = chunk loading, 0 = chunk loaded
/******/ 	var installedChunks = {
/******/ 		"app": 0
/******/ 	};
/******/
/******/ 	var deferredModules = [];
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
/******/ 	__webpack_require__.p = "/build/";
/******/
/******/ 	var jsonpArray = window["webpackJsonp"] = window["webpackJsonp"] || [];
/******/ 	var oldJsonpFunction = jsonpArray.push.bind(jsonpArray);
/******/ 	jsonpArray.push = webpackJsonpCallback;
/******/ 	jsonpArray = jsonpArray.slice();
/******/ 	for(var i = 0; i < jsonpArray.length; i++) webpackJsonpCallback(jsonpArray[i]);
/******/ 	var parentJsonpFunction = oldJsonpFunction;
/******/
/******/
/******/ 	// add entry module to deferred list
/******/ 	deferredModules.push(["./assets/js/app.js","vendors~app"]);
/******/ 	// run deferred modules when ready
/******/ 	return checkDeferredModules();
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _scss_app_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/app.scss */ "./assets/scss/app.scss");
/* harmony import */ var _scss_app_scss__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_scss_app_scss__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(bootstrap__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _components_time__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/time */ "./assets/js/components/time.js");
/* harmony import */ var _components_delete__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/delete */ "./assets/js/components/delete.js");
/* harmony import */ var _components_selecte__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/selecte */ "./assets/js/components/selecte.js");
/* harmony import */ var _components_media__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/media */ "./assets/js/components/media.js");
/* harmony import */ var _components_galleryList__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./components/galleryList */ "./assets/js/components/galleryList.js");
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you require will output into a single css file (app.css in this case)







 // Need jQuery? Install it with 'yarn add jquery', then uncomment to require it.
// const $ = require('jquery');

jquery__WEBPACK_IMPORTED_MODULE_1___default()(document).ready(function () {
  jquery__WEBPACK_IMPORTED_MODULE_1___default()('.alert-success').fadeTo(2000, 500).slideUp(500, function () {
    jquery__WEBPACK_IMPORTED_MODULE_1___default()('.alert-success').slideUp(500);
  }); //if need
  // $('.custom-file-input').on('change', function(event) {
  //     let inputFile = event.currentTarget;
  //     $(inputFile).parent()
  //         .find('.custom-file-label')
  //         .html(inputFile.files[0].name);
  // });
});
console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

/***/ }),

/***/ "./assets/js/components/delete.js":
/*!****************************************!*\
  !*** ./assets/js/components/delete.js ***!
  \****************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);

jquery__WEBPACK_IMPORTED_MODULE_0___default()('tbody').on('click', '.delete', function (e) {
  e.preventDefault();

  if (confirm('Are you sure you want to removed this?')) {
    var del = function del(url) {
      jquery__WEBPACK_IMPORTED_MODULE_0___default.a.ajax({
        type: 'DELETE',
        url: url
      }).done(function (data) {
        jquery__WEBPACK_IMPORTED_MODULE_0___default()(this).parents('tr').remove();
        jquery__WEBPACK_IMPORTED_MODULE_0___default()('#id').remove();
      }).fail(function () {
        alert('Could not be deleted');
      });
    };

    jquery__WEBPACK_IMPORTED_MODULE_0___default()(this).parents('tr').remove();
    var url = jquery__WEBPACK_IMPORTED_MODULE_0___default()(this).attr('href');
    del(url);
  }
});

/***/ }),

/***/ "./assets/js/components/galleryList.js":
/*!*********************************************!*\
  !*** ./assets/js/components/galleryList.js ***!
  \*********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_find__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.find */ "./node_modules/core-js/modules/es.array.find.js");
/* harmony import */ var core_js_modules_es_array_find__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_find__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_1__);


var selectFormGallery = jquery__WEBPACK_IMPORTED_MODULE_1___default()('.js-select-form-gallery');
var selectTargetGallery = jquery__WEBPACK_IMPORTED_MODULE_1___default()('.js-select-target-gallery');
var pageDescription = jquery__WEBPACK_IMPORTED_MODULE_1___default()('.page-description');
selectFormGallery.on('change', function (e) {
  jquery__WEBPACK_IMPORTED_MODULE_1___default.a.ajax({
    url: selectFormGallery.data('gallery-specific-url'),
    data: {
      location: selectFormGallery.val()
    },
    success: function success(html) {
      if (!html) {
        selectTargetGallery.find('select').remove();
        selectTargetGallery.addClass('d-none');
        pageDescription.removeClass('d-none');
        return;
      }

      selectTargetGallery.html(html).removeClass('d-none');
      pageDescription.addClass('d-none');
    }
  });
});

/***/ }),

/***/ "./assets/js/components/media.js":
/*!***************************************!*\
  !*** ./assets/js/components/media.js ***!
  \***************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_function_name__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.function.name */ "./node_modules/core-js/modules/es.function.name.js");
/* harmony import */ var core_js_modules_es_function_name__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_name__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_web_timers__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/web.timers */ "./node_modules/core-js/modules/web.timers.js");
/* harmony import */ var core_js_modules_web_timers__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_timers__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_2__);



window.Dropzone = __webpack_require__(/*! dropzone/dist/min/dropzone.min */ "./node_modules/dropzone/dist/min/dropzone.min.js");
Dropzone.autoDiscover = false;
jquery__WEBPACK_IMPORTED_MODULE_2___default()(document).ready(function () {
  var galleryId = document.querySelector('.gallery_block');
  var total_photos_counter = 0;
  Dropzone.autoDiscover = false;

  if (jquery__WEBPACK_IMPORTED_MODULE_2___default()('.dropzone').length) {
    var myDropzone = new Dropzone('.js-media-dropzone', {
      autoProcessQueue: false,
      parallelUploads: 20,
      maxFilesize: 200,
      // thumbnailWidth: 120,
      // thumbnailHeight: 120,
      addRemoveLinks: true,
      dictFileTooBig: 'Limit: 10MB',
      timeout: 180000,
      dictDefaultMessage: "Click me",
      maxThumbnailFilesize: 200,
      maxFiles: 20,
      init: function init() {
        this.on("removedfile", function (file) {
          if (typeof file.xhr !== 'undefined') {
            var fileData = JSON.parse(file.xhr.responseText);
            delImageDropzone(fileData);
          }

          ;
        });
        this.on("uploadprogress", function (file, progress) {
          console.log("File progress", progress);
        });
        jquery__WEBPACK_IMPORTED_MODULE_2___default.a.get('/mb-crm/admin/media/' + galleryId.dataset.id, function (file) {
          jquery__WEBPACK_IMPORTED_MODULE_2___default.a.each(file, function (key, value) {
            if (value.length > 0) {
              jquery__WEBPACK_IMPORTED_MODULE_2___default.a.each(value, function (k, v) {
                var mockFile = {
                  name: v.originalFileName,
                  size: v.size,
                  id: v.id
                };
                myDropzone.options.addedfile.call(myDropzone, mockFile);
                myDropzone.options.thumbnail.call(myDropzone, mockFile, '/uploads/galleries/' + v.fileName);
                jquery__WEBPACK_IMPORTED_MODULE_2___default()('.dz-progress').hide();
              });
            }

            myDropzone.on("removedfile", function (file) {
              delImageDropzone(file);
            });
          });
        });
      },
      success: function success(file, done) {
        total_photos_counter++;
        jquery__WEBPACK_IMPORTED_MODULE_2___default()("#counter").text("# " + total_photos_counter);
      }
    }); // Submit

    var button = document.getElementById('upload-files');
    button.addEventListener('click', function () {
      // Retrieve selected files
      var acceptedFiles = myDropzone.getAcceptedFiles();

      var _loop = function _loop(i) {
        setTimeout(function () {
          myDropzone.processFile(acceptedFiles[i]);
        }, i * 2000);
      };

      for (var i = 0; i < acceptedFiles.length; i++) {
        _loop(i);
      }
    });
  }

  function delImageDropzone(file) {
    if (typeof file.id !== 'undefined') {
      jquery__WEBPACK_IMPORTED_MODULE_2___default.a.ajax({
        type: 'DELETE',
        url: '/mb-crm/admin/media/' + file.id + '/remove',
        data: {
          id: file.name,
          _token: jquery__WEBPACK_IMPORTED_MODULE_2___default()('[name="_token"]').val()
        },
        dataType: 'json',
        success: function success(data) {
          total_photos_counter--;
          jquery__WEBPACK_IMPORTED_MODULE_2___default()("#counter").text("# " + total_photos_counter);
        }
      });
    }
  }
});

/***/ }),

/***/ "./assets/js/components/selecte.js":
/*!*****************************************!*\
  !*** ./assets/js/components/selecte.js ***!
  \*****************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_find__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.find */ "./node_modules/core-js/modules/es.array.find.js");
/* harmony import */ var core_js_modules_es_array_find__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_find__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_1__);


var selectForm = jquery__WEBPACK_IMPORTED_MODULE_1___default()('.js-select-form');
var selectTarget = jquery__WEBPACK_IMPORTED_MODULE_1___default()('.js-select-target');
selectForm.on('change', function (e) {
  jquery__WEBPACK_IMPORTED_MODULE_1___default.a.ajax({
    url: selectForm.data('specific-url'),
    data: {
      location: selectForm.val()
    },
    success: function success(html) {
      if (!html) {
        selectTarget.find('select').remove();
        selectTarget.addClass('d-none');
        return;
      }

      selectTarget.html(html).removeClass('d-none');
    }
  });
});

/***/ }),

/***/ "./assets/js/components/time.js":
/*!**************************************!*\
  !*** ./assets/js/components/time.js ***!
  \**************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_date_to_string__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.date.to-string */ "./node_modules/core-js/modules/es.date.to-string.js");
/* harmony import */ var core_js_modules_es_date_to_string__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_date_to_string__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_web_timers__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/web.timers */ "./node_modules/core-js/modules/web.timers.js");
/* harmony import */ var core_js_modules_web_timers__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_timers__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_2__);



jquery__WEBPACK_IMPORTED_MODULE_2___default()(document).ready(function () {
  setInterval(function () {
    var hours = new Date().getHours();
    jquery__WEBPACK_IMPORTED_MODULE_2___default()(".hours").html((hours < 10 ? "0" : "") + hours);
  }, 1000);
  setInterval(function () {
    var minutes = new Date().getMinutes();
    jquery__WEBPACK_IMPORTED_MODULE_2___default()(".min").html((minutes < 10 ? "0" : "") + minutes);
  }, 1000);
  setInterval(function () {
    var seconds = new Date().getSeconds();
    jquery__WEBPACK_IMPORTED_MODULE_2___default()(".sec").html((seconds < 10 ? "0" : "") + seconds);
  }, 1000);
});

/***/ }),

/***/ "./assets/scss/app.scss":
/*!******************************!*\
  !*** ./assets/scss/app.scss ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvY29tcG9uZW50cy9kZWxldGUuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2NvbXBvbmVudHMvZ2FsbGVyeUxpc3QuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2NvbXBvbmVudHMvbWVkaWEuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2NvbXBvbmVudHMvc2VsZWN0ZS5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvY29tcG9uZW50cy90aW1lLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zY3NzL2FwcC5zY3NzIl0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5IiwiZmFkZVRvIiwic2xpZGVVcCIsImNvbnNvbGUiLCJsb2ciLCJvbiIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImNvbmZpcm0iLCJkZWwiLCJ1cmwiLCJhamF4IiwidHlwZSIsImRvbmUiLCJkYXRhIiwicGFyZW50cyIsInJlbW92ZSIsImZhaWwiLCJhbGVydCIsImF0dHIiLCJzZWxlY3RGb3JtR2FsbGVyeSIsInNlbGVjdFRhcmdldEdhbGxlcnkiLCJwYWdlRGVzY3JpcHRpb24iLCJsb2NhdGlvbiIsInZhbCIsInN1Y2Nlc3MiLCJodG1sIiwiZmluZCIsImFkZENsYXNzIiwicmVtb3ZlQ2xhc3MiLCJ3aW5kb3ciLCJEcm9wem9uZSIsInJlcXVpcmUiLCJhdXRvRGlzY292ZXIiLCJnYWxsZXJ5SWQiLCJxdWVyeVNlbGVjdG9yIiwidG90YWxfcGhvdG9zX2NvdW50ZXIiLCJsZW5ndGgiLCJteURyb3B6b25lIiwiYXV0b1Byb2Nlc3NRdWV1ZSIsInBhcmFsbGVsVXBsb2FkcyIsIm1heEZpbGVzaXplIiwiYWRkUmVtb3ZlTGlua3MiLCJkaWN0RmlsZVRvb0JpZyIsInRpbWVvdXQiLCJkaWN0RGVmYXVsdE1lc3NhZ2UiLCJtYXhUaHVtYm5haWxGaWxlc2l6ZSIsIm1heEZpbGVzIiwiaW5pdCIsImZpbGUiLCJ4aHIiLCJmaWxlRGF0YSIsIkpTT04iLCJwYXJzZSIsInJlc3BvbnNlVGV4dCIsImRlbEltYWdlRHJvcHpvbmUiLCJwcm9ncmVzcyIsImdldCIsImRhdGFzZXQiLCJpZCIsImVhY2giLCJrZXkiLCJ2YWx1ZSIsImsiLCJ2IiwibW9ja0ZpbGUiLCJuYW1lIiwib3JpZ2luYWxGaWxlTmFtZSIsInNpemUiLCJvcHRpb25zIiwiYWRkZWRmaWxlIiwiY2FsbCIsInRodW1ibmFpbCIsImZpbGVOYW1lIiwiaGlkZSIsInRleHQiLCJidXR0b24iLCJnZXRFbGVtZW50QnlJZCIsImFkZEV2ZW50TGlzdGVuZXIiLCJhY2NlcHRlZEZpbGVzIiwiZ2V0QWNjZXB0ZWRGaWxlcyIsImkiLCJzZXRUaW1lb3V0IiwicHJvY2Vzc0ZpbGUiLCJfdG9rZW4iLCJkYXRhVHlwZSIsInNlbGVjdEZvcm0iLCJzZWxlY3RUYXJnZXQiLCJzZXRJbnRlcnZhbCIsImhvdXJzIiwiRGF0ZSIsImdldEhvdXJzIiwibWludXRlcyIsImdldE1pbnV0ZXMiLCJzZWNvbmRzIiwiZ2V0U2Vjb25kcyJdLCJtYXBwaW5ncyI6IjtRQUFBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0EsUUFBUSxvQkFBb0I7UUFDNUI7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQSxpQkFBaUIsNEJBQTRCO1FBQzdDO1FBQ0E7UUFDQSxrQkFBa0IsMkJBQTJCO1FBQzdDO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTs7UUFFQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBO1FB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akcsaURBQUMsQ0FBQyxNQUFELENBQUQsQ0FBVTRCLElBQVYsQ0FBZSxDQUFFb0UsT0FBTyxHQUFHLEVBQVYsR0FBZSxHQUFmLEdBQXFCLEVBQXZCLElBQThCQSxPQUE3QztBQUNILEdBSFUsRUFHVCxJQUhTLENBQVg7QUFJSCxDQWJELEU7Ozs7Ozs7Ozs7O0FDRkEsdUMiLCJmaWxlIjoiYXBwLmpzIiwic291cmNlc0NvbnRlbnQiOlsiIFx0Ly8gaW5zdGFsbCBhIEpTT05QIGNhbGxiYWNrIGZvciBjaHVuayBsb2FkaW5nXG4gXHRmdW5jdGlvbiB3ZWJwYWNrSnNvbnBDYWxsYmFjayhkYXRhKSB7XG4gXHRcdHZhciBjaHVua0lkcyA9IGRhdGFbMF07XG4gXHRcdHZhciBtb3JlTW9kdWxlcyA9IGRhdGFbMV07XG4gXHRcdHZhciBleGVjdXRlTW9kdWxlcyA9IGRhdGFbMl07XG5cbiBcdFx0Ly8gYWRkIFwibW9yZU1vZHVsZXNcIiB0byB0aGUgbW9kdWxlcyBvYmplY3QsXG4gXHRcdC8vIHRoZW4gZmxhZyBhbGwgXCJjaHVua0lkc1wiIGFzIGxvYWRlZCBhbmQgZmlyZSBjYWxsYmFja1xuIFx0XHR2YXIgbW9kdWxlSWQsIGNodW5rSWQsIGkgPSAwLCByZXNvbHZlcyA9IFtdO1xuIFx0XHRmb3IoO2kgPCBjaHVua0lkcy5sZW5ndGg7IGkrKykge1xuIFx0XHRcdGNodW5rSWQgPSBjaHVua0lkc1tpXTtcbiBcdFx0XHRpZihPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwoaW5zdGFsbGVkQ2h1bmtzLCBjaHVua0lkKSAmJiBpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF0pIHtcbiBcdFx0XHRcdHJlc29sdmVzLnB1c2goaW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdWzBdKTtcbiBcdFx0XHR9XG4gXHRcdFx0aW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdID0gMDtcbiBcdFx0fVxuIFx0XHRmb3IobW9kdWxlSWQgaW4gbW9yZU1vZHVsZXMpIHtcbiBcdFx0XHRpZihPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwobW9yZU1vZHVsZXMsIG1vZHVsZUlkKSkge1xuIFx0XHRcdFx0bW9kdWxlc1ttb2R1bGVJZF0gPSBtb3JlTW9kdWxlc1ttb2R1bGVJZF07XG4gXHRcdFx0fVxuIFx0XHR9XG4gXHRcdGlmKHBhcmVudEpzb25wRnVuY3Rpb24pIHBhcmVudEpzb25wRnVuY3Rpb24oZGF0YSk7XG5cbiBcdFx0d2hpbGUocmVzb2x2ZXMubGVuZ3RoKSB7XG4gXHRcdFx0cmVzb2x2ZXMuc2hpZnQoKSgpO1xuIFx0XHR9XG5cbiBcdFx0Ly8gYWRkIGVudHJ5IG1vZHVsZXMgZnJvbSBsb2FkZWQgY2h1bmsgdG8gZGVmZXJyZWQgbGlzdFxuIFx0XHRkZWZlcnJlZE1vZHVsZXMucHVzaC5hcHBseShkZWZlcnJlZE1vZHVsZXMsIGV4ZWN1dGVNb2R1bGVzIHx8IFtdKTtcblxuIFx0XHQvLyBydW4gZGVmZXJyZWQgbW9kdWxlcyB3aGVuIGFsbCBjaHVua3MgcmVhZHlcbiBcdFx0cmV0dXJuIGNoZWNrRGVmZXJyZWRNb2R1bGVzKCk7XG4gXHR9O1xuIFx0ZnVuY3Rpb24gY2hlY2tEZWZlcnJlZE1vZHVsZXMoKSB7XG4gXHRcdHZhciByZXN1bHQ7XG4gXHRcdGZvcih2YXIgaSA9IDA7IGkgPCBkZWZlcnJlZE1vZHVsZXMubGVuZ3RoOyBpKyspIHtcbiBcdFx0XHR2YXIgZGVmZXJyZWRNb2R1bGUgPSBkZWZlcnJlZE1vZHVsZXNbaV07XG4gXHRcdFx0dmFyIGZ1bGZpbGxlZCA9IHRydWU7XG4gXHRcdFx0Zm9yKHZhciBqID0gMTsgaiA8IGRlZmVycmVkTW9kdWxlLmxlbmd0aDsgaisrKSB7XG4gXHRcdFx0XHR2YXIgZGVwSWQgPSBkZWZlcnJlZE1vZHVsZVtqXTtcbiBcdFx0XHRcdGlmKGluc3RhbGxlZENodW5rc1tkZXBJZF0gIT09IDApIGZ1bGZpbGxlZCA9IGZhbHNlO1xuIFx0XHRcdH1cbiBcdFx0XHRpZihmdWxmaWxsZWQpIHtcbiBcdFx0XHRcdGRlZmVycmVkTW9kdWxlcy5zcGxpY2UoaS0tLCAxKTtcbiBcdFx0XHRcdHJlc3VsdCA9IF9fd2VicGFja19yZXF1aXJlX18oX193ZWJwYWNrX3JlcXVpcmVfXy5zID0gZGVmZXJyZWRNb2R1bGVbMF0pO1xuIFx0XHRcdH1cbiBcdFx0fVxuXG4gXHRcdHJldHVybiByZXN1bHQ7XG4gXHR9XG5cbiBcdC8vIFRoZSBtb2R1bGUgY2FjaGVcbiBcdHZhciBpbnN0YWxsZWRNb2R1bGVzID0ge307XG5cbiBcdC8vIG9iamVjdCB0byBzdG9yZSBsb2FkZWQgYW5kIGxvYWRpbmcgY2h1bmtzXG4gXHQvLyB1bmRlZmluZWQgPSBjaHVuayBub3QgbG9hZGVkLCBudWxsID0gY2h1bmsgcHJlbG9hZGVkL3ByZWZldGNoZWRcbiBcdC8vIFByb21pc2UgPSBjaHVuayBsb2FkaW5nLCAwID0gY2h1bmsgbG9hZGVkXG4gXHR2YXIgaW5zdGFsbGVkQ2h1bmtzID0ge1xuIFx0XHRcImFwcFwiOiAwXG4gXHR9O1xuXG4gXHR2YXIgZGVmZXJyZWRNb2R1bGVzID0gW107XG5cbiBcdC8vIFRoZSByZXF1aXJlIGZ1bmN0aW9uXG4gXHRmdW5jdGlvbiBfX3dlYnBhY2tfcmVxdWlyZV9fKG1vZHVsZUlkKSB7XG5cbiBcdFx0Ly8gQ2hlY2sgaWYgbW9kdWxlIGlzIGluIGNhY2hlXG4gXHRcdGlmKGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdKSB7XG4gXHRcdFx0cmV0dXJuIGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdLmV4cG9ydHM7XG4gXHRcdH1cbiBcdFx0Ly8gQ3JlYXRlIGEgbmV3IG1vZHVsZSAoYW5kIHB1dCBpdCBpbnRvIHRoZSBjYWNoZSlcbiBcdFx0dmFyIG1vZHVsZSA9IGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdID0ge1xuIFx0XHRcdGk6IG1vZHVsZUlkLFxuIFx0XHRcdGw6IGZhbHNlLFxuIFx0XHRcdGV4cG9ydHM6IHt9XG4gXHRcdH07XG5cbiBcdFx0Ly8gRXhlY3V0ZSB0aGUgbW9kdWxlIGZ1bmN0aW9uXG4gXHRcdG1vZHVsZXNbbW9kdWxlSWRdLmNhbGwobW9kdWxlLmV4cG9ydHMsIG1vZHVsZSwgbW9kdWxlLmV4cG9ydHMsIF9fd2VicGFja19yZXF1aXJlX18pO1xuXG4gXHRcdC8vIEZsYWcgdGhlIG1vZHVsZSBhcyBsb2FkZWRcbiBcdFx0bW9kdWxlLmwgPSB0cnVlO1xuXG4gXHRcdC8vIFJldHVybiB0aGUgZXhwb3J0cyBvZiB0aGUgbW9kdWxlXG4gXHRcdHJldHVybiBtb2R1bGUuZXhwb3J0cztcbiBcdH1cblxuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZXMgb2JqZWN0IChfX3dlYnBhY2tfbW9kdWxlc19fKVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5tID0gbW9kdWxlcztcblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGUgY2FjaGVcbiBcdF9fd2VicGFja19yZXF1aXJlX18uYyA9IGluc3RhbGxlZE1vZHVsZXM7XG5cbiBcdC8vIGRlZmluZSBnZXR0ZXIgZnVuY3Rpb24gZm9yIGhhcm1vbnkgZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kID0gZnVuY3Rpb24oZXhwb3J0cywgbmFtZSwgZ2V0dGVyKSB7XG4gXHRcdGlmKCFfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZXhwb3J0cywgbmFtZSkpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgbmFtZSwgeyBlbnVtZXJhYmxlOiB0cnVlLCBnZXQ6IGdldHRlciB9KTtcbiBcdFx0fVxuIFx0fTtcblxuIFx0Ly8gZGVmaW5lIF9fZXNNb2R1bGUgb24gZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yID0gZnVuY3Rpb24oZXhwb3J0cykge1xuIFx0XHRpZih0eXBlb2YgU3ltYm9sICE9PSAndW5kZWZpbmVkJyAmJiBTeW1ib2wudG9TdHJpbmdUYWcpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgU3ltYm9sLnRvU3RyaW5nVGFnLCB7IHZhbHVlOiAnTW9kdWxlJyB9KTtcbiBcdFx0fVxuIFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgJ19fZXNNb2R1bGUnLCB7IHZhbHVlOiB0cnVlIH0pO1xuIFx0fTtcblxuIFx0Ly8gY3JlYXRlIGEgZmFrZSBuYW1lc3BhY2Ugb2JqZWN0XG4gXHQvLyBtb2RlICYgMTogdmFsdWUgaXMgYSBtb2R1bGUgaWQsIHJlcXVpcmUgaXRcbiBcdC8vIG1vZGUgJiAyOiBtZXJnZSBhbGwgcHJvcGVydGllcyBvZiB2YWx1ZSBpbnRvIHRoZSBuc1xuIFx0Ly8gbW9kZSAmIDQ6IHJldHVybiB2YWx1ZSB3aGVuIGFscmVhZHkgbnMgb2JqZWN0XG4gXHQvLyBtb2RlICYgOHwxOiBiZWhhdmUgbGlrZSByZXF1aXJlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnQgPSBmdW5jdGlvbih2YWx1ZSwgbW9kZSkge1xuIFx0XHRpZihtb2RlICYgMSkgdmFsdWUgPSBfX3dlYnBhY2tfcmVxdWlyZV9fKHZhbHVlKTtcbiBcdFx0aWYobW9kZSAmIDgpIHJldHVybiB2YWx1ZTtcbiBcdFx0aWYoKG1vZGUgJiA0KSAmJiB0eXBlb2YgdmFsdWUgPT09ICdvYmplY3QnICYmIHZhbHVlICYmIHZhbHVlLl9fZXNNb2R1bGUpIHJldHVybiB2YWx1ZTtcbiBcdFx0dmFyIG5zID0gT2JqZWN0LmNyZWF0ZShudWxsKTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yKG5zKTtcbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KG5zLCAnZGVmYXVsdCcsIHsgZW51bWVyYWJsZTogdHJ1ZSwgdmFsdWU6IHZhbHVlIH0pO1xuIFx0XHRpZihtb2RlICYgMiAmJiB0eXBlb2YgdmFsdWUgIT0gJ3N0cmluZycpIGZvcih2YXIga2V5IGluIHZhbHVlKSBfX3dlYnBhY2tfcmVxdWlyZV9fLmQobnMsIGtleSwgZnVuY3Rpb24oa2V5KSB7IHJldHVybiB2YWx1ZVtrZXldOyB9LmJpbmQobnVsbCwga2V5KSk7XG4gXHRcdHJldHVybiBucztcbiBcdH07XG5cbiBcdC8vIGdldERlZmF1bHRFeHBvcnQgZnVuY3Rpb24gZm9yIGNvbXBhdGliaWxpdHkgd2l0aCBub24taGFybW9ueSBtb2R1bGVzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm4gPSBmdW5jdGlvbihtb2R1bGUpIHtcbiBcdFx0dmFyIGdldHRlciA9IG1vZHVsZSAmJiBtb2R1bGUuX19lc01vZHVsZSA/XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0RGVmYXVsdCgpIHsgcmV0dXJuIG1vZHVsZVsnZGVmYXVsdCddOyB9IDpcbiBcdFx0XHRmdW5jdGlvbiBnZXRNb2R1bGVFeHBvcnRzKCkgeyByZXR1cm4gbW9kdWxlOyB9O1xuIFx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQoZ2V0dGVyLCAnYScsIGdldHRlcik7XG4gXHRcdHJldHVybiBnZXR0ZXI7XG4gXHR9O1xuXG4gXHQvLyBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGxcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubyA9IGZ1bmN0aW9uKG9iamVjdCwgcHJvcGVydHkpIHsgcmV0dXJuIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChvYmplY3QsIHByb3BlcnR5KTsgfTtcblxuIFx0Ly8gX193ZWJwYWNrX3B1YmxpY19wYXRoX19cbiBcdF9fd2VicGFja19yZXF1aXJlX18ucCA9IFwiL2J1aWxkL1wiO1xuXG4gXHR2YXIganNvbnBBcnJheSA9IHdpbmRvd1tcIndlYnBhY2tKc29ucFwiXSA9IHdpbmRvd1tcIndlYnBhY2tKc29ucFwiXSB8fCBbXTtcbiBcdHZhciBvbGRKc29ucEZ1bmN0aW9uID0ganNvbnBBcnJheS5wdXNoLmJpbmQoanNvbnBBcnJheSk7XG4gXHRqc29ucEFycmF5LnB1c2ggPSB3ZWJwYWNrSnNvbnBDYWxsYmFjaztcbiBcdGpzb25wQXJyYXkgPSBqc29ucEFycmF5LnNsaWNlKCk7XG4gXHRmb3IodmFyIGkgPSAwOyBpIDwganNvbnBBcnJheS5sZW5ndGg7IGkrKykgd2VicGFja0pzb25wQ2FsbGJhY2soanNvbnBBcnJheVtpXSk7XG4gXHR2YXIgcGFyZW50SnNvbnBGdW5jdGlvbiA9IG9sZEpzb25wRnVuY3Rpb247XG5cblxuIFx0Ly8gYWRkIGVudHJ5IG1vZHVsZSB0byBkZWZlcnJlZCBsaXN0XG4gXHRkZWZlcnJlZE1vZHVsZXMucHVzaChbXCIuL2Fzc2V0cy9qcy9hcHAuanNcIixcInZlbmRvcnN+YXBwXCJdKTtcbiBcdC8vIHJ1biBkZWZlcnJlZCBtb2R1bGVzIHdoZW4gcmVhZHlcbiBcdHJldHVybiBjaGVja0RlZmVycmVkTW9kdWxlcygpO1xuIiwiLypcbiAqIFdlbGNvbWUgdG8geW91ciBhcHAncyBtYWluIEphdmFTY3JpcHQgZmlsZSFcbiAqXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXG4gKiAoYW5kIGl0cyBDU1MgZmlsZSkgaW4geW91ciBiYXNlIGxheW91dCAoYmFzZS5odG1sLnR3aWcpLlxuICovXG5cbi8vIGFueSBDU1MgeW91IHJlcXVpcmUgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXG5pbXBvcnQgJy4uL3Njc3MvYXBwLnNjc3MnO1xuXG5pbXBvcnQgJCBmcm9tICdqcXVlcnknO1xuaW1wb3J0ICdib290c3RyYXAnO1xuaW1wb3J0ICcuL2NvbXBvbmVudHMvdGltZSdcbmltcG9ydCAnLi9jb21wb25lbnRzL2RlbGV0ZSdcbmltcG9ydCAnLi9jb21wb25lbnRzL3NlbGVjdGUnXG5pbXBvcnQgJy4vY29tcG9uZW50cy9tZWRpYSdcbmltcG9ydCAnLi9jb21wb25lbnRzL2dhbGxlcnlMaXN0J1xuXG4vLyBOZWVkIGpRdWVyeT8gSW5zdGFsbCBpdCB3aXRoICd5YXJuIGFkZCBqcXVlcnknLCB0aGVuIHVuY29tbWVudCB0byByZXF1aXJlIGl0LlxuLy8gY29uc3QgJCA9IHJlcXVpcmUoJ2pxdWVyeScpO1xuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKXtcbiAgICAkKCcuYWxlcnQtc3VjY2VzcycpLmZhZGVUbygyMDAwLCA1MDApLnNsaWRlVXAoNTAwLCBmdW5jdGlvbigpe1xuICAgICAgICAkKCcuYWxlcnQtc3VjY2VzcycpLnNsaWRlVXAoNTAwKTtcbiAgICB9KTtcblxuICAgIC8vaWYgbmVlZFxuICAgIC8vICQoJy5jdXN0b20tZmlsZS1pbnB1dCcpLm9uKCdjaGFuZ2UnLCBmdW5jdGlvbihldmVudCkge1xuICAgIC8vICAgICBsZXQgaW5wdXRGaWxlID0gZXZlbnQuY3VycmVudFRhcmdldDtcbiAgICAvLyAgICAgJChpbnB1dEZpbGUpLnBhcmVudCgpXG4gICAgLy8gICAgICAgICAuZmluZCgnLmN1c3RvbS1maWxlLWxhYmVsJylcbiAgICAvLyAgICAgICAgIC5odG1sKGlucHV0RmlsZS5maWxlc1swXS5uYW1lKTtcbiAgICAvLyB9KTtcbn0pO1xuXG5jb25zb2xlLmxvZygnSGVsbG8gV2VicGFjayBFbmNvcmUhIEVkaXQgbWUgaW4gYXNzZXRzL2pzL2FwcC5qcycpO1xuIiwiaW1wb3J0ICQgZnJvbSBcImpxdWVyeVwiO1xuXG4kKCd0Ym9keScpLm9uKCdjbGljaycsICcuZGVsZXRlJywgZnVuY3Rpb24oZSl7XG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgIGlmIChjb25maXJtKCdBcmUgeW91IHN1cmUgeW91IHdhbnQgdG8gcmVtb3ZlZCB0aGlzPycpKSB7XG4gICAgICAgICQodGhpcykucGFyZW50cygndHInKS5yZW1vdmUoKTtcbiAgICAgICAgbGV0IHVybCA9ICQodGhpcykuYXR0cignaHJlZicpO1xuICAgICAgICBkZWwodXJsKTtcblxuICAgICAgICBmdW5jdGlvbiBkZWwodXJsKSB7XG4gICAgICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgICAgIHR5cGU6ICdERUxFVEUnLFxuICAgICAgICAgICAgICAgIHVybDogdXJsXG4gICAgICAgICAgICB9KS5kb25lKGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgICAgICAgJCh0aGlzKS5wYXJlbnRzKCd0cicpLnJlbW92ZSgpO1xuICAgICAgICAgICAgICAgICQoJyNpZCcpLnJlbW92ZSgpO1xuICAgICAgICAgICAgfSkuZmFpbChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgYWxlcnQoJ0NvdWxkIG5vdCBiZSBkZWxldGVkJyk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuICAgIH1cbn0pOyIsImltcG9ydCAkIGZyb20gXCJqcXVlcnlcIjtcblxubGV0IHNlbGVjdEZvcm1HYWxsZXJ5ID0gJCgnLmpzLXNlbGVjdC1mb3JtLWdhbGxlcnknKTtcbmxldCBzZWxlY3RUYXJnZXRHYWxsZXJ5ID0gJCgnLmpzLXNlbGVjdC10YXJnZXQtZ2FsbGVyeScpO1xubGV0IHBhZ2VEZXNjcmlwdGlvbiA9ICQoJy5wYWdlLWRlc2NyaXB0aW9uJyk7XG5cbnNlbGVjdEZvcm1HYWxsZXJ5Lm9uKCdjaGFuZ2UnLCBmdW5jdGlvbiAoZSkge1xuXG4gICAgJC5hamF4KHtcbiAgICAgICAgdXJsOiBzZWxlY3RGb3JtR2FsbGVyeS5kYXRhKCdnYWxsZXJ5LXNwZWNpZmljLXVybCcpLFxuICAgICAgICBkYXRhOiB7XG4gICAgICAgICAgICBsb2NhdGlvbjogc2VsZWN0Rm9ybUdhbGxlcnkudmFsKClcbiAgICAgICAgfSxcblxuICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiAoaHRtbCkge1xuICAgICAgICAgICAgaWYgKCFodG1sKSB7XG5cbiAgICAgICAgICAgICAgICBzZWxlY3RUYXJnZXRHYWxsZXJ5LmZpbmQoJ3NlbGVjdCcpLnJlbW92ZSgpO1xuICAgICAgICAgICAgICAgIHNlbGVjdFRhcmdldEdhbGxlcnkuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICAgICAgICAgIHBhZ2VEZXNjcmlwdGlvbi5yZW1vdmVDbGFzcygnZC1ub25lJyk7XG5cbiAgICAgICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHNlbGVjdFRhcmdldEdhbGxlcnlcbiAgICAgICAgICAgICAgICAuaHRtbChodG1sKVxuICAgICAgICAgICAgICAgIC5yZW1vdmVDbGFzcygnZC1ub25lJyk7XG5cbiAgICAgICAgICAgIHBhZ2VEZXNjcmlwdGlvbi5hZGRDbGFzcygnZC1ub25lJyk7XG4gICAgICAgIH1cbiAgICB9KTtcbn0pOyIsImltcG9ydCAkIGZyb20gJ2pxdWVyeSc7XG5cbndpbmRvdy5Ecm9wem9uZSA9IHJlcXVpcmUoJ2Ryb3B6b25lL2Rpc3QvbWluL2Ryb3B6b25lLm1pbicpO1xuRHJvcHpvbmUuYXV0b0Rpc2NvdmVyID0gZmFsc2U7XG5cbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xuICAgIGxldCBnYWxsZXJ5SWQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuZ2FsbGVyeV9ibG9jaycpO1xuXG4gICAgdmFyIHRvdGFsX3Bob3Rvc19jb3VudGVyID0gMDtcbiAgICBEcm9wem9uZS5hdXRvRGlzY292ZXIgPSBmYWxzZTtcbiAgICBpZiAoJCgnLmRyb3B6b25lJykubGVuZ3RoKSB7XG4gICAgICAgIGNvbnN0IG15RHJvcHpvbmUgPSBuZXcgRHJvcHpvbmUoJy5qcy1tZWRpYS1kcm9wem9uZScsIHtcbiAgICAgICAgICAgIGF1dG9Qcm9jZXNzUXVldWU6IGZhbHNlLFxuICAgICAgICAgICAgcGFyYWxsZWxVcGxvYWRzOiAyMCxcbiAgICAgICAgICAgIG1heEZpbGVzaXplOiAyMDAsXG4gICAgICAgICAgICAvLyB0aHVtYm5haWxXaWR0aDogMTIwLFxuICAgICAgICAgICAgLy8gdGh1bWJuYWlsSGVpZ2h0OiAxMjAsXG4gICAgICAgICAgICBhZGRSZW1vdmVMaW5rczogdHJ1ZSxcbiAgICAgICAgICAgIGRpY3RGaWxlVG9vQmlnOiAnTGltaXQ6IDEwTUInLFxuICAgICAgICAgICAgdGltZW91dDogMTgwMDAwLFxuICAgICAgICAgICAgZGljdERlZmF1bHRNZXNzYWdlOiBcIkNsaWNrIG1lXCIsXG4gICAgICAgICAgICBtYXhUaHVtYm5haWxGaWxlc2l6ZTogMjAwLFxuICAgICAgICAgICAgbWF4RmlsZXM6MjAsXG5cbiAgICAgICAgICAgIGluaXQ6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICB0aGlzLm9uKFwicmVtb3ZlZGZpbGVcIiwgZnVuY3Rpb24gKGZpbGUpIHtcblxuICAgICAgICAgICAgICAgICAgICBpZiAodHlwZW9mIGZpbGUueGhyICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgICAgICAgICAgICAgbGV0IGZpbGVEYXRhID0gSlNPTi5wYXJzZShmaWxlLnhoci5yZXNwb25zZVRleHQpO1xuICAgICAgICAgICAgICAgICAgICAgICAgZGVsSW1hZ2VEcm9wem9uZShmaWxlRGF0YSk7XG4gICAgICAgICAgICAgICAgICAgIH07XG4gICAgICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICAgICB0aGlzLm9uKFwidXBsb2FkcHJvZ3Jlc3NcIiwgZnVuY3Rpb24oZmlsZSwgcHJvZ3Jlc3MpIHtcbiAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2coXCJGaWxlIHByb2dyZXNzXCIsIHByb2dyZXNzKTtcbiAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgICAgICQuZ2V0KCcvbWItY3JtL2FkbWluL21lZGlhLycgKyBnYWxsZXJ5SWQuZGF0YXNldC5pZCwgZnVuY3Rpb24gKGZpbGUpIHtcbiAgICAgICAgICAgICAgICAgICAgJC5lYWNoKGZpbGUsIGZ1bmN0aW9uIChrZXksIHZhbHVlKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBpZiAodmFsdWUubGVuZ3RoID4gMCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICQuZWFjaCh2YWx1ZSwgZnVuY3Rpb24gKGssIHYpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbGV0IG1vY2tGaWxlID0ge25hbWU6IHYub3JpZ2luYWxGaWxlTmFtZSwgc2l6ZTogdi5zaXplLCBpZDogdi5pZH07XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIG15RHJvcHpvbmUub3B0aW9ucy5hZGRlZGZpbGUuY2FsbChteURyb3B6b25lLCBtb2NrRmlsZSk7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIG15RHJvcHpvbmUub3B0aW9ucy50aHVtYm5haWwuY2FsbChteURyb3B6b25lLCBtb2NrRmlsZSwgJy91cGxvYWRzL2dhbGxlcmllcy8nICsgdi5maWxlTmFtZSk7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICQoJy5kei1wcm9ncmVzcycpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgICAgIG15RHJvcHpvbmUub24oXCJyZW1vdmVkZmlsZVwiLCBmdW5jdGlvbiAoZmlsZSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGRlbEltYWdlRHJvcHpvbmUoZmlsZSlcbiAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgfSxcblxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKGZpbGUsIGRvbmUpIHtcbiAgICAgICAgICAgICAgICB0b3RhbF9waG90b3NfY291bnRlcisrO1xuICAgICAgICAgICAgICAgICQoXCIjY291bnRlclwiKS50ZXh0KFwiIyBcIiArIHRvdGFsX3Bob3Rvc19jb3VudGVyKTtcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH0pO1xuXG4gICAgICAgIC8vIFN1Ym1pdFxuICAgICAgICBjb25zdCBidXR0b24gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgndXBsb2FkLWZpbGVzJyk7XG4gICAgICAgIGJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIC8vIFJldHJpZXZlIHNlbGVjdGVkIGZpbGVzXG4gICAgICAgICAgICBjb25zdCBhY2NlcHRlZEZpbGVzID0gbXlEcm9wem9uZS5nZXRBY2NlcHRlZEZpbGVzKCk7XG4gICAgICAgICAgICBmb3IgKGxldCBpID0gMDsgaSA8IGFjY2VwdGVkRmlsZXMubGVuZ3RoOyBpKyspIHtcbiAgICAgICAgICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAgICAgbXlEcm9wem9uZS5wcm9jZXNzRmlsZShhY2NlcHRlZEZpbGVzW2ldKVxuICAgICAgICAgICAgICAgIH0sIGkgKiAyMDAwKVxuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBmdW5jdGlvbiBkZWxJbWFnZURyb3B6b25lKGZpbGUpIHtcbiAgICAgICAgaWYgKHR5cGVvZiBmaWxlLmlkICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgICAgICB0eXBlOiAnREVMRVRFJyxcbiAgICAgICAgICAgICAgICB1cmw6ICcvbWItY3JtL2FkbWluL21lZGlhLycgKyBmaWxlLmlkICsgJy9yZW1vdmUnLFxuICAgICAgICAgICAgICAgIGRhdGE6IHtpZDogZmlsZS5uYW1lLCBfdG9rZW46ICQoJ1tuYW1lPVwiX3Rva2VuXCJdJykudmFsKCl9LFxuICAgICAgICAgICAgICAgIGRhdGFUeXBlOiAnanNvbicsXG4gICAgICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgICAgICAgICAgICAgdG90YWxfcGhvdG9zX2NvdW50ZXItLTtcbiAgICAgICAgICAgICAgICAgICAgJChcIiNjb3VudGVyXCIpLnRleHQoXCIjIFwiICsgdG90YWxfcGhvdG9zX2NvdW50ZXIpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgfVxufSk7IiwiaW1wb3J0ICQgZnJvbSBcImpxdWVyeVwiO1xuXG5sZXQgc2VsZWN0Rm9ybSA9ICQoJy5qcy1zZWxlY3QtZm9ybScpO1xubGV0IHNlbGVjdFRhcmdldCA9ICQoJy5qcy1zZWxlY3QtdGFyZ2V0Jyk7XG5cbnNlbGVjdEZvcm0ub24oJ2NoYW5nZScsIGZ1bmN0aW9uIChlKSB7XG5cbiAgICAkLmFqYXgoe1xuICAgICAgICB1cmw6IHNlbGVjdEZvcm0uZGF0YSgnc3BlY2lmaWMtdXJsJyksXG4gICAgICAgIGRhdGE6IHtcbiAgICAgICAgICAgIGxvY2F0aW9uOiBzZWxlY3RGb3JtLnZhbCgpXG4gICAgICAgIH0sXG5cbiAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKGh0bWwpIHtcbiAgICAgICAgICAgIGlmICghaHRtbCkge1xuXG4gICAgICAgICAgICAgICAgc2VsZWN0VGFyZ2V0LmZpbmQoJ3NlbGVjdCcpLnJlbW92ZSgpO1xuICAgICAgICAgICAgICAgIHNlbGVjdFRhcmdldC5hZGRDbGFzcygnZC1ub25lJyk7XG5cbiAgICAgICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHNlbGVjdFRhcmdldFxuICAgICAgICAgICAgICAgIC5odG1sKGh0bWwpXG4gICAgICAgICAgICAgICAgLnJlbW92ZUNsYXNzKCdkLW5vbmUnKVxuICAgICAgICB9XG4gICAgfSk7XG59KTsiLCJpbXBvcnQgJCBmcm9tICdqcXVlcnknO1xuXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcbiAgICBzZXRJbnRlcnZhbCggZnVuY3Rpb24oKSB7XG4gICAgICAgIGxldCBob3VycyA9IG5ldyBEYXRlKCkuZ2V0SG91cnMoKTtcbiAgICAgICAgJChcIi5ob3Vyc1wiKS5odG1sKCggaG91cnMgPCAxMCA/IFwiMFwiIDogXCJcIiApICsgaG91cnMpO1xuICAgIH0sIDEwMDApO1xuICAgIHNldEludGVydmFsKCBmdW5jdGlvbigpIHtcbiAgICAgICAgbGV0IG1pbnV0ZXMgPSBuZXcgRGF0ZSgpLmdldE1pbnV0ZXMoKTtcbiAgICAgICAgJChcIi5taW5cIikuaHRtbCgoIG1pbnV0ZXMgPCAxMCA/IFwiMFwiIDogXCJcIiApICsgbWludXRlcyk7XG4gICAgfSwxMDAwKTtcbiAgICBzZXRJbnRlcnZhbCggZnVuY3Rpb24oKSB7XG4gICAgICAgIGxldCBzZWNvbmRzID0gbmV3IERhdGUoKS5nZXRTZWNvbmRzKCk7XG4gICAgICAgICQoXCIuc2VjXCIpLmh0bWwoKCBzZWNvbmRzIDwgMTAgPyBcIjBcIiA6IFwiXCIgKSArIHNlY29uZHMpO1xuICAgIH0sMTAwMCk7XG59KTsiLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW4iXSwic291cmNlUm9vdCI6IiJ9