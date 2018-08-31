/*
    To use this paginator you need to pass it a pageHandler function and a number of pages (nPages)
    
    The pageHandler has to be declared in the parent component so it has access to it's state and then passed through props
    to the paginator component. When passing the page handler you have to bind the context of the parent component
    
    Example of binding context
    // pageHandler={this.updatePage.bind(this)}

    Example of page handle inside the parent component.
    // updatePage (page) {
    //    this.setState({ page: page});
    // }
*/


const {Component} = require("react");
const PropTypes = require("prop-types");

class Paginator extends Component
{

    static get propTypes() {
        return {
            pageHandler: PropTypes.func.isRequired,
            // nPages = number of pages
            nPages: PropTypes.number.isRequired,

            // Optional prop, use this if you want to start from a specific page
            startPage: PropTypes.number,
			autoFocus: PropTypes.bool,
			
			hidden: PropTypes.bool
        };
    }

    constructor(props) {
        super(props);

        this.state = {
            // p = current page
            p: this.props.startPage ? this.props.startPage : 1,
        };
    }

    prevPage = () => {
        if (this.state.p > 1) {
            this.setState({ p: this.state.p - 1});
            this.props.pageHandler(this.state.p - 1);
        }
    };
    nextPage = () => {
        if (this.state.p < this.props.nPages) {
            this.setState({ p: this.state.p + 1});
            this.props.pageHandler(this.state.p + 1);
        }
    };

    selectPage = () => {
        let val = parseInt(this.refs.pageSelector.value);

        this.setState({ 
            p: val 
        },
        () => this.props.pageHandler(val)); // Callback after setting state
    }

    renderOptions () {
        // Allocating memory space
        var options = new Array(this.props.nPages);

        // Fill up the array
        for (var i = 1; i <= this.props.nPages; i++) {
            options[i] = <option 
                            key = {i} 
                            value = {i} 
                        >
                            {i} {/* Value */}
                        </option>;
        }

        return options;
    }

    render () {
        return (
            <div className={`paginator ${this.props.hidden ? "paginator-hidden" : ""}`}>
                <div className="paginator__prev" onClick={() => this.prevPage()}><span>Prev</span></div>

                <div className="paginator__page-selector">
                    <select ref="pageSelector" onChange={() => {this.selectPage(); }} value={this.state.p} autoFocus={this.props.autoFocus}>
                        {this.renderOptions()}
                    </select>
                </div>

                <div className="paginator__next" onClick={() => this.nextPage()}><span>Next</span></div>
            </div>
        );
    }
}

module.exports = Paginator;