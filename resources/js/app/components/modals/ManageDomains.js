const Modal = require("app/components/modals/main/Modal");
const assign = require("object-assign");
const EnvData = require("app/api/EnvData");
const AddDomain = require("app/components/forms/AddDomain");
const RemoveDomain = require("app/components/forms/RemoveDomain");
const env = require("app/services/env");
const trans = require("app/services/i18n").trans;

class ManageDomains extends Modal {
	static get defaultProps() {
	    return assign({}, super.defaultProps, {
	        sizeClass: "smallest"
	    });
	}

    constructor(props) {
    	super(props);

    	this.state = {
			domains: env.get('domains'),
		};
	}

    get trans() {
    	return trans('report.components.add_domain');
	}

	componentDidMount() {
		EnvData.domains.add.onChange(this.refresh);
		EnvData.domains.remove.onChange(this.refresh);
	}

	refresh = () => {
		this.setState({
			domains: env.get('domains'),
		});
	}

    renderContent() {
    	let {domains} = this.state;

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
                <AddDomain />

	            <div className="modal-title-group">
	                <div className="modal-title-group__description">
	                    <div className="modal-title">
	                        <h2><span>{this.trans.manage}</span></h2>
	                        <p>{this.trans.manage_desc}</p>
	                    </div>
	                </div>
	            </div>
				{domains.map((domain, index) => (
					<RemoveDomain
						key={index}
						domain_id={domain.id}
						domain={domain.domain}
						locale_id={domain.locales[0]}
					/>
				))}
            </div>
        );
    }
    
    renderHeader() {
        return;
    }
}

module.exports = ManageDomains;
