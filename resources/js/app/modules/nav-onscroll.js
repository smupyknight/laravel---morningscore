const $ = require("app/util/element");
const {getBodyScrollingElement} = require("app/util/scroll");
const logger = require("app/services/logger");

function initialize(selector = ".main-navigation", className = "active", activeScrollOffset = 50) {
	const nav = document.querySelector(selector);

	if (nav == undefined) {
		logger.error("Module [nav-onscroll] cannot be initialized because the navigation element is missing.");
		return;
	}

	const $nav = $(nav);
	const scrollingElement = getBodyScrollingElement();
	const update = () => $nav.setClass(className, scrollingElement.scrollTop >= activeScrollOffset);

	// Update initially
	update();

	// Update on scroll
	document.addEventListener("scroll", update);
}

module.exports = initialize;