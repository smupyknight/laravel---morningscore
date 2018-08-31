const Form = require("app/components/forms/Form");
const csrfToken = require("app/services/csrfToken");
const env = require("app/services/env");
const EnvApi = require("app/api/EnvData");

class Account extends Form {
    performSubmit(form) {
        if (this.beforeSubmit() === false) {
			return;
		}
        return EnvApi.user.run(this.buildPayload(form))
            .then(response => {
                this.onComplete(response);
                return response;
            })
            .catch(error => {
                this.onError(error.response.data);
            });
    }

    get name() {
    	return 'account_settings';
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
                    <div className="fields-group fields-group--inline fields-group--3-col">
                        <div className="field-container">
                            <label htmlFor="first_name">{this.trans.f_name.label}</label>
                            <input type="text" name="first_name" placeholder={this.trans.f_name.placeholder} id="first_name" defaultValue={env.get('user.first_name')}/>

                            {this.renderError('first_name')}
                        </div>
                        <div className="field-container">
                            <label htmlFor="last_name">{this.trans.l_name.label}</label>
                            <input type="text" name="last_name" placeholder={this.trans.l_name.placeholder} id="last_name" defaultValue={env.get('user.last_name')}/>

                            {this.renderError('last_name')}
                        </div>
                        <div className="field-container">
                            <label htmlFor="email">{this.trans.email.label}</label>  
                            <input type="email" name="email" placeholder={this.trans.email.placeholder} id="email" defaultValue={env.get('user.email')}/>

                            {this.renderError('email')}
                        </div>
                    </div>
                    <div className="submit-container">
                        <br/>
                        <input type="submit" name="account_settings_submit" value={this.transMisc.save_settings} className="button" />
                    </div>
                </div>
            </form>
        );
	}
}

module.exports = Account;
