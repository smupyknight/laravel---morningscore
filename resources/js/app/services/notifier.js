const renderer = require("app/services/renderer");

class Notifier {

	get component() {
		let element = renderer.element("notifications");

		if (element == undefined) {
			throw new Error("The notifier service requires its component to be mounted.");
		}

		return element;
	}

	success(message) {
		this.component.show(message, "success");
		return this;
	}

	error(message) {
		this.component.show(message, "error");
		return this;
	}

	info(message) {
		this.component.show(message, "info");
		return this;
	}

	warning(message) {
		this.component.show(message, "warning");
		return this;
	}

}

module.exports = new Notifier();