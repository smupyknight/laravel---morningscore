const Component = require("app/components/report/links/LinksBase");
const PropTypes = require("prop-types");
const TableHead = require("app/components/report/keyword-table/TableHead");
const Paginator = require("app/util/Paginator");
const array = require("app/util/array");
const Anchor = require("app/components/modals/triggers/Anchor"); 
const router = require("app/services/router"); 

class AllLinks extends Component{
	
	constructor (props) {
		super(props)

		this.state = {
			page: 1
		} 
		
		this.sorts = {
            link: 'desc'
		};
		
		this.sort();
		
        // Bind the this context to the handler function
        this.headerClicked = this.headerClicked.bind(this);
	}
	

	get name() {
		return "refdomains_all";
	}

	get sort_collection(){
        return this.state.refdomains_all;
    }

	handleLink = link => {
		return link;
	}

	renderFallback() {
		return (
			<div className={`all-links ${this.state.refreshing ? 'loading' : ''}`}>
				<div className="all-links__wrapper">
					<h5>{this.trans.title}</h5>
					<table className="no_links">
						<tbody>
							<tr className="no_links">
								<td><p>{this.trans.no_links}</p></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		);
	}

	renderContent(pages) {
		pages = array.chunk(pages, 10);

		return (
			<div className={`all-links ${this.state.refreshing ? 'loading' : ''}`}>
				<div className="all-links__wrapper">
					<h5>{this.trans.title}</h5>
					<Anchor 
					  title="" 
					  img={{src: router.url("img/icons/information.svg"), alt: "information icon", class: "asd"}} 
					  refId="all-links-modal" 
					  className="anchor anchor-info anchor--align-left" 
					/> 
					<div className="all-links__table">
						<table>
							<TableHead
								titles={{
									link: this.trans.table.link,
									strength: this.trans.table.change,
								}}
								sortDirection={this.sorts}
								headerClicked={this.headerClicked}
							/>
							<tbody>
								{pages[this.state.page - 1].map(this.renderRows)}
							</tbody>
						</table>
					</div>
					<div>
					<Paginator 
						pageHandler={this.updatePage.bind(this)}
						nPages={pages.length}
						hidden={pages.length < 2 ? true : false}
					/>
					</div>
				</div>
			</div>
		);
	}

	updatePage (page) {
		this.setState({ page: page });
	}
}

module.exports = AllLinks;
