const Component = require("../Base");
const PropTypes = require("prop-types");
const Button = require("app/components/modals/triggers/Button");
const Anchor = require("app/components/modals/triggers/Anchor");

class TableTitle extends Component {
    static get propTypes() {
		return {
            title: PropTypes.string,
            button: PropTypes.string,
		};
    }
    renderTitleButton() {
        return (
            <div className="keywords-box-filter">
                <Button
                    content={this.props.button || "" }
                    class="button add-keyword"
                    refId="add-keyword-modal"
                />
                {/* <div className="button competitor">Competitor graph</div> */}
            </div>
        );
    }

    render() {
        return(
            <div className="keywords-box-title-container">
                <h5>{this.props.title}</h5>
                <Anchor
                    img={this.props.anchorImg}
                    className={this.props.anchorModifier}
                    refId={this.props.anchorRef}
                    title={this.props.anchorTitle}
                />
                { this.props.button ? this.renderTitleButton() : null }
                
            </div>
        );
    }
}

module.exports = TableTitle;
