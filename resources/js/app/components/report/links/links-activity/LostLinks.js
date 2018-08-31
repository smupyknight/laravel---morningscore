const Component = require("app/components/report/links/LinksBase");
const PropTypes = require("prop-types");
const Anchor = require("app/components/modals/triggers/Anchor"); 
const router = require("app/services/router"); 
const Paginator = require("app/util/Paginator");
const array = require("app/util/array");
const TableHead = require("app/components/report/keyword-table/TableHead");

class LostLinks extends Component {

	constructor() {
		super();
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
		return 'refdomains_top_lost';
	}

	get sort_collection(){
        return this.state.refdomains_top_lost;
    }

    renderContent(links) {
    	let title = links.length + ' ';
		let pages = []
		
		if (links && links.length > 0) {
			pages = array.chunk(links, 8);
		}

		if (links.length > 1) {
			title = title + this.trans.titles.plural;		
		} else {
			title = title + this.trans.titles.singular;
		}

        return (
			<div className={`links-activity ${this.state.refreshing ? 'loading' : ''}`}>
				<div className="links-activity__wrapper lost-links">
					<h5>{title}</h5>
                    <Anchor 
                      title="" 
                      img={{src: router.url("img/icons/information.svg"), alt: "information icon", class: "asd"}} 
                      refId="lost-links-modal" 
                      className="anchor anchor-info anchor--align-left" 
                    /> 
                    <div className="links-activity__table">
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
								{links.length > 0 ? pages[this.state.page - 1].map(this.renderRows) : null}	
							</tbody>
    					</table>
						{
							pages.length > 1
								? <Paginator 
									pageHandler={this.updatePage.bind(this)}
									nPages={pages.length}
								/>
								: <div></div>
						}
                    </div>
				</div>
			</div>
        );
	}
	
	renderFallback() {
		return (
			<div className={`links-activity ${this.state.refreshing ? 'loading' : ''}`}>
				<div className="links-activity__wrapper lost-links">
					<h5>{this.trans.titles.none}</h5>
                    <Anchor 
                      title="" 
                      img={{src: router.url("img/icons/information.svg"), alt: "information icon", class: "asd"}} 
                      refId="lost-links-modal" 
                      className="anchor anchor-info anchor--align-left" 
                    /> 
                    <div className="links-activity__table links-activity__table--fallback">
    					<table>
    						<tbody>
							<tr>
								<td>
									<p>{this.trans.titles.fallback}</p>
								</td>
							</tr>
    						</tbody>
    					</table>
                    </div>
				</div>
			</div>
		);
	}

	updatePage (page) {
        this.setState({ page: page});
    }
}

module.exports = LostLinks;
