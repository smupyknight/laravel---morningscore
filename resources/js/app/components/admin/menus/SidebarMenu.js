const PropTypes = require("prop-types");
const {Component} = require("react");
const router = require("app/services/router");
const Icon = require("app/components/mixins/Icon");

/////////////////////////////////
// Item
/////////////////////////////////

class Item extends Component {

	static get propTypes() {
		return {
			title: PropTypes.string.isRequired,
			url: PropTypes.string,
			route: PropTypes.string,
			icon: PropTypes.string,
		};
	}

	static get defaultProps() {
		return {
			url: "#"
		};
	}

	get className() {
		let classList = ["item"];

		if (this.props.route === router.currentRoute) {
			classList.push("active");
		}

		return classList.join(" ");
	}

	renderIcon() {
		if (this.props.icon) {
			return (
				<Icon type={this.props.icon}/>
			);
		}
	}

	render() {
		return (
			<li className={this.className}>
				<a href={this.props.url}>
					{this.renderIcon()}
					<span>{this.props.title}</span>
				</a>
			</li>
		);
	}

}

/////////////////////////////////
// Group
/////////////////////////////////

class Group extends Component {

	static get propTypes() {
		return {
			title: PropTypes.string.isRequired,
			url: PropTypes.string,
			icon: PropTypes.string,
			items: PropTypes.array
		};
	}

	static get defaultProps() {
		return {
			url: "#",
			items: []
		};
	}

	constructor(props) {
		super(props);

		this.state = {
			open: this.active
		};
	}

	get active() {
		for (let i = 0; i < this.props.items.length; i++) {
			if (this.props.items[i].route === router.currentRoute) {
				return true;
			}
		}

		return false;
	}

	get className() {
		let classList = ["item", "item-group"];

		if (this.active) {
			classList.push("active");
		}

		if (this.state.open) {
			classList.push("open");
		}

		return classList.join(" ");
	}

	toggleCollapse = (e) => {
		e.preventDefault();

		this.setState(state => {
			return {
				open: !state.open
			}
		});
	};

	renderIcon() {
		if (this.props.icon) {
			return (
				<Icon type={this.props.icon}/>
			);
		}
	}

	renderItems() {
		return this.props.items.map((item, index) => {
			return (
				<Item key={index} {...item}/>
			);
		});
	}

	render() {
		return (
			<li className={this.className}>
				<a href={this.props.url} onClick={this.toggleCollapse}>
					{this.renderIcon()}
					<span>{this.props.title}</span>
				</a>

				<ul className="items">
					{this.renderItems()}
				</ul>
			</li>
		);
	}

}

/////////////////////////////////
// Menu
/////////////////////////////////

class Menu extends Component {

	static get propTypes() {
		return {
			items: PropTypes.array
		}
	}

	static get defaultProps() {
		return {
			items: []
		}
	}

	renderItems() {
		return this.props.items.map((item, index) => {
			return item.type === "group" ?
				<Group key={index} {...item}/> :
				<Item key={index} {...item}/>
		});
	}

	render() {
		return (
			<ul className="sidebar-menu">
				{this.renderItems()}
			</ul>
		);
	}

}

module.exports = Menu;