const Form = require("app/components/forms/Form");
const csrfToken = require("app/services/csrfToken");
const env = require("app/services/env");
const EnvApi = require("app/api/EnvData");

class AddKeyword extends Form {
	get name() {
		return 'add_kw';
	}

    performSubmit(form) {
        if (this.beforeSubmit() === false) {
			return;
		}
        return EnvApi.keywords.add.run(this.buildPayload(form))
            .then(response => {
                this.onComplete(response);
                return response;
            })
            .catch(error => {
                this.onError(error.response.data);
            });
    }

    renderForm() {
		return (
            
            <form onSubmit={this.onSubmit}>
                <div className="from-group">
                    <input type="hidden" name="_token" value={csrfToken()}/>
                    <input type="hidden" name="domain_id" value={env.get('domain.id')}/>
                    <div className="field-container">
                        <label><span className="highlight">{this.trans.placeholder}</span></label>
                        <textarea name="keywords" placeholder={this.trans.placeholder} required={true}></textarea>
                        {this.renderError("keywords")}
                    </div>
                    <div className="submit-container">
                        <br/>
                        <input type="submit" name="add_keyword" value={this.trans.submit} className="button" />
                    </div>
                </div>
			</form>
		);
	}
}

module.exports = AddKeyword;
