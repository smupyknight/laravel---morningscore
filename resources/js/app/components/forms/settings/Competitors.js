const Form = require("app/components/forms/Form");
const csrfToken = require("app/services/csrfToken");
const EnvApi = require("app/api/EnvData");
const env = require("app/services/env");
const DomainField = require("app/components/forms/fields/DomainField");

class Competitors extends Form {
    performSubmit(form) {
        if (this.beforeSubmit() === false) {
            return;
        }
        return EnvApi.competitors.run(this.buildPayload(form))
            .then(response => {
                this.onComplete(response);
                return response;
            })
            .catch(error => {
                this.onError(error.response.data);
            });
    }

    get name() {
        return 'competitor_settings';
    }
    
    get successMessage() {
        return this.trans.success_msg;
    }
    
    get fields() {
        let
            competitors = env.get('domain.competitors.domains'),
            fields = Array(3).fill('');
        
        if (competitors.length === 3) {
            return competitors;
        }

        return competitors.concat(fields).slice(0, 3);
    }

    renderHeader() {
        return (
            <div className="modal-title">
                <span>{this.trans.title}</span>
            </div>
        );
    }
    
    renderField = (value, key) => {
    	let name = `domains.${key}`;

        return (
            <div key={key} className="field-container">
                <label htmlFor="domain">{this.trans.label} {key+1}</label>
                <DomainField
                	type="text"
                	name={`domains[${key}]`}
                	placeholder={this.trans.placeholder}
                	default={value}
                />
				{this.renderError(name)}
            </div>
        );
    }
    
    renderForm() {
        return (
            <form onSubmit={this.onSubmit}>
                <input type="hidden" name="_token" value={csrfToken()}/>
                <div className="form-group">
                    {this.renderMessage()}
                    <div className="fields-group fields-group--inline fields-group--3-col">
                        {this.fields.map(this.renderField)}
                    </div>
                    
                </div>
                <div className="submit-container">
                    <input type="submit" name="website_settings_submit" value={this.transMisc.save_settings} className="button" />
                </div>
			</form>
		);
	}
}

module.exports = Competitors;
