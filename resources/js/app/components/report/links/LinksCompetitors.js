const Component = require("app/components/report/Base");
const PropTypes = require("prop-types");
const assign = require("object-assign");
const EnvData = require("app/api/EnvData");
const Anchor = require("app/components/modals/triggers/Anchor");
const router = require("app/services/router");
const formatNumber = require("app/util/formatNumber");

class LinksCompetitors extends Component {

	get name() {
		return 'refdomains_competitors';
	}

    get requiredParams() {
    	return assign({}, super.requiredParams, {
			competitors: 'domain.competitors.domains'
    	});
	}

	get subscriptions() {
        return [
            EnvData.period,
            EnvData.target,
			EnvData.competitors,
        ];
	}

	handleError(error) {
		this.setState({refdomains_competitors:undefined, refreshing: false})
	}

	get rowNames() {
		return [
			{
				title: '', // this.trans.domains,
				value: 'domain',
			},
			{
				title: this.trans.links,
				refId: 'website-links-modal',
				value: 'value',
			},
			{
				title: this.trans.strength,
				refId: 'link-strength-modal',
				value: 'rank',
			},
		]
	}

	renderRowNames(key) {
		let row = this.rowNames[key];

		return (
			<td>
				{row.title}
				{row.refId ?
					<Anchor
						title={row.title}
						img={{src: router.url("img/icons/information.svg"), alt: "information icon", class: "asd"}}
						refId={row.refId}
						className="anchor anchor-info anchor--align-left"
					/>
					: null}
			</td>
		);
	}

	renderChange(change) {
		if (change > 0) {
			return (
				<p className="change change--positive">+{change}</p>
			)
		}
		else if (change < 0) {
			return (
				<p className="change change--negative">{change}</p>
			)
		}	

		return "";
	}

	renderRow = (row, rowKey) => {
		let data	= this.state[this.name];
		let val		= this.rowNames[rowKey].value;
		let isVal	= val === 'value';
		let isRank 	= val === 'rank';
		let rows	= [];

		for (i=0; i<4; i++) {
			rows.push(
				data[i] ? (
					<td key={i} className={isVal ? 'values' : null}>
							<p className={isVal ? 'value' : null}>
								{ isRank ? formatNumber(data[i][val]) : data[i][val] }
							</p>
							{isVal ? this.renderChange(data[i].change) : null}
					</td>
				) 
				: (
					<td key={i}>
						<div className="blank"></div>
					</td>
				)
			);
		}

		return (
			<tr key={rowKey}>
				{this.renderRowNames(rowKey)}
				{rows}
			</tr>
		);
	}

    render() {
		if ((! this.state[this.name]) || (! this.state[this.name].length > 0)) {
			return null;
			return this.renderFallback();
		}

		let rows = this.rowNames;

        return (
			<div className={`links-competitors ${this.state.refreshing ? 'loading' : ''}`}>
				<div className="links-competitors__wrapper">
					<div className="links-competitors__title">
						<h5>{this.trans.title}</h5>
						<Anchor
							title=""
							img={{src: router.url("img/icons/information.svg"), alt: "information icon", class: "asd"}}
							refId="competitor-links-modal"
							className="anchor anchor-info anchor--align-left"
						/>
					</div>
					<div className="links-competitors__table">
						<table>
							<tbody>
								{rows.map(this.renderRow)}
							</tbody>
						</table>
					</div>
				</div>
			</div>
        );
    }
}

module.exports = LinksCompetitors;
