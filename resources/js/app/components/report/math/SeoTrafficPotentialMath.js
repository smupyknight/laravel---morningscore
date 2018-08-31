const Component = require("app/components/report/Base");
const Image = require("app/components/mixins/Image");
const Paginator = require("app/util/Paginator");
const array = require("app/util/array");
const assign = require('object-assign');
const env = require("app/services/env");
const TableLoading = require("../keyword-table/TableLoading");
const TableHead = require("../keyword-table/TableHead");
const TableTitle = require("../keyword-table/TableTitle");
const formatNumber = require("app/util/formatNumber");
const formatInteger = require("app/util/formatNumber").integer;
const PropTypes = require("prop-types");
const router = require("app/services/router");
const sortComps = require("app/util/sortCompetitors");

class SeoTrafficPotentialMath extends Component {

	/*
	 * Init
	 */

    constructor(props) {
        super(props);

        this.state = {
			page: 1,
			activeDomain: "",
            filterRange: [],
			filterActive: false,
			filteredEntries: []
        };

        this.sorts = {
            traffic_value: 'desc'
		};

		this.sort();
		
        // Bind the this context to the handler function
        this.headerClicked = this.headerClicked.bind(this);
	}


    /*
     * Getters
     */

    get name() {
        return 'seo_potential_math';
    }

	get modifyData() {
		return (data) => {
			let domains = Object.keys(data);

			return {
				entries: data,
				activeDomain: env.get("domain.domain")
			};
		}
	}

    get sort_collection() {
		if (this.state.activeDomain !== "") {
			return this.state.entries[this.state.activeDomain].data;
		}
	}

    get requiredParams() {
        return assign({}, super.requiredParams, {
			competitors: "domain.competitors.domains",
        });
	}

	get ranges() {
		return [
			[],
			[1, 10],
			[11, 20],
		];
	}


	/*
	 * Methods
	 */

	changeTab = (domain) => {
		if (domain !== this.state.activeDomain ) {
			this.setState({
				activeDomain: domain,
				filterRange: [],
				filteredEntries: []
			});
		}
	}

	filterRank = (range) => {

		if (Array.isArray(range) && range.length === 2) {

			var filteredEntries = this.state.entries[this.state.activeDomain].data.filter(
				entry => range[0] <= entry.position && entry.position <= range[1]
			)
			
			if (filteredEntries.length > 0 && Math.ceil(filteredEntries.length / 8) < this.state.page) {
				this.setState({
						page: Math.ceil(filteredEntries.length / 8),
						filteredEntries: filteredEntries,
						filterRange: range
					},
					this.paginator.setState({
						p: Math.ceil(filteredEntries.length / 8)
					})
				);
			}
			else {
				this.setState({
					filteredEntries: filteredEntries,
					filterRange: range
				})
			}

			return;
		}
		else {
			this.setState({
				filteredEntries: [],
				filterRange: []
			})
		}
    }

    toggleFilterClass = () => {
        this.setState((prevState) => ({
            filterActive: !prevState.filterActive
        }));
    }

    updatePage(page) {
        this.setState({page: page});
    }


	/*
	 * Renders
	 */

	renderTabs() {
		return(
			<div className="competitors-tabs">
				{Object.keys(this.state.entries).sort(sortComps).map((domain, key) => {
					return (
						<div
							key={key}
							onClick={() => this.changeTab(domain)} 
							className={ `competitors-tabs__tab  ${this.state.activeDomain == domain ? "competitors-tabs__tab--active" : ""}`}
						>
							{domain}
						</div>
					);
				})}
			</div>
		);
	}

	renderRankFilters() {
		return (
			<div className="filter-dropdown" onClick={this.toggleFilterClass}>
				<div className="filter-dropdown__title">
					{this.state.filterRange.length == 0 ? this.transMisc.ranks.all_ranks : this.transMisc.ranks.ranks + ' ' + this.state.filterRange[0] + ' - ' + this.state.filterRange[1]}
				</div>
				<div className={`filter-dropdown__content ${this.state.filterActive ? 'filter-dropdown__content--active' : ''}`}>
					{
						this.ranges.map((val, key) => {
							return (
								<div className="filter-dropdown__option" onClick={() => this.filterRank(val)} key={key}>
									{val.length == 0 ? "All" : val[0] + " - " + val[1]}
								</div>
							)
						})
					}
                </div>
			</div>
		);
	}
	
	renderRankDiff(currect, prev) {
		let diff = currect - prev;
		if (diff === 0) return;


		let classList = 'entry-diff';
		if (diff < 0) classList = classList + ' entry-diff--positive';
		else classList = classList + ' entry-diff--negative';

		return (
			<span className={classList}>
				{diff < 0 ? '\u25b2' + Math.abs(diff) : '\u25bc' + diff}
			</span>
		);
	}
	
	renderShareDiff(currect, prev) {
		let diff = currect - prev;
		if (diff === 0) return;


		let classList = 'entry-diff';
		if (diff > 0) classList = classList + ' entry-diff--positive';
		else classList = classList + ' entry-diff--negative';

		return (
			<span className={classList}>
				{diff > 0 ? '+' + diff : '-' + Math.abs(diff)}
			</span>
		);
	}

    renderTable(entries) {
        return (
            <table className="seo-traffic-potential-table">
				<TableHead 
					titles={{
						kw: this.transMisc.columns.keyword,
						sv: this.transMisc.columns.searches,
						position: this.transMisc.columns.rank,
						traffic_share: this.trans.traffic_val,
						traffic_potential: this.trans.traffic_pot,
					}}
					sortDirection={this.sorts}
					headerClicked={this.headerClicked}
				/>
                <tbody>
                {entries.map((entry, index) => (
                    <tr key={index}>
						<td title={entry.kw}>
							<abbr title={entry.kw}>
								{entry.kw}
							</abbr>
						</td>
                        <td>{formatNumber(entry.sv)}</td>
						<td>
							<span>{formatInteger(entry.position)}</span>
							{this.renderRankDiff(
								formatInteger(entry.position),
								formatInteger(entry.prev_position)
							)}
						</td>
						<td>
							<span>{formatInteger(entry.traffic_share, 0, 0)}</span>
							{this.renderShareDiff(
								formatInteger(entry.traffic_share, 0, 0),
								formatInteger(entry.prev_traffic_share, 0, 0)
							)}
						</td>
                        <td>{formatNumber(entry.traffic_potential, 0, 0)}</td>
                    </tr>
                ))}
                </tbody>
            </table>
        );
	}
	
    renderContent() {

		if (this.state.filterRange.length > 0) {
			if (this.state.filteredEntries.length > 0) {
				console.log("DEBUG", this.state.filteredEntries);
				var pages = array.chunk(this.state.filteredEntries, 8);
			}
			else {
				var pages = [];
			}
		}
		else {
			if (this.state.entries[this.state.activeDomain].data.length > 0) {
				var pages = array.chunk(this.state.entries[this.state.activeDomain].data, 8);
			}
			else {
				var pages = [];
			}
		}

		

        return (
            <div className={`calculations-modal ${this.state.refreshing ? "loading" : ""}`}>
                <div className="modal-title-group">
                    <div className="modal-title-group__description">
                        <div className="modal-title">
                            <h2>
                                <span>{this.trans.title} {this.state.activeDomain}</span>
                                {
                                    this.state.refreshing 
                                        ? <img src={router.url("img/loader.gif")} alt="loader" className="loader"/>
                                        : null
                                }
                            </h2>
                            <p className="tagline">{this.trans.we_found_part_1} {this.state.entries[this.state.activeDomain].data.length} {this.trans.we_found_part_2} {this.state.activeDomain}</p>
                            <div className="filter-wrap">
                                {this.renderTabs()}
                                {this.renderRankFilters()}
                            </div>
                        </div>
                    </div>
                </div>
                <div className="modal-text">
                    <div className="words-table-wrapper">
						<div className="words-table">
                            {
                                pages.length > 0 ? this.renderTable(pages[this.state.page - 1]) : null
                            }
                        </div>
					</div>
						{
							pages.length > 1 
								? <Paginator
									pageHandler={this.updatePage.bind(this)}
									nPages={pages.length}
									ref={e => this.paginator = e}
								/>
								: null
						}
                </div>
            </div>
        );
    }

    renderLoadTableRows() {
        let rows = [];
        for (let i = 0; i < 7; i++) {
            rows.push(<tr className="loading" key={i}>
                <td>
                    <div className="loading-data"></div>
                </td>
                <td>
                    <div className="loading-data"></div>
                </td>
                <td>
                    <div className="loading-data"></div>
                </td>
                <td>
                    <div className="loading-data"></div>
                </td>
                <td>
                    <div className="loading-data"></div>
                </td>
                <td>
                    <div className="loading-data"></div>
                </td>
            </tr>);
        }
        return rows;
    }

    renderLoadContent() {

        return (
            <div className="calculations-modal loading">
                <div className="modal-title-group">
                    <div className="modal-title-group__description">
                        <div className="modal-title">
                            <h2><span>{this.trans.title}</span></h2>
                            <img src={router.url("img/loader.gif")} alt="loader" className="loader"/>
                        </div>
                    </div>
                </div>
                <div className="modal-text">
                    <div className="words-table-wrapper">
                        <div className="words-table">
                            <table>
                                <TableHead titles={{
									kw: this.transMisc.columns.keyword,
									sv: this.transMisc.columns.searches,
									position: this.transMisc.columns.rank,
									traffic_share: this.trans.traffic_val,
									traffic_potential: this.trans.traffic_pot,
								}}/>
                                <tbody>
                                	{this.renderLoadTableRows()}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

	render() {
        return (
            <div>
                {this.state.loaded && this.state.entries !== undefined ? this.renderContent() : this.renderLoadContent()}
            </div>
        );
    }

}

module.exports = SeoTrafficPotentialMath;


