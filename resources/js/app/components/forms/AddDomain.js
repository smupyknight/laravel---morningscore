const Form = require("app/components/forms/Form");
const DomainField = require("app/components/forms/fields/DomainField");
const LocaleField = require("app/components/forms/fields/LocaleField");
const csrfToken = require("app/services/csrfToken");
const env = require("app/services/env");
const EnvApi = require("app/api/EnvData");
const Image = require("app/components/mixins/Image.js");

class AddDomain extends Form {
	constructor(props) {
		super(props);

		this.state = {
			locale_id: ""
		};
	}

	get name() {
		return 'add_domain';
	}

    performSubmit(form) {
        if (this.beforeSubmit() === false) {
			return;
		}
        return EnvApi.domains.add.run(this.buildPayload(form))
            .then(response => {
                this.onComplete(response);
                return response;
            })
            .catch(error => {
                this.onError(error.response.data);
            });
    }

    selectLocale = (id) => {
    	this.setState({locale_id: id});
	}

    renderForm() {
		return (
            
            <form onSubmit={this.onSubmit}>
				<input type="hidden" name="_token" value={csrfToken()}/>
				<input type="hidden" name="company_id" value={env.get('company.id')}/>
				<input type="hidden" name="locale_id" value={this.state.locale_id}/>

				{this.renderError('company_id')}
                <div className="form-group">
					<div className="fields-group fields-group--inline fields-group--2-col">
						<div className="field-container">
							<label><span className="highlight">{this.trans.domain}</span></label>
							<DomainField
								type="text"
								name="domain"
								placeholder={this.trans.domain}
								required={true}
							/>
							{this.renderError('domain')}
						</div>
					</div>

					<label><span className="highlight">{this.trans.locale}</span></label>
					<LocaleField
						required={true}
						choose_lang={this.trans.choose_lang}
						choose_country={this.trans.choose_country}
						onSelect={this.selectLocale}
					/>
					{this.renderError('locale_id')}

					<div className="submit-container">
						<br/>
						<input type="submit" name="add_domain" value={this.trans.submit} className="button" />
					</div>
					<Image 
						src="img/loader.gif"
						alt="loader"
						scale="1x"
						className="load-spinner"
					/>
                </div>
			</form>
		);
	}
}

module.exports = AddDomain;
