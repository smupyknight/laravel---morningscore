const {Component} = require("react");
const shortId = require("shortid");
const {CSSTransitionGroup} = require("react-transition-group");
const PropTypes = require("prop-types");


class Notifications extends Component {

	static get propTypes() {
		return {
			type: PropTypes.string,
			message: PropTypes.string,
			showDuration: PropTypes.number,
			transitionDuration: PropTypes.number
		};
	}

	static get defaultProps() {
		return {
			showDuration: 3000,
			transitionDuration: 250
		};
	}

	constructor(props) {
		super(props);

		this.state = {
			current: this.props.message ? {
				id: shortId(),
				type: this.props.type,
				message: this.props.message
			} : null
		};
	}

	componentDidMount() {
		if (this.props.message) {
			this.show(this.props.message, this.props.type || "info");
		}
	}

	show(message, type = 'info') {
		let id = shortId();

		this.setState({
			current: {
				id,
				message,
				type
			}
		});

		// Hide on timeout
		setTimeout(() => {
			if (this.state.current && this.state.current.id === id) {
				this.hide();
			}

		}, this.props.showDuration);
	}

	hide() {
		this.setState({
			current: null
		});
	}

	renderMessage() {
		if (this.state.current) {
			let classList = ["notification", this.state.current.type];

			return ([
				<div key={this.state.current.id} className={classList.join(" ")}><span>{this.state.current.message}</span></div>
			]);
		}
	}

	render() {
		return (
			<div className="notifications">
				<CSSTransitionGroup
					transitionName="show"
					transitionEnterTimeout={this.props.transitionDuration}
					transitionLeaveTimeout={this.props.transitionDuration}>
					{this.renderMessage()}
				</CSSTransitionGroup>
			</div>
		);
	}

}

module.exports = Notifications;