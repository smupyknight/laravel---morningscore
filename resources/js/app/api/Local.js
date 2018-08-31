const {createPipeline} = require("cleopatra");
const {reportAndThrow} = require("app/util/errors");
const env = require("app/services/env");

class Local {
    constructor(property) {
        this.local = createPipeline().pipe(payload => {
        	env.set(property, payload);
        	return payload;
        });
    }
    
    update(payload) {
        return this.local.dispatch(payload);
    }
    
    onChange(callback) {
        this.local.pipe(callback);
    }
}

module.exports = Local;
