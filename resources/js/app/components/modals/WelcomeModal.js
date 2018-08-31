const Modal = require("app/components/modals/main/Modal");
const Image = require("app/components/mixins/Image");
const PropTypes = require("prop-types");
const assign = require("object-assign");
const trans = require("app/services/i18n").trans;
const env = require("app/services/env");

class WelcomeModal extends Modal
{

    static get PropTypes() {        
        return assign({}, super.PropTypes, {
            startOpen: PropTypes.bool
        });
    }

    static get defaultProps () {
        return assign({}, super.PropTypes, {
        	startOpen: true
        });
    }

    get trans() {
    	return trans('report.components.welcome');
	}

	get video() {
		let lang = env.get('user.lang');

		if (lang === 'da') {
        	return "https://www.youtube-nocookie.com/embed/cfdsqQzEq64?controls=1&amp;disablekb=1&amp;fs=0&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;iv_load_policy=3&amp;";

		} else {
        	return "https://www.youtube-nocookie.com/embed/gfcxautQgg4?controls=1&amp;disablekb=1&amp;fs=0&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;iv_load_policy=3&amp;";
		}
	}

    renderHeader() {
        return (
            <div>
                <iframe 
                    src={this.video}
                    frameBorder="0"
                    width="100%"
                    height="380px"
                    >
                </iframe>
            </div>
        );
    }

    resizeIframe(e) {
    	let ele = e.target;
    	ele.style.height = ele.contentWindow.document.body.scrollHeight + 'px';
	}

    renderContent() {
        return (
            <div className="welcome-modal">
                <div className="welcome-modal__title">
                    <h1>
                    	{this.trans.title}
                    </h1>
                </div>
                <div className="welcome-modal__content">
                    <p>
                    	{this.trans.p_1} <span>&#x2764;</span>
                    </p>
                    <p>
                    	{this.trans.p_2}
                    </p>
                    <p>
                    	{this.trans.p_3}
                    </p>
                </div>
				<iframe 
					src="https://morningscore.io/roadmap/?hide=1" 
					frameBorder="0"
					scrolling="no"
					width="100%"
					height="10000px"
					/*onLoad={(e) => this.resizeIframe(e)}*/
					>
				</iframe>
            </div>
        );
    }
}

module.exports = WelcomeModal;
