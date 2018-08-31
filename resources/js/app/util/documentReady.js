const Promise = require("es6-promise");

module.exports = function (payload) {
	return new Promise((resolve) => {
		if (document.readyState === "complete") {
			return resolve(payload);
		}

		document.addEventListener("DOMContentLoaded", () => {
			resolve(payload);
		});
	});
};