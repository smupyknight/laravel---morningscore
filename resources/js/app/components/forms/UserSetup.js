const Form = require("app/components/forms/Form");
const router = require("app/services/router");
const env = require("app/services/env");
const LocaleField = require("app/components/forms/fields/LocaleField");
const DomainField = require("app/components/forms/fields/DomainField");
const trans = require("app/services/i18n").trans;

class UserSetup extends Form {
	constructor(props) {
		super(props);

		this.state = {
			locale_id: ""
		};
	}

    get actionUrl() {
        return router.route("portal.setup.do");
    }

	get trans() {
		return trans('setup');
	}

    selectLocale = (id) => {
    	this.setState({locale_id: id});
	}

    onComplete(response) {
    	super.onComplete(response);
    	window.location.replace(response);
	}
    
    renderForm() {
		return (
			<form onSubmit={this.onSubmit}>
				<input type="hidden" name="locale_id" value={this.state.locale_id}/>

				<div className="setup-form__body">
					<h2>{this.trans.hurray} <span>{this.trans.welcome}</span></h2>
					<p>{this.trans.need_website}</p>
					<p>{this.trans.want_competitors}</p>
					<div className="field-container">
						<label>{this.trans.website}</label>
						<DomainField
							type="text"
							name="website"
							placeholder={this.trans.your_website}
							required={true}
							autofocus={true}
						/>
						{this.renderError("website")}
					</div>

					<label>{this.trans.locale}</label>
					<LocaleField
						required={true}
						choose_lang={this.trans.choose_lang}
						choose_country={this.trans.choose_country}
						onSelect={this.selectLocale}
					/>
					{this.renderError('locale_id')}

					<div className="field-container">
						<label>{this.trans.competitors}</label>
						<DomainField
							type="text"
							name="domains[0]"
							placeholder={this.trans.competitor_site}
						/>
						{this.renderError("domains.0")}
						<DomainField
							type="text"
							name="domains[1]"
							placeholder={this.trans.competitor_site}
						/>
						{this.renderError("domains.1")}
						<DomainField
							type="text"
							name="domains[2]"
							placeholder={this.trans.competitor_site}
						/>
						{this.renderError("domains.2")}

					</div>
					<div className="submit-container register">
						<input type="submit" name="" value={this.trans.submit} className="button" />
					</div>
				</div>
			</form>
		);
	}
}

module.exports = UserSetup;
