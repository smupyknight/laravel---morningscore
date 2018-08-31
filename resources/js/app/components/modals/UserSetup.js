const Modal = require("app/components/modals/main/Modal");
const Form = require("app/components/forms/UserSetup");
const Image = require("app/components/mixins/Image");

class UserSettings extends Modal {
    renderContent() {
        return (
            <div className="modal-text">
                <div className="modal-title">Welcome</div>
                <p>You are almost there! We just need to know a few more things.</p>
                <Form onComplete={() => this.close()}/>
                <a href="#" className="help-link">What is this?</a>
            </div>
        );
    }
    
    renderHeader() {
        return (
            <div className="modal-header">
                <div className="logo-container">
                    <Image 
                        src="img/logo/logo.svg"
                        alt="morningscore logo"
                        scale="1x"
                    />
                </div>
                <div className="header-image object-fit">
                    <Image 
                        src="img/testing/cover.jpg"
                        alt="happy people"
                        scale="1x"
                    />
                </div>
                <svg id="modal-curves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 900 240.23">
                    <path id="curve1" d="M0,151s82,37,186,37,172-12,293-89S714-37,900,27V240H0Z" transform="translate(0 0)"/>
                    <path id="curve0" d="M0,198s67,16,165,16,192-22,277-66S733,9,900,52V240H0Z" transform="translate(0 0)"/>
                </svg>
            </div>
        );
    }
}

module.exports = UserSettings;
