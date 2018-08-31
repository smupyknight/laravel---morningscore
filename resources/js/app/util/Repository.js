const queryObject = require("app/util/queryObject");

class Repository {

	constructor(data = {}) {
		this.data = data;
	}

	get(query, defaultValue = null) {
		if (arguments.length === 0) {
			return this.data;
		}

		return queryObject(this.data, query, defaultValue);
	}

	set(query, value) {
		// Check if query is an object
		if (typeof query === "object") {
			this.data = query;
			return this;
		}

		let parts = query.split(".");
		let key = parts.pop();
		let parentQuery = parts.join(".");
		let parent = parts.length === 0 ? this.get() : this.get(parentQuery);

		if (parent == undefined) {
			this.set(parentQuery, (parent = {}));
		}

		parent[key] = value;

		return this;
	}

	remove(query) {
		let parts = query.split(".");
		let key = parts.pop();
		let parentQuery = parts.join(".");
		let target = parts.length === 0 ? this.get() : this.get(parentQuery);

		if (target && (typeof target === "object")) {
			delete target[key];
		}

		return this;
	}

	has(query) {
		return this.get(query) != undefined;
	}

	empty() {
		this.data = {};
		return this;
	}

	isEmpty() {
		return Object.keys(this.data) === 0;
	}

}

module.exports = Repository;