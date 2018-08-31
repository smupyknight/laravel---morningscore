const Form = require("app/components/forms/Form");
const csrfToken = require("app/services/csrfToken");
const router = require("app/services/router");
const env = require("app/services/env");

class ChangePassword extends Form {
    get actionUrl() {
        return router.route("api.portal.user.update", {user_id: env.get('user.id')});
    }

    get name() {
    	return 'password_settings';
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
                    <div className="fields-group fields-group--inline fields-group--4-col">
                        <div className="field-container">
                            <label htmlFor="current_password">{this.trans.old_pass.label}</label>  
                            <input type="password" name="current_password" placeholder={this.trans.old_pass.placeholder} id="current_password"/>
                        </div>
                        <div className="field-container">
                            <label htmlFor="password">{this.trans.new_pass.label}</label>  
                            <input type="password" name="password" placeholder={this.trans.new_pass.placeholder} id="password"/>
                        </div>
                        <div className="field-container">
                            <label htmlFor="password_confirmation">{this.trans.confirm_pass.label}</label>  
                            <input type="password" name="password_confirmation" placeholder={this.trans.confirm_pass.placeholder} id="password_confirmation"/>
                        </div>
                        <div className="submit-container field-container submit-container--bigger">
                            <input type="submit" name="change_password_submit" value={this.transMisc.save} className="button" />
                        </div>

                        {this.renderError('current_password')}
                        {this.renderError('password')}
                        {this.renderError('password_confirmation')}
                    </div>
                </div>
			</form>
		);
	}
}

module.exports = ChangePassword;
