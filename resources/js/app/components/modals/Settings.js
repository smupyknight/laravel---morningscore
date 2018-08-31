const Modal = require("app/components/modals/main/Modal");
const assign = require("object-assign");
const router = require("app/services/router");

// Forms
const Account = require("app/components/forms/settings/Account");
const Company = require("app/components/forms/settings/Company");
const ChangePassword = require("app/components/forms/settings/ChangePassword");
const SystemLang = require("app/components/forms/settings/SystemLang");
const SystemCurrency = require("app/components/forms/settings/SystemCurrency");
const Target = require("app/components/forms/settings/Target");
const Competitors = require("app/components/forms/settings/Competitors");
const trans = require("app/services/i18n").trans;
const env = require("app/services/env");

class Settings extends Modal {
    static get defaultProps() {
        return assign({}, super.defaultProps, {
            sizeClass: "larger"
        });
    }

    get trans() {
    	return trans('report.components.settings');
	}

    renderContent() {
    	let social = env.get('user.social');

        return (
            <div className="modal-text settings-modal">
                { /* TODO - make a separate component */}
                <div className="modal-title-group">
                    <div className="modal-title-group__description">
                        <div className="modal-title">
                        	<p className="version-number">Morningscore Version 1.3</p>
                            <h2><span>{this.trans.title}</span></h2>
							<p>{this.trans.desc}</p>
                        </div>

							<div className="log-out-container">
								<h4>{this.trans.logout_title}</h4>    
								<a href={ router.route('auth.logout') }>
									<p className="button log-out-button">{this.trans.logout_button}</p>
								</a>
							</div>
                    </div>
                    {/* <div className="modal-title-group__profile-info">
                        <div>
                            <h3 className="username">Vestas Vind</h3>
                            <br/>
                            <div className="info">
                                <div className="user-details">
                                    <p>Hans Larson</p>
                                    <p>email@mail.com</p>
                                    <p>Odense C, 5000</p>
                                </div>
                                <div className="user-address">
                                    <p>+45 28 52 94 29</p>
                                    <p>Seebladsgade 8</p>
                                    <p>Denmark</p>
                                </div>
                            </div>
                            <div className="profile-info-footer">
                                <div className="billing-information">
                                    <h5>Longue Passanger</h5>
                                    <p>Next billing date 20. Jan 2018</p>
                                </div>
                                <div className="pricing">
                                    <h1>79<span className="smaller">kr/mo</span></h1>
                                </div>
                            </div>
                        </div>
                    </div> */}
                </div>
                
				{/*<Target id="target-settings-form"/>*/}
                <Company id="company-settings-form"/>
                <Competitors id="competitors-settings-form"/>
                <SystemLang id="lang-settings-form"/>
                <SystemCurrency id="currency-settings-form"/>
                <Account id="account-settings-form"/>
				{ ! social &&
					<ChangePassword id="password-settings-form"/>
				}

            </div>
        );
    }
    
    renderHeader() {
        return;
    }
}

module.exports = Settings;
