const ApiCall = require("app/api/ApiCall");
const Local = require("app/api/Local");
const router = require("app/services/router");
const env = require("app/services/env");

class EnvData {
    constructor() {

    	this.period = new Local(
    		'period'
		);

		this.currency = new ApiCall(
			'user',
            () => {
            	return router.route("api.portal.user.update", {
            		user_id: env.get('user.id')
            	});
            }
		);

		this.lang = new ApiCall(
			'user',
            () => {
            	return router.route("api.portal.user.update", {
            		user_id: env.get('user.id')
            	});
            }
		);

        this.user = new ApiCall(
            'user', 
            () => {
            	return router.route("api.portal.user.update", {
            		user_id: env.get('user.id')
            	});
            }
        );

        this.company = new ApiCall(
            'company', 
            () => {
            	return router.route("api.portal.companies.update", {
            		company_id: env.get('company.id')
            	});
            }
        );

        this.target = new ApiCall(
            'domain', 
            () => {
            	return router.route("api.portal.target", null, {
            		domain_id: env.get('domain.id'),
            		//locale_id: env.get('domain.locale_id'),
            	});
            },
            'get'
        );

        this.domains = {
			add: new ApiCall(
				'domains', 
				router.route("api.portal.domains.create")
			),
			remove: new ApiCall(
				'domains', 
				router.route("api.portal.domains.delete"),
			),
		};

        this.competitors = new ApiCall(
            'domain.competitors', 
            () => {
            	return router.route("api.portal.competitors.update", {
            		domain_id: env.get('domain.id')
            	});
            }
        );

        this.keywords = {
			add: new ApiCall(
				'domain.tracked_keywords', 
				router.route("api.portal.keywords.create")
			),
			remove: new ApiCall(
				'domain.tracked_keywords', 
				router.route("api.portal.keywords.delete"),
			),
		};
	}
}

module.exports = new EnvData();
