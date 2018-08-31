const logger = require("app/services/logger");

function reportAndThrow(error) {
	logger.error(error);
	throw error;
}

function reportOnly(error) {
	logger.error(error);
}

module.exports = {
	reportAndThrow,
	reportOnly
};