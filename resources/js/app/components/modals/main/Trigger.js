const {Component} = require("react");
const PropTypes = require("prop-types");
const renderer = require("app/services/renderer");

class Trigger extends Component {
    static get propTypes() {
        return {
            refId: PropTypes.string.isRequired,
            openToId: PropTypes.string,
        };
    }

    constructor (props) {
        super(props);
    }
    
    get modalState() {
        
    }

    open = (e) => {
        e.preventDefault();
        const el = renderer.element(this.props.refId);
        if (el) {
        	if (this.props.openToId) {
                el.openTo(this.props.openToId);
			} else {
				el.open(this.modalState);
			}
        }
    }
    
    render () {
        return;
    }
}

module.exports = Trigger;
