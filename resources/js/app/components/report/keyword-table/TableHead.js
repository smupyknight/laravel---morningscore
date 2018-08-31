const Component = require("../Base");
const PropTypes = require("prop-types");

class TableHead extends Component {
    static get propTypes() {
		return {
            titles: PropTypes.object,
			arrowsPosition: PropTypes.number,
			sortDirection: PropTypes.object
		};
    }

    static get defaultProps() {
		return {
            titles: ['Keyword name', 'Searches', 'Traffic', 'June', 'July', 'Change'],
            arrowsPosition: 0
		};
	}
	
	componentWillReceiveProps = (nextProps) => {
		if (typeof nextProps.sortDirection != 'undefined') {
			this.setState({
				sortDirection: nextProps.sortDirection[Object.keys(nextProps.sortDirection)[0]],
				sortedCol: Object.keys(nextProps.sortDirection)[0]
			})
		}
	}

	renderSortingDirection() {
		return (
			<img src="img/icons/arrow-line.svg" className={
				`filter-arrow 
				${this.state.sortDirection === "asc"
					? "filter-arrow--up"
					: "filter-arrow--down"
				}`
			}/>
		);
	}

    generateTableHeader() {
        const properties = this.props;
		const arrowsPosition = properties.arrowsPosition;
		
        return(
            <tr>
                {Object.keys(properties.titles).map((slug, index) => {
					
					return (
						<th key={index} data-col={slug} onClick={this.props.headerClicked} >
							{
								this.props.titles[slug] === this.props.titles[this.state.sortedCol]
								? <div>
									<p>{this.props.titles[slug]}</p>
									<div>{this.renderSortingDirection()}</div>
								</div>
								: <div><p>{this.props.titles[slug]}</p></div>
							}
						</th>
					)
				})}
            </tr>
        );
    }

    render() {
        return (
            <thead>
                {this.generateTableHeader()}
            </thead>
        );
    }
}

module.exports = TableHead;