const Modal = require("app/components/modals/main/Modal");
const PropTypes = require("prop-types");
const assign = require("object-assign");
const Math = require("app/components/report/math/MorningscoreMath");

class MorningscoreMathModal extends Modal {


    constructor(props) {
        super(props);
    }

    renderContent() {
        return null
    }

    renderHeader() { // Rendering everything in here in order to make it full width
        return <Math/>
    }
}

module.exports = MorningscoreMathModal;
