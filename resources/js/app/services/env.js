const Repository = require("app/util/Repository");
let global = global || window;

class Environment extends Repository {

	constructor(data) {
		super(data);

		// Attach server side setEnv helper
		if (this.server()) {
			let env = this;

			global["setEnv"] = function (data) {
				env.set(data);
			};
		}
	}

	server() {
		return this.get("environment") === "server";
	}

	client() {
		return this.server() === false;
	}

	debug() {
		return this.get("debug", false) === true;
	}

}

module.exports = new Environment(global.env || {});
