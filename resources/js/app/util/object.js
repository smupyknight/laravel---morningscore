function pluckKeys(object, keys) {
	let newObj = {};

	keys.forEach(key => newObj[key] = object[key]);
	return newObj;
}

function pluckKeysExcept(object, exceptions) {
	let keys = Object.keys(object);

	exceptions.forEach(key => {
		let index = keys.indexOf(key);

		if (index !== -1) {
			keys.splice(index, 1);
		}
	})

	return pluckKeys(object, keys);
}

module.exports = {
	pluckKeys,
	pluckKeysExcept
};