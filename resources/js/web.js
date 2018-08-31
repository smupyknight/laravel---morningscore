
/////////////////////////////////
// Polyfills
/////////////////////////////////

const polyfill = require("app/util/polyfills");
polyfill();

/////////////////////////////////
// Debugger
/////////////////////////////////

const debug = require("app/services/debugger");

//debug.expose({});

/////////////////////////////////
// Register components
/////////////////////////////////

const renderer = require("app/services/renderer");

renderer.register("web", {
    Test: require("app/components/report/Test.js"),
});

/////////////////////////////////
// Bootstrap
/////////////////////////////////

const logger = require("app/services/logger");

require("app/bootstrap").dispatch()
    .then(payload => {
        // At this point the application was bootstrapped and is ready.
        // You can require your javascript code here and be 100% sure it is ran in the browser.

        // require("path to my module")

        logger.info('web')

        const ReactDOM = require('react-dom');


        const TestComponent = require('app/components/report/test');

        var target = document.querySelector("body");

        var testLimit = 2000;

        let html = '';

        for (var i = 0; i < testLimit; i++) {
            html += '<div id="test' + i + '"></div>';
        }

        target.innerHTML = html;

        for (var i = 0; i < testLimit; i++) {
            ReactDOM.render(<TestComponent></TestComponent>, document.getElementById('test' + i));
        }

        require("app/frontend/object-fit");

        // Make sure you keep this return as it continues to pipe the payload
        // towards the end of the pipeline
        return payload;
    })
    .then(() => logger.info("The application was bootstrapped."))
    .catch(error => logger.error(error));