/* eslint no-console:0 */
const env = require("app/services/env");

class Logger {

	log() {
		if (env.debug()) {
			console.log.apply(console, arguments);
		}
	}

	error() {
		if (env.debug()) {
			console.error.apply(console, arguments);
		}
	}

	warn() {
		if (env.debug()) {
			console.warn.apply(console, arguments);
		}
	}

	info() {
		if (env.debug()) {
			console.info.apply(console, arguments);
		}
	}

}

module.exports = new Logger();