function formatNumber(num, decimals = 0, min_decimals = 1, dot = '.', decimal = ',') {
	if (num === null || num === undefined) {
		return 0;
	}

	if(typeof num === 'string'){
		num = parseFloat(num);
	}

	if(num < 10){
        decimals = min_decimals;
	}

	if(num === 0){
		return 0;
	}

	let numStr = num.toFixed(decimals);
	let fraction = "";

	if (decimals > 0) {
		fraction = decimal + numStr.substr(numStr.indexOf(".") + 1);
		numStr = numStr.substr(0, numStr.indexOf("."));
	}

	return numStr.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1" + dot) + fraction;
}

function formatInteger(num, dot, decimal){
	return formatNumber(num, 0, 0, dot, decimal);
}

function formatSignedNumber(num, dot, decimal, decimals, min_decimals = 1) {
	const formatted = formatNumber(num, decimals,min_decimals, dot, decimal);
	return num > 0 ? `+${formatted}` : formatted;
}

function formatDecimalNumber(num, precision = 2, min_decimals = 1, thousands = ",", decimal = ".") {
	return formatNumber(num, precision, min_decimals, thousands, decimal);
}

function formatSignedDecimalNumber(num, precision = 2, min_decimals = 1, thousands = ",", decimal = ".") {
	return formatSignedNumber(num, precision, min_decimals, thousands, decimal);
}

module.exports = formatNumber;
module.exports.signed = formatSignedNumber;
module.exports.decimal = formatDecimalNumber;
module.exports.signedDecimal = formatSignedDecimalNumber;
module.exports.integer = formatInteger;
