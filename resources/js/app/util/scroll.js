const animate = require("animejs");
const element = require("app/util/element");

function getBodyScrollingElement() {
	return document.scrollingElement || document.documentElement || document.body;
}

function animateScroll(targets, position = 0, duration = 500, easing = "linear") {
	return animate({
		targets: targets,
		duration: duration,
		easing: easing,
		scrollTop: position
	});
}

function animateBodyScroll(position = 0, duration = 500, easing = "linear") {
	let targets = [getBodyScrollingElement()];

	if (document.documentElement) {
		targets.push(document.documentElement);
	}

	return animateScroll(targets, position - element(document.body).paddingTop, duration, easing);
}

function animateBodyScrollToAnchorElement(anchorElement, offset = 0, ...args) {
	if (typeof  anchorElement === "string") {
		anchorElement = document.querySelector(anchorElement);
	}

	if (!(anchorElement instanceof HTMLElement)) {
		return;
	}

	return animateBodyScroll(anchorElement.offsetTop + offset, ...args);
}

module.exports = {
	getBodyScrollingElement,
	animateScroll,
	animateBodyScroll,
	animateBodyScrollToAnchorElement
};