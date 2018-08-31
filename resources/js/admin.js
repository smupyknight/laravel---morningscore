
/////////////////////////////////
// Polyfills
/////////////////////////////////

const polyfill = require("app/util/polyfills");
polyfill();

/////////////////////////////////
// Debugger
/////////////////////////////////

const debug = require("app/services/debugger");

//debug.expose({});

/////////////////////////////////
// Register components
/////////////////////////////////

const renderer = require("app/services/renderer");

renderer.register("admin", {
	Notifications: require("app/components/Notifications"),
	menus: {
		SidebarMenu: require("app/components/admin/menus/SidebarMenu")
	}
});

/////////////////////////////////
// Bootstrap
/////////////////////////////////

const logger = require("app/services/logger");

require("app/bootstrap").dispatch()
	.then(payload => {
		// At this point the application was bootstrapped and is ready.
		// You can require your javascript code here and be 100% sure it is ran in the browser.

		// require("path to my module")

		// Make sure you keep this return as it continues to pipe the payload
		// towards the end of the pipeline

		return payload;
	})
	.then(() => logger.info("The application was bootstrapped."))
	.catch(error => logger.error(error));