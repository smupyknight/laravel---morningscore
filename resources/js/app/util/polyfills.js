
require("babel-polyfill");

const elementDataset = require("element-dataset").default;
const formData = require("formdata-polyfill-on-demand");

function querySelectorScope(doc, proto) {
    try { // check if browser supports :scope natively
        doc.querySelector(':scope body');
    } catch (err) { // polyfill native methods if it doesn't
        ['querySelector', 'querySelectorAll'].forEach(function (method) {
            var nativ = proto[method];
            proto[method] = function (selectors) {
                if (/(^|,)\s*:scope/.test(selectors)) { // only if selectors contains :scope
                    var id = this.id; // remember current element id
                    this.id = 'ID_' + Date.now(); // assign new unique id
                    selectors = selectors.replace(/((^|,)\s*):scope/g, '$1#' + this.id); // replace :scope with #ID
                    var result = doc[method](selectors);
                    this.id = id; // restore previous id
                    return result;
                } else {
                    return nativ.call(this, selectors); // use native code for other selectors
                }
            }
        });
    }
}

function nodeListForEach() {
    if (typeof NodeList.prototype.forEach === "function") {
        return false;
    }

    NodeList.prototype.forEach = Array.prototype.forEach;
}

function promise() {
    if (window.Promise == undefined) {
        window.Promise = require("es6-promise");
    }
}

function reactClassStaticInheritance() {
    // Skip if the browser provides the __proto__ functionality
    if (Object.__proto__ != undefined) {
        return;
    }

    // Patch react.Component so that it works with transform-class-inherited-hook
    // and allows us to shim inherited static properties
    let React = require("react");

    class Component extends React.Component {
        static onInherited(child) {
            ["onInherited", "propTypes", "defaultProps"].forEach(prop => {
                if (!child.hasOwnProperty(prop) && this.hasOwnProperty(prop)) {
                    child[prop] = this[prop];
                }
            });
        }
    }

    React.Component = Component;
}

function arrayFrom() {
    if (typeof Array.from !== "function") {
        Array.from = arrayLike => Array.prototype.slice.call(arrayLike);
    }
}


if (!Element.prototype.matches) {
    Element.prototype.matches = Element.prototype.msMatchesSelector ||
        Element.prototype.webkitMatchesSelector;
}
if (!Element.prototype.closest) {
    Element.prototype.closest = function (s) {
        var el = this;
        if (!document.documentElement.contains(el)) return null;
        do {
            if (el.matches(s)) return el;
            el = el.parentElement || el.parentNode;
        } while (el !== null && el.nodeType === 1);
        return null;
    };
}


module.exports = function () {
    querySelectorScope(window.document, Element.prototype);
    arrayFrom();
    nodeListForEach();
    promise();
    elementDataset();
    reactClassStaticInheritance();
    formData();
};
