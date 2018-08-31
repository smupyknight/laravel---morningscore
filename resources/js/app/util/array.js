function chunk(array, length) {
	let chunks = [];
	let currentChunk;

	array.forEach((item, i) => {
		if (i % length === 0) {
			if (currentChunk) {
				chunks.push(currentChunk);
			}

			currentChunk = [];
		}

		currentChunk.push(item);
	});

	chunks.push(currentChunk);

	return chunks;
}

module.exports = {
	chunk
};