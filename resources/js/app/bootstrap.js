const global = global || window;
const {createPipeline} = require("cleopatra");
const env = require("app/services/env");
const documentReady = require("app/util/documentReady");

// Create pipelines
let ready = createPipeline();
let bootstrap = createPipeline().capture(ready);

module.exports = bootstrap;

/////////////////////////////////
// Moment
/////////////////////////////////
bootstrap.pipe(payload => {
	const moment = require("moment");
	//moment.locale("da");

	return payload;
});

/////////////////////////////////
// Renderer
/////////////////////////////////

const renderer = require("app/services/renderer");

// Do not boot if server side
bootstrap.pipe(payload => env.client() ? payload : false);

ready.pipe(payload => {
	renderer.render();
	return payload;
});

/////////////////////////////////
// document.ready
/////////////////////////////////

bootstrap.pipe(payload => documentReady(payload));
bootstrap.pipe(payload => {
	const ReactModal = require("react-modal");
	ReactModal.setAppElement('body');
	return payload;
});

/////////////////////////////////
// axios
/////////////////////////////////

const axios = require("axios");

bootstrap.pipe(payload => {
	// Specify the X-Request-With header so that the Laravel backend knows
	// we are requiring it through ajax
	axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

	// Register the CSRF token provided by Laravel
	// This will also act as our main authentication method
	// for Passport
	let token = document.head.querySelector("meta[name=csrf-token]");

	if (token == undefined) {
		throw new Error("Cannot setup axios because the CSRF token is missing!");
	}

	axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

	return payload;
});

/////////////////////////////////
// Preloader
/////////////////////////////////

const preloader = require("app/services/preloader");

ready.capture(payload => {
	preloader.hide();
	return payload;
});
