const env = require("app/services/env");
const global = global || window;
const location = global.location || {origin: "", pathname: ""};
const {toQueryString} = require("app/util/url");

class Router {

	get baseUrl() {
		return env.get("router.baseUrl", location.origin);
	}

	get currentUrl() {
		return env.get("router.currentUrl", location.origin + location.pathname);
	}

	get currentRoute() {
		return env.get("router.currentRoute");
	}

	get routes() {
		return env.get("router.routes", {});
	}

	url(path = "", queryParams = null) {
		if (path.length === 0) {
			return this.baseUrl;
		}

		if (path.substr(0, 1) === "/") {
			path = path.substring(1);
		}

		let url = `${this.baseUrl}/${path}`;

		if (queryParams) {
			if (typeof queryParams === "string") {
				url += `?${queryParams}`;
			}
			else if (typeof queryParams === "object") {
				url += `?${toQueryString(queryParams)}`;
			}
		}

		return url;
	}

	containsRoute(name) {
		return this.routes[name] != undefined;
	}

	getRoute(name) {
		return this.routes[name];
	}

	route(name, params = null, queryParams = null) {
		if (!this.containsRoute(name)) {
			throw new Error(`The route '${name}' doesn't exist.`);
		}

		let uri = this.getRoute(name).uri;

		if (params && (typeof params === "object")) {
			Object.keys(params).forEach((key) => {
				uri = uri.replace(new RegExp("\\{" + key + "\\??\\}", "g"), params[key]);
			});

			// replace remaining optional parameters
			uri = uri.replace(/\{[^}]+\?\}/g, "");

			// replace double slashed resulted from stripping optional parameters
			uri = uri.replace(/\/{2,}/g, "/");

			// replace end slash resulted from stripping optional parameters
			uri = uri.replace(/\/$/g, "");
		}

		return this.url(uri, queryParams);
	}

}

module.exports = new Router();
