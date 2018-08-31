class Preloader {

	get element() {
		let element = document.querySelector("#preloader");

		if (element == undefined) {
			throw new Error("The preloader service cannot find its `#preloader` element.");
		}

		return element;
	}

	show() {
		let element = this.element;
		let classList = element.className.split(" ");
		let index = classList.indexOf("complete");

		if (index > -1) {
			classList.splice(index, 1);
		}

		element.className = classList.join(" ");
		return this;
	}

	hide() {
		let element = this.element;
		let classList = element.className.split(" ");
		let index = classList.indexOf("complete");

		if (index === -1) {
			classList.push("complete");
		}

		element.className = classList.join(" ");
		return this;
	}

}

module.exports = new Preloader();