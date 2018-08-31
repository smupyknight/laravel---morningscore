const env = require("app/services/env");
const assign = require("object-assign");

class Debugger {

	expose(vars) {
		if (env.debug() && env.client()) {
			assign(window, vars);
		}

		return this;
	}

}

module.exports = new Debugger();