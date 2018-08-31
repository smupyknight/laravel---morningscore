const Component = require("../Base");
const PropTypes = require("prop-types");

class TableLoading extends Component {
    static get propTypes() {
		return {
            rows: PropTypes.number,
            cols: PropTypes.number
		};
    }
    
    static get defaultProps() {
		return {
            rows: 10,
            cols: 6
		};
    }

    tableColumns() {
        let cols = [];
        const colsNumber = this.props.cols;

        for (let i = 0; i < colsNumber; i++) {
            cols.push(<td key={i}><div className="loading-data"></div></td>);
        }

        return cols;
    }

    tableRows() {
        let rows = [];
        const rowsNumber = this.props.rows;

        for (let index = 0; index < rowsNumber; index++) {
            rows.push(<tr key={index} className="loading">{this.tableColumns()}</tr>);
        }

        return <tbody>{rows}</tbody>;
    }

    render() {
        return this.tableRows();
    }
}

module.exports = TableLoading;