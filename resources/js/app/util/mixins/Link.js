const {Component} = require("react");
const PropTypes = require("prop-types");
const {pluckKeysExcept} = require("app/util/object");

class Link extends Component {

	static get propTypes() {
		return {
			onClick: PropTypes.func,
			preventDefault: PropTypes.any
		};
	}

	static get defaultProps() {
		return {
			preventDefault: true
		};
	}

	componentDidMount() {
		this.element.addEventListener("click", this.onClick);
	}

	componentWillUnmount() {
		this.element.removeEventListener("click", this.onClick);
	}

	onClick = (e) => {
		if (this.props.preventDefault === true) {
			e.preventDefault();
		}

		if (typeof this.props.preventDefault === "function") {
			this.props.preventDefault(e, this.element);
		}

		if (typeof this.props.onClick === "function") {
			this.props.onClick(e);
		}
	};

	render() {
		const props = pluckKeysExcept(this.props, ["onClick", "preventDefault"]);

		return (
			<a ref={el => this.element = el} {...props}>{this.props.children}</a>
		);
	}

}

module.exports = Link;