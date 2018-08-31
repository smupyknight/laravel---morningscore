const Modal = require("app/components/modals/main/Modal");
const assign = require("object-assign");
const SeoTrafficPotentialMath = require("app/components/report/math/SeoTrafficPotentialMath");

class SeoTrafficPotentialMathModal extends Modal {
	
	constructor(props) {
		super(props);	
	}

    renderContent() {
        return null;
    }

    renderHeader() { 
		return <SeoTrafficPotentialMath />;
    }
}

module.exports = SeoTrafficPotentialMathModal;