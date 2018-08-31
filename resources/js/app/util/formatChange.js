const formatNumber = require('./formatNumber');

function formatChange(num, dot) {

    let sign = '';

    if (num > 0) {
        sign = '+';
    }

    return sign + formatNumber(num);
}

module.exports = formatChange;