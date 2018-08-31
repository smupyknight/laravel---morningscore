const env = require("app/services/env");
let token;

function csrfToken() {
	if (env.server()) {
		return;
	}

	if (token == undefined) {
		const tokenMeta = document.head.querySelector("meta[name=csrf-token]");

		if (tokenMeta) {
			token = tokenMeta.content;
		}
	}

	return token;
}

module.exports = csrfToken;