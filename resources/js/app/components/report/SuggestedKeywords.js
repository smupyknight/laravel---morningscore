const Component = require("./Base");
const formatNumber = require("../../util/formatNumber");
const formatInteger = require("../../util/formatNumber").integer;
const TableLoading = require("./keyword-table/TableLoading");
const TableHead = require("./keyword-table/TableHead");
const TableTitle = require("./keyword-table/TableTitle");
const EnvData = require("app/api/EnvData");
const env = require("app/services/env");
const router = require("app/services/router");
const renderer = require("app/services/renderer");
const assign = require("object-assign");
const console = require("app/services/logger");
// const socketIOClient = require("socket.io-client");
// const logger = require("app/services/logger");

class SuggestedKeywords extends Component {

	get name() {
		return 'suggested_keywords';
	}

	get sort_collection(){
		return this.state.keywords;
	}

	static get defaultProps() {
		return {
			currency: env.get('user.currency'),
			entryOffset: 0,
			entriesPerPage: 10
		};
	}

    get requiredParams() {
        return {
            domain: "domain.domain",
			tracked_keywords: "domain.tracked_keywords",
            currency: "user.currency",
            gl: "domain.gl",
            hl: "domain.hl"
        };
    }

	get subscriptions() {
		// overwrite default from base, because its not dependent on date range
		return [
			EnvData.keywords.add,
			EnvData.keywords.remove,
            EnvData.currency,
			EnvData.target,
		];
	}

	showNotification(msg, type = 'info') {
		renderer.element('notifications').show(msg, type);
	}

	constructor(props) {
		super(props);

		this.sorts = {
			traffic_value: 'desc'
		};

		// Bind the this context to the handler function
		this.headerClicked = this.headerClicked.bind(this);
	}

    loadData(data) {
        console.log(`%cLoading data into: ${this.name}`, "font-weight:bold; font-size:16px; color:blue", data);
        if (data.error) {
            this.handleError(data.error);
        } else {
        	if (data.keywords && data.keywords.length > 0) {
				this.setState(assign({}, data, {loaded: true, refreshing: false}), () => this.didLoadData());
			} else {
				this.setState({loaded: true, refreshing: false, keywords:undefined}, () => this.didLoadData());
			}
        }
    }

	submitKeyword = (kw, e) => {
		e.preventDefault();

		let el = e.currentTarget.parentNode.parentNode;
		el.classList.add("disabled");

        return EnvData.keywords.add.run({
			domain_id: env.get('domain.id'),
			keywords: kw,
		})
        .then(response => {
			this.showNotification('Keyword was added');
			return response;
		})
		.catch(error => {
			el.classList.remove("disabled");
			this.showNotification(error.response.data.errors.keywords[0], 'error');
		});
	}

	renderTableContent() {

		this.sort();

		let {keywords} = this.state;
		let {currency} = this.state;

		keywords = keywords.slice(this.props.entryOffset, this.props.entriesPerPage);

		return (
			<tbody>
				{keywords.map((keyword) => (
					<tr key={keyword.kw} >
						<td data-col="kw">
							<a onClick={(e) => this.submitKeyword(keyword.kw, e)}>
								<img src={router.url("img/icons/add-keyword.svg")} className="add-kw" alt="Add keyword"/>
								<img src={router.url("img/loader.gif")} alt="loader"/>
							</a>
							<span>{keyword.kw}</span>
						</td>
						<td data-col="sv">
							<span>{(keyword.sv !== null && typeof(keyword.sv) !== 'undefined') ? formatNumber(keyword.sv) : '-'}</span>
						</td>
						<td data-col="position"><span>{formatInteger(keyword.position)}</span></td>
						<td data-col="est_traffic">
							<span>{(keyword.est_traffic !== null && typeof(keyword.est_traffic) !== 'undefined') ? formatNumber(parseFloat(keyword.est_traffic)) : '-'}</span>
						</td>
						<td data-col="traffic_value">
							<span>{(keyword.traffic_value !== null && typeof(keyword.traffic_value) !== 'undefined') ? formatNumber(parseFloat(keyword.traffic_value)) + ' ' + currency : '-'}</span>
						</td>
					</tr>
				))}
			</tbody>
		);
	}

	render() {
		const keywords = this.state.keywords;

		
		if (this.state.keywords && this.state.keywords.length > 0) {
			return (
				<div className={`keywords-box suggestions ${this.state.refreshing ? 'loading' : ''}`}>
					<TableTitle 
						title={this.trans.title} 
						anchorImg={{src: router.url("img/icons/information.svg"), alt: "information icon"}}
						anchorModifier={"anchor-info anchor--align-left"}
						anchorRef={"suggested-keywords-modal"}
						anchorTitle={"suggested keywords modal"}
					/>
					<div className="keywords-box-content-wrapper">
						<table className="keywords-box-content-container">
							<TableHead 
								titles={{
									kw: this.transMisc.columns.keyword,
									sv: this.transMisc.columns.searches,
									position: this.transMisc.columns.rank,
									est_traffic: this.transMisc.columns.visits,
									traffic_value: this.transMisc.columns.score,
								}} 
								// arrowsPosition={3} 
								headerClicked={this.headerClicked}
								sortDirection={this.sorts}
							/>
							{(keywords && keywords.length > 0) 
								? this.renderTableContent()
								: <TableLoading rows={3} cols={4}/>}
						</table>
					</div>
				</div>
			);
		}

		return <div></div>;

		
	}
}

module.exports = SuggestedKeywords;
