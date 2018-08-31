const Modal = require("app/components/modals/main/Modal");
const assign = require("object-assign");
const Form = require("app/components/forms/RemoveKeyword");
const trans = require("app/services/i18n").trans;

class RemoveKeyword extends Modal {
    static get defaultProps() {
        return assign({}, super.defaultProps, {
            sizeClass: "smallest"
        });
    }

    get trans() {
    	return trans('report.components.remove_kw');
	}

	get className() {
		let classList = [super.className, "remove-keyword-modal"];
		return classList.join(' ');
	}

    renderContent() {
        let keyword = this.getOptions('keyword');
        
        if (keyword === null) {
            return; // TODO - Error
		}
		
		
        
        return (
            <div className="modal-text">
                <div className="modal-title">{this.trans.title}</div>
                <p>{this.trans.desc_1} "{keyword}" {this.trans.desc_2}</p>
                <Form
                    onComplete={() => this.close()}
                    onCancel={() => this.close()}
                    keyword={keyword}
                />
            </div>
        );
    }
    
    renderHeader() {
        return;
    }
}

module.exports = RemoveKeyword;
