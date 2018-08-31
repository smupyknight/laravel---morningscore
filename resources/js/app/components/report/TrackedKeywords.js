const Component = require("./Base");
const PropTypes = require("prop-types");
const TableLoading = require("./keyword-table/TableLoading");
const TableHead = require("./keyword-table/TableHead");
const TableTitle = require("./keyword-table/TableTitle");
const Anchor = require("app/components/modals/triggers/Anchor");
const EnvData = require("app/api/EnvData");
const formatNumber = require("../../util/formatNumber");
const formatInteger = require("../../util/formatNumber").integer;
const Paginator = require("app/util/Paginator");
const array = require("app/util/array");
const assign = require('object-assign');
const router = require("app/services/router");
// const socketIOClient = require("socket.io-client");

const logger = require("app/services/logger");

class TrackedKeywords extends Component {

    constructor(props) {
		super(props);
		
		this.state = assign({}, this.state, {
			page: 1
		});

        this.sorts = {
            traffic_value: 'asc'
		};
		
		this.sort();

        // Bind the this context to the handler function
        this.headerClicked = this.headerClicked.bind(this);
    }

	get name() {
		return 'tracked_keywords';
	}

    get sort_collection(){
        return this.state.keywords;
    }

    get requiredParams() {
        return assign({}, super.requiredParams, {
			tracked_keywords: "domain.tracked_keywords",
        });
    }

	get subscriptions() {
		return super.subscriptions.concat([
			EnvData.keywords.add,
			EnvData.keywords.remove,
		]);
	}

	handleError(error) {
		this.setState({keywords:undefined, refreshing: false})
	}

	getDiff(prev, curr, prcnt = false) {
		if (prev === 0 || prev === curr) {
			return null;
		}

		if (prcnt) {
			let diff = ((curr - prev) / prev) * 100;
			return Math.round(diff * 100) / 100;
		}

		return diff = prev - curr;
	}

	getFormat(num, prcnt = false) {
		if (num === null) {
			return null;
		}

		let val = num > 0 ? `+${num}` : num;
		return prcnt ? `${val}%` : val;
	}

	getRankFormat(num, prcnt = false) {
		if (num === null) {
			return null;
		}

		let val = num > 0 ? '\u25b2' + num : '\u25bc' + Math.abs(num);
		return prcnt ? `${val}%` : val;
	}

	getStatus(num) {
		if (num === null) {
			return null;
		}

		return num > 0 ? 'increasing' : 'decreasing';
	}

	renderRank (diff, entry) {
		if (diff && diff !== null) {
			return (
				<div>
					<span>
						{formatInteger(entry.position)}
					</span>
					<span className="entry-diff">
						{this.getRankFormat(diff)}
					</span>
				</div>
			);
		}
		
		return (
			<span>
				{formatInteger(entry.position)}
			</span>
		);
	}

	renderTableMorningscore(entry, currency, score_diff) {
		if (score_diff && score_diff !== null) {
			return (
				<div>
					<div className="traffic-value">
						<span>{formatNumber(entry.traffic_value)}</span> <span className="currency">{currency}</span>
					</div>	
					<div className="score-difference">
						<span>{this.getFormat(score_diff, true)}</span>
					</div>
					<div className="status-icon">
						<div></div>
						<div></div>
						<div></div>
					</div>
				</div>
			);
		}
		else {
			return (
				<div>
					<div className="traffic-value">
						<span>{formatNumber(entry.traffic_value)}</span> <span className="currency">{currency}</span>
					</div>	
				</div>
			);
		}
	}

	// renderCrawlingLoader() {
	// 	return (
	// 		<div className="keyword-crawling__loader">
	// 			<div className="keyword-crawling__loader__tooltip">
	// 				<div className="keyword-crawling__loader__tooltip__percentage">70<span>%</span></div>
	// 				<div className="keyword-crawling__loader__tooltip__time-left">Expect <span>2 days</span></div>
	// 			</div>
	// 			<div className="keyword-crawling__loader__amount-loaded">
	// 				<div className="keyword-crawling__loader__amount-loaded__arrows">
	// 					<div></div>
	// 					<div></div>
	// 					<div></div>
	// 				</div>
	// 			</div>
	// 		</div>
	// 	);
	// }

	didLoadData () {
		if (this.pages[this.state.page - 1] == undefined) {
			this.paginator.prevPage();
		}
	}

	renderTableContent = (entries) => {
		if (entries === undefined) {
			return null
		}

		let {currency} = this.state;
		

		return (
			<tbody>	
			{entries.map((entry, index) => {

				let rank_diff = this.getDiff(entry.prevPosition, entry.position),
					score_diff = this.getDiff(entry.prevTrafficValue, entry.traffic_value, true),
					kw_status = this.getStatus(score_diff),
					rank_status = this.getStatus(rank_diff);
				
				let keywordCrawling = 
						entry.cpc == 0 && entry.est_traffic == 0 
						&& entry.position == 0 && entry.sv == 0 
						&& entry.traffic_value == 0 
						? "keyword-crawling" : "";
				

				return (
					<tr key={entry.kw} className={`${kw_status} ${keywordCrawling}`}>
						<td>
							<Anchor
								title={`remove "${entry.kw}" keyword`}
								content=""
								refId="remove-keyword-modal"
								data={{keyword: entry.kw}}
							/>
							{
								keywordCrawling 
								? <span><span className="keyword-crawling__tag">SCANNING</span> {entry.kw}</span>
								: <span>{entry.kw}</span>
							}
							{
								// keywordCrawling
								// ? this.renderCrawlingLoader()
								// : ""
							}
						</td>
						<td><span>{formatNumber(entry.sv)}</span></td>
						<td className={rank_status}>
							{ this.renderRank(rank_diff, entry) } 
						</td>
						<td><span>{formatNumber(entry.est_traffic)}</span></td>
						<td>
							{ this.renderTableMorningscore(entry, currency, score_diff) }
						</td>
					</tr>
				);
			})}
			</tbody>
		);
	}

	render() {

		
		if (this.state.keywords) {
			this.pages = array.chunk(this.state.keywords, 10);
		}
		else {
			this.pages = [];
		}

		return (
            <div className={`keywords-box keyword-tracker ${this.state.refreshing ? 'loading' : ''}`}>
				<TableTitle 
					title={this.trans.title} 
					button={this.trans.add_keyword}
					anchorImg={{src: router.url("img/icons/information.svg"), alt: "information icon"}}
					anchorModifier={"anchor-info anchor--align-left"}
					anchorRef={"tracked-keywords-modal"}
					anchorTitle={"Tracked keywords modal"}
				/>
				<div className={`keywords-box-content-wrapper ${this.pages.length < 1 ? "" : "keywords-box-content-wrapper--min-height"}`}>
					<table className="keywords-box-content-container">
						<TableHead 
							titles={{
								kw: this.transMisc.columns.keyword,
								sv: this.transMisc.columns.searches,
								position: this.transMisc.columns.rank,
								est_traffic: this.transMisc.columns.traffic,
								traffic_value: 'Morningscore'
							}} 
							// arrowsPosition={3}
							sortDirection={this.sorts}
							headerClicked={this.headerClicked}
						/>
						{this.pages.length > 0 ? this.renderTableContent(this.pages[this.state.page - 1]) : <TableLoading rows={3} cols={5}/>}
					</table>
				</div>
				<div>
					<Paginator 
						pageHandler={this.updatePage.bind(this)}
						nPages={this.pages.length}
						ref={e => this.paginator = e}
						hidden={this.pages.length < 2 ? true : false}
					/>
				</div>
			</div>
		);
	}

	updatePage (page) {
        this.setState({ page: page});
    }
}

module.exports = TrackedKeywords;
