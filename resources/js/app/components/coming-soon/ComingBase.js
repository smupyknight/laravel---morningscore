const {Component} = require("react");
const trans = require("app/services/i18n").trans;

class ComingBase extends Component {
    constructor(props) {
        super(props);
    }

	get trans() {
		return trans('report.components.' + this.name.toLowerCase());
	}

	get transMisc() {
		return trans('report.misc');
	}

	get cs() {
		return this.transMisc.coming_soon;
	}

	get name() {
		return 'coming_base';
	}
}

module.exports = ComingBase;
