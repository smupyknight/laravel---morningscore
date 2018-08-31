function decodeHtmlEntity(str) {
	return str.replace(/&#([a-z0-9]+);/gi, function (match, dec) {
		return String.fromCharCode(parseInt("0" + dec));
	});
}

function encodeHtmlEntity(str) {
	let buf = [];
	for (let i = str.length - 1; i >= 0; i--) {
		buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
	}
	return buf.join('');
}

module.exports = {
	decodeHtmlEntity,
	encodeHtmlEntity
};
