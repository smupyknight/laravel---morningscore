const {decodeHtmlEntity} = require("app/util/htmlEntities");
const PropTypes = require("prop-types");

function Icon(props) {
	return (
		<i className="material-icons">{decodeHtmlEntity(props.type)}</i>
	);
}

Icon.propTypes = {
	type: PropTypes.string.isRequired
};

module.exports = Icon;