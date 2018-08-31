function queryObject(object, query, defaults = null) {
	let current = object;
	let queryParts = query.split(".");
	let part;

	if ((object === null) || (object === undefined)) {
		return defaults;
	}

	while (current && (queryParts.length > 0)) {
		part = queryParts.shift();

		if (current[part] === undefined) {
			return defaults;
		}

		current = current[part];
	}

	return current;
}

module.exports = queryObject;