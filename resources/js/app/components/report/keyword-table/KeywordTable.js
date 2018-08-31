const Component = require("../Base");
const PropTypes = require("prop-types");

class KeywordTable extends Component {
    static get propTypes() {
		return {
            title: PropTypes.string
		};
    }

    static get defaultProps() {
		return {
            title: 'Title here'
		};
    }

    render() {
        return (
            <div></div>
        );
    }
}

module.exports = KeywordTable;