const Modal = require("app/components/modals/main/Modal");
const assign = require("object-assign");
const CompetitorsMath = require("app/components/report/math/CompetitorsMath");

class CompetitorsMathModal extends Modal {
	
	constructor(props) {
		super(props);	
	}

    renderContent() {
        return null;
    }

    renderHeader() { 
		var domainsList = [];
		var domainIndex = 0;

		if (this.state.options) {
			domainsList = this.state.options.domainsList;
			domainIndex = this.state.options.domainIndex;
		}

		return <CompetitorsMath 
					domainIndex={domainIndex}
					domainsList={domainsList}
				/>;
    }
}

module.exports = CompetitorsMathModal;
