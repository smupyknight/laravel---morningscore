const env = require("app/services/env");

module.exports = function(a, b){
	if (a === env.get("domain.domain")) return -1;
	else if (b === env.get("domain.domain")) return 1;
	return a > b;
}
