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
const router = require("app/services/router");

class MorningscoreMath extends Component {

    constructor(props) {
        super(props);

        this.state = {
			page: 1,
			filterRange: [],
			entries: []
        };


        this.sorts = {
            traffic_value: 'desc'
        };

		this.sort();
		
        // Bind the this context to the handler function
        this.headerClicked = this.headerClicked.bind(this);
    }

    get name() {
        return 'morningscore_math';
    }

    get sort_collection() {
        return this.state.entries;
    }

    get subscriptions() {
    	return [];
	}

	didLoadData = () => {
		if (this.state.loaded) {
			this.setState({
				entries: this.state.data.entries
			});
		}
		
	}

	filterRank = (range) => {
		if (Array.isArray(range)) {
			if (range.length === 2) {
				var filteredEntries = this.state.data.entries.filter(
					entry => range[0] <= entry.position && entry.position <= range[1]
				)
				
				if (Math.ceil(filteredEntries.length / 8) < this.state.page && filteredEntries.length !== 0) {
					this.setState({
						page: Math.ceil(filteredEntries.length / 8),
						entries: filteredEntries,
						filterRange: range
					},
						this.paginator.setState({
							p: Math.ceil(filteredEntries.length / 8)
						})
					);
				}
				else {
					this.setState({
						entries: filteredEntries,
						filterRange: range
					})
				}
	
				return;
			}
			this.setState({
				entries: this.state.data.entries,
				filterRange: range
			});
		}
		else {
			console.error("Parameter must be array");	
		}
    }

    toggleFilterClass = () => {
        this.setState((prevState) => ({
            filterActive: !prevState.filterActive
        }));
    }

	renderRankFilters() {
		ranges = [
			[],
			[1, 10],
			[11, 20]
		]

		return (
			<div className="filter-dropdown" onClick={this.toggleFilterClass}>
				<div className="filter-dropdown__title">
					{this.state.filterRange.length == 0 ? this.transMisc.ranks.all_ranks : this.transMisc.ranks.ranks + ' ' + this.state.filterRange[0] + ' - ' + this.state.filterRange[1]}
				</div>
				<div className={`filter-dropdown__content ${this.state.filterActive ? 'filter-dropdown__content--active' : ''}`}>
					{
						ranges.map((val, key) => {
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

    renderTable(entries) {
		
        return (
            <table>
				<TableHead 
					titles={{
						kw: this.transMisc.columns.keyword,
						sv: this.transMisc.columns.searches,
						position: this.transMisc.columns.rank,
						est_traffic: this.trans.columns.clicks,
						cpc: this.trans.columns.cpc + ' ' + env.get('user.currency'),
						traffic_value: 'Morningscore'
					}} 
					// arrowsPosition={3}
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
                        <td>{formatInteger(entry.position)}</td>
                        <td>{formatNumber(entry.est_traffic, 0, 0)}</td>
                        <td>{`${formatNumber(entry.cpc, 2, 2)} ${env.get('user.currency')}`}</td>
                        <td>{`${formatNumber(entry.traffic_value, 2, 2)} ${env.get('user.currency')}`}</td>
                    </tr>
                ))}
                </tbody>
            </table>
        );
    }


	renderContent() {	

		let pages = [];
		this.state.entries.length > 0 
			? pages = array.chunk(this.state.entries, 8)
			: null;

        return (
            <div className={`calculations-modal ${this.state.refreshing ? "loading" : ""}`}>
                <div className="modal-title-group">
                    
                    <div className="modal-title-group__description">
                        <div className="modal-title">
                            <h2>
                                <span>{this.trans.title}</span>
                                {
                                    this.state.refreshing 
                                        ? <img src={router.url("img/loader.gif")} alt="loader" className="loader"/>
                                        : null
                                }
                            </h2>

                            <p className="tagline">{this.trans.we_found_part_1} {this.state.entries.length} {this.trans.we_found_part_2}</p>

                            <div className="filter-wrap">
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
	
    updatePage(page) {
        this.setState({page: page});
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
                                    position: this.transMisc.columns.rank,
                                    sv: this.transMisc.columns.searches,
                                    est_traffic: this.trans.columns.clicks,
                                    cpc: this.trans.columns.cpc + ' ' + env.get('user.currency'),
                                    traffic_value: 'Morningscore'
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

module.exports = MorningscoreMath;
