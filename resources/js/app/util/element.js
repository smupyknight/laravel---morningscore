class Element {

	constructor(element) {
		this.element = element;
	}

	get style() {
		return getComputedStyle(this.element);
	}

	get width() {
		// Note:
		// In IE the width is returned without the padding and the border
		// while in other browsers this feature returns the whole
		// width of the element
		let width = parseInt(this.style.width);

		return width;
	}

	get height() {
		return parseInt(this.style.height);
	}

	get paddingTop() {
		return parseInt(this.style.paddingTop);
	}

	get paddingRight() {
		return parseInt(this.style.paddingRight);
	}

	get paddingBottom() {
		return parseInt(this.style.paddingBottom);
	}

	get paddingLeft() {
		return parseInt(this.style.paddingLeft);
	}

	get borderTopWidth() {
		return parseInt(this.style.borderTopWidth);
	}

	get borderRightWidth() {
		return parseInt(this.style.borderRightWidth);
	}

	get borderBottomWidth() {
		return parseInt(this.style.borderBottomWidth);
	}

	get borderLeftWidth() {
		return parseInt(this.style.borderLeftWidth);
	}

	get innerWidth() {
		return this.width - this.paddingLeft - this.paddingRight - this.borderLeftWidth - this.borderRightWidth;
	}

	get innerHeight() {
		return this.height - this.paddingTop - this.paddingBottom - this.borderTopWidth - this.borderBottomWidth;
	}

	parent(selector) {
		const parent = this.element.parentElement;

		if (parent == null) {
			return;
		}

		let currentParent = parent;
		let currentScope = currentParent.parentElement;

		while (
			currentScope &&
			(Array.from(currentScope.querySelectorAll(`:scope > ${selector}`)).indexOf(currentParent) === -1)
			) {
			currentParent = currentScope;
			currentScope = currentParent.parentElement;
		}

		return currentScope ? currentParent : null;
	}

	is(selector) {
		if (this.element.parentElement == null) {
			return false;	// TODO: Add element to temporary parent before executing the check
		}

		return Array.from(this.element.parentElement.querySelectorAll(`:scope > ${selector}`)).indexOf(this.element) !== -1;
	}

	hasClass(className) {
		const classList = className.split(" ");
		const elementClassList = this.element.className.split(" ");

		for (let i = 0; i < classList.length; i++) {
			if (elementClassList.indexOf(classList[i]) === -1) {
				return false;
			}
		}

		return true;
	}

	addClass(className) {
		let elementClassList = this.element.className.split(" ");
		let classList = className.split(" ");
		let index;

		for (let i = 0; i < classList.length; i++) {
			index = elementClassList.indexOf(classList[i]);

			if (index === -1) {
				elementClassList.push(classList[i]);
			}
		}

		this.element.className = elementClassList.join(" ");

		return this;
	}

	removeClass(className) {
		let elementClassList = this.element.className.split(" ");
		let classList = className.split(" ");
		let index;

		for (let i = 0; i < classList.length; i++) {
			index = elementClassList.indexOf(classList[i]);

			if (index > -1) {
				elementClassList.splice(index, 1);
			}
		}

		this.element.className = elementClassList.join(" ");

		return this;
	}

	toggleClass(className) {
		let elementClassList = this.element.className.split(" ");
		let classList = className.split(" ");
		let index;

		for (let i = 0; i < classList.length; i++) {
			index = elementClassList.indexOf(classList[i]);

			if (index === -1) {
				elementClassList.push(classList[i]);
			}
			else {
				elementClassList.splice(index, 1);
			}
		}

		this.element.className = elementClassList.join(" ");

		return this;
	}

	setClass(className, state = true) {
		return state ? this.addClass(className) : this.removeClass(className);
	}

}

module.exports = function (element) {
	return new Element(element);
};