/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/components/Accelerator_Card_Component.js":
/*!******************************************************!*\
  !*** ./src/components/Accelerator_Card_Component.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ AcceleratorCardComponent)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _Accelerator_Card_Item_String__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Accelerator_Card_Item_String */ "./src/components/Accelerator_Card_Item_String.js");
/* harmony import */ var _Accelerator_Card_Item_Bool__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./Accelerator_Card_Item_Bool */ "./src/components/Accelerator_Card_Item_Bool.js");




class AcceleratorCardComponent extends (react__WEBPACK_IMPORTED_MODULE_1___default().Component) {
  constructor(props) {
    super(props);

    // Set the meta
    this.meta = props.meta;
    console.log(this.meta);
  }
  render() {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "stats-wrapper"
    }, Object.keys(gin0115AcceleratorPanel.metaKeys).map((key, index) => {
      // Get the full meta key from its short name.
      const metaKey = gin0115AcceleratorPanel.metaKeys[key];

      // Get the value from the meta.
      const value = this.meta[metaKey];

      // Get the icon and title from the meta details.
      const metaDetails = gin0115AcceleratorPanel.metaDetails[metaKey];
      const icon = metaDetails ? metaDetails.icon : 'unset';
      const title = metaDetails ? metaDetails.title : 'unset';

      // If value is a string.
      if (typeof value === 'string') {
        return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_Accelerator_Card_Item_String__WEBPACK_IMPORTED_MODULE_2__["default"], {
          key: key,
          title: title,
          icon: icon,
          value: value
        });
      }
      if (typeof value === 'boolean') {
        return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_Accelerator_Card_Item_Bool__WEBPACK_IMPORTED_MODULE_3__["default"], {
          key: key,
          title: title,
          icon: icon,
          value: value
        });
      }
    }));
  }
}

/***/ }),

/***/ "./src/components/Accelerator_Card_Item_Bool.js":
/*!******************************************************!*\
  !*** ./src/components/Accelerator_Card_Item_Bool.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ AcceleratorCardItemBool)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);


class AcceleratorCardItemBool extends (react__WEBPACK_IMPORTED_MODULE_1___default().Component) {
  constructor(args) {
    super();
    this.title = args.title;
    this.icon = args.icon;
    this.value = args.value;
  }
  render() {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "accelerator-item numerical"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "accelerator-item__icon"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
      src: this.icon,
      alt: this.title
    })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "accelerator-item__title"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
      className: "attribute-title"
    }, this.title))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "accelerator-item__value"
    }, this.value ? 'Yes' : 'No'));
  }
}

/***/ }),

/***/ "./src/components/Accelerator_Card_Item_String.js":
/*!********************************************************!*\
  !*** ./src/components/Accelerator_Card_Item_String.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ AcceleratorCardItemString)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);


class AcceleratorCardItemString extends (react__WEBPACK_IMPORTED_MODULE_1___default().Component) {
  constructor(args) {
    super();
    this.title = args.title;
    this.icon = args.icon;
    this.value = args.value;
  }
  render() {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "accelerator-item numerical"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "accelerator-item__icon"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
      src: this.icon,
      alt: this.title
    })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "accelerator-item__title"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
      className: "attribute-title"
    }, this.title))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "accelerator-item__value"
    }, this.value));
  }
}

/***/ }),

/***/ "./assets/css/accelerator-panel.scss":
/*!*******************************************!*\
  !*** ./assets/css/accelerator-panel.scss ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!****************************************!*\
  !*** ./src/accelerator-panel/index.js ***!
  \****************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_Accelerator_Card_Component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/Accelerator_Card_Component */ "./src/components/Accelerator_Card_Component.js");
/* harmony import */ var _assets_css_accelerator_panel_scss__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./../../assets/css/accelerator-panel.scss */ "./assets/css/accelerator-panel.scss");




const getPostID = () => {
  const wrapper = document.querySelector('#react-app');
  return wrapper.dataset.foo;
};
const AcceleratorPanel = () => {
  const [postMeta, setPostMeta] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(0);
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    const fetchPostMeta = async () => {
      const response = await fetch(gin0115AcceleratorPanel.rest + getPostID());
      const data = await response.json();
      setPostMeta(data.meta);
    };
    fetchPostMeta().catch(err => {
      console.log(err.message);
    });
  }, []);

  // Show loading until we have data
  if (postMeta === 0) return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, "Loading...");

  // Render the details.
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    id: "accelerator-stats"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Accelerator_Card_Component__WEBPACK_IMPORTED_MODULE_1__["default"], {
    meta: postMeta
  }));
};
(0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.render)((0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(AcceleratorPanel, null), document.getElementById('react-app'));
})();

/******/ })()
;
//# sourceMappingURL=index.js.map