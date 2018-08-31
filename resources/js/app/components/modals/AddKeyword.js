const Modal = require("app/components/modals/main/Modal");
const assign = require("object-assign");
const Form = require("app/components/forms/AddKeyword");
const Image = require("app/components/mixins/Image.js");
const trans = require("app/services/i18n").trans;
const router = require("app/services/router");

class AddKeyword extends Modal {
    static get defaultProps() {
        return assign({}, super.defaultProps, {
            sizeClass: "smallest"
        });
    }

    get trans() {
    	return trans('report.components.add_kw');
	}

    renderContent() {

        return (
            <div className="modal-text">
                <div className="modal-title-group">
                    <div className="modal-title-group__description">
                        <div className="modal-title">
                            <h2><span>{this.trans.title}</span></h2>
                            <p>{this.trans.desc}</p>
                        </div>
                    </div>
                </div>
                <Form
                    onComplete={() => this.close() }
                />
                <Image 
                    src={router.url("img/loader.gif")}
                    alt="loader"
                    scale="1x"
                    className="load-spinner"
                />
            </div>
        );
    }
    
    renderHeader() {
        return;
    }
}

module.exports = AddKeyword;
