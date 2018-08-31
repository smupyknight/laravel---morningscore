const Form = require("app/components/forms/Form");
const csrfToken = require("app/services/csrfToken");
const env = require("app/services/env");
const EnvApi = require("app/api/EnvData");

class Company extends Form {
    performSubmit(form) {
        if (this.beforeSubmit() === false) {
			return;
		}
        return EnvApi.company.run(this.buildPayload(form))
            .then(response => {
                this.onComplete(response);
                return response;
            })
            .catch(error => {
                this.onError(error.response.data);
            });
    }

    get name() {
    	return 'company_settings';
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
                            <label htmlFor="name">{this.trans.comp_name.label}</label>  
                            <input type="text" name="name" placeholder={this.trans.comp_name.placeholder} id="name" defaultValue={env.get('company.name')}/>
                            
                            {this.renderError('name')}
                        </div>
                        <div className="field-container">
                            <label htmlFor="country">{this.trans.country.label}</label>  
                            <input type="text" name="country" placeholder={this.trans.country.placeholder} id="country" defaultValue={env.get('company.country')}/>

                            {this.renderError('country')}
                        </div>
                        <div className="field-container">
                            <label htmlFor="city">{this.trans.city.label}</label>  
                            <input type="text" name="city" placeholder={this.trans.city.placeholder} id="city" defaultValue={env.get('company.city')}/>

                            {this.renderError('city')}
                        </div>
                        <div className="field-container">
                            <label htmlFor="zipcode">{this.trans.zip_code.label}</label>  
                            <input type="text" name="zipcode" placeholder={this.trans.zip_code.placeholder} id="zipcode" defaultValue={env.get('company.zipcode')}/>

                            {this.renderError('zipcode')}
                        </div>
                        <div className="field-container">
                            <label htmlFor="address">{this.trans.address.label}</label>  
                            <input type="text" name="address" placeholder={this.trans.address.placeholder} id="address" defaultValue={env.get('company.address')}/>

                            {this.renderError('address')}
                        </div>
                        <div className="field-container">
                            <label htmlFor="phone">{this.trans.phone.label}</label>  
                            <input type="text" name="phone" placeholder={this.trans.phone.placeholder} id="phone" defaultValue={env.get('company.phone')}/>

                            {this.renderError('phone')}
                        </div>
                        <div className="field-container">
                            <label htmlFor="website">{this.trans.website.label}</label>  
                            <input type="text" name="website" placeholder={this.trans.website.placeholder} id="website" defaultValue={env.get('company.website')}/>

                            {this.renderError('website')}
                        </div>
                    </div>
                    <div className="submit-container">
                        <br/>
                        <input type="submit" name="company_settings_submit" value={this.transMisc.save_settings} className="button" />
                    </div>
                </div>
            </form>
        );
	}
}

module.exports = Company;
