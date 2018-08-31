const env = require("app/services/env");

function trans(key) {
    return env.get('translations.' + key);
}

function transOr(key, defaultValue) {
    return env.get('translations.' + key, defaultValue);
}

module.exports = {
    trans: trans,
    transOr: transOr
};
