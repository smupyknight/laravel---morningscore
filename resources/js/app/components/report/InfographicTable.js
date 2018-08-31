const {Component} = require("react");
const PropTypes = require("prop-types");
const router = require("app/services/router");
const trans = require("app/services/i18n").trans;

class InfographicTable extends Component {
	static get propTypes() {
	    return {
	        name: PropTypes.string.isRequired,
	    };
	}

	renderRow = (item, index) => {
		return (
			<div key={index} className="infographics-row">
                <div className="infographics-row__item">
                    <img src={router.url(item.img)} alt={item.title} />
                </div>

                <div className="infographics-row__item">
                	<h3>{item.title}</h3>
                	<p>{item.content}</p>
                </div>
            </div>
		);
	}

	render() {
		let content = trans('report.infographics.' + this.props.name);

		return (
			<div className="infographics-body">
				{content && content.length > 0 ? content.map(this.renderRow) : null}
			</div>
		);
	}
}

module.exports = InfographicTable;