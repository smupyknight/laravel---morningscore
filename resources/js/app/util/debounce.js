function debounce(timeout, callback) {
	let timer;
	let debounced = function () {
		let args = arguments;

		debounced.cancel();

		timer = setTimeout(() => {
			timer = null;
			callback.apply(this, args);

		}, timeout);
	};

	debounced.cancel = function () {
		if (timer) {
			clearTimeout(timer);
			timer = null;
		}
	};

	return debounced;
}

module.exports = debounce;