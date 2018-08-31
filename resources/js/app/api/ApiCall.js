const {createPipeline} = require("cleopatra");
const {reportAndThrow} = require("app/util/errors");
const env = require("app/services/env");
const axios = require("axios");

class ApiCall {
    constructor(property, url, method = 'post') {
        this.request = createPipeline().report(reportAndThrow);
        this.response = createPipeline().report(reportAndThrow);
        this.request.capture(payload => {
			let path = url;
			if (typeof(path) === 'function') {
				path = path();
			}
            return axios[method](path, payload)
                .then(response => response.data)
                .then(response => {
                    env.set(property, response);
                    return this.response.dispatch(response);
                });
        });
    }
    
    run(payload) {
        return this.request.dispatch(payload);
    }
    
    onRequest(callback) {
        this.request.pipe(callback);
    }
    
    onChange(callback) {
        this.response.pipe(callback);
    }
}

module.exports = ApiCall;
