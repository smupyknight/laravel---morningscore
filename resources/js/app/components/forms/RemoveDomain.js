const Form = require("app/components/forms/Form");
const EnvApi = require("app/api/EnvData");
const PropTypes = require("prop-types");
const assign = require("object-assign");
const env = require("app/services/env");

class RemoveDomain extends Form {
	constructor(props) {
		super(props);

		this.state = {
			locale: null,
		};
	}

    static get propTypes() {
        return assign({}, super.propTypes, {
            domain_id: PropTypes.number.isRequired,
            domain: PropTypes.string.isRequired,
            locale_id: PropTypes.number.isRequired,
        });
    }

    static get defaultProps() {
        return assign({}, super.defaultProps, {
            locales: env.get('locales'),
        });
    }

    componentDidMount() {
    	let {locales} = this.props;
    	let {locale_id} = this.props;
    	let locale = this.findLocale(locales, locale_id);
    	if (locale) {
    		this.setState({locale: locale});
		}
	}

	componentWillUnmount() {
		this.setState({
			loading: false,
			errors: null,
		});
	}

    performSubmit(form) {
        if (this.beforeSubmit() === false) {
			return;
		}
        return EnvApi.domains.remove.run(this.buildPayload(form))
            .then(response => {
                this.onComplete(response);
                return response;
            })
            .catch(error => {
                this.onError(error.response.data);
            });
    }

    findLocale(locales, id) {
    	for (country in locales) {
    		for (language in locales[country] ) {
    			let local = locales[country][language];
    			if (local.id === id) {
    				return local;
				}
			}
		}
		return null;
	}

    renderForm() {
    	let {locale} = this.state;

    	return (
			<form onSubmit={this.onSubmit}>
				<div className="form-group domain-list">
					<div className="fields-group fields-group--inline">
						<input type="hidden" name="domain_id" value={this.props.domain_id}/>
						<p>
							{ locale ? (
								<span title={locale.display} className={`flag-icon flag-icon-${locale.icon_name}`}></span>
							) : null }
							{this.props.domain}
						</p>
                        
						<input type="submit" name="" value="" className="remove" />
					</div>
					{this.renderError("domain_id")}
				</div>
			</form>
    	);
	}
}

module.exports = RemoveDomain;
