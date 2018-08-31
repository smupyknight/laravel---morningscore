const env = require("app/services/env");

module.exports = function(domain){
    return env.get('domain.competitors.colors.' + domain.split('www.').join('').split('.').join('_'));
};
