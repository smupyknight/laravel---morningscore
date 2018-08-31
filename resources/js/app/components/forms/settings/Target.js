const Form = require("app/components/forms/Form");
const csrfToken = require("app/services/csrfToken");
const EnvApi = require("app/api/EnvData");
const DomainField = require("app/components/forms/fields/DomainField");
const env = require("app/services/env");

class Target extends Form {
    performSubmit(form) {
        if (this.beforeSubmit() === false) {
            return;
        }
        return EnvApi.target.run(this.buildPayload(form))
            .then(response => {
                this.onComplete(response);
                return response;
            })
            .catch(error => {
                this.onError(error.response.data);
            });
    }
    
    get name() {
        return 'target_settings';
    }
    
    get successMessage() {
        return this.trans.success_msg;
    }

    renderHeader() {
        return (
            <div className="modal-title">
                <span>{this.trans.title}</span>
            </div>
        );
    }

    renderForm() {
		return (
            <form onSubmit={this.onSubmit}>
                <input type="hidden" name="_token" value={csrfToken()}/>
                <div className="form-group">
                    {this.renderMessage()}
                    <div className="fields-group fields-group--inline fields-group--3-col fields-group--3-col--has-button">
                        <div className="field-container">
                            <label htmlFor="domain">{this.trans.website.label}</label>
							<DomainField
								type="text"
								name="domain"
								placeholder={this.trans.website.placeholder}
								default={env.get('domain.domain')}
							/>

                            {this.renderError('domain')}
                        </div>
                        <div className="field-container">
                            <label htmlFor="country">{this.trans.country.label}</label>
                            <select name="country">
                                <option value="List of available countries">Denmark</option>
                            </select>
                            
                            {this.renderError('country')}
                        </div>
                        <div className="submit-container field-container submit-container--bigger">
                            <input type="submit" name="target_submit" value={this.transMisc.save} className="button" />
                        </div>
                    </div>
                </div>
			</form>
		);
	}
}

module.exports = Target;
