const {Component} = require("react");
const axios = require("axios");
const PropTypes = require("prop-types");
const trans = require("app/services/i18n").trans;

class Form extends Component {
	static get propTypes () {
		return {
			onComplete: PropTypes.func,
			id: PropTypes.string
		};
	}

	constructor(props) {
		super(props);

		this.state = {
			message: null,
			loading: false,
			errors: null,
		};
	}

	get baseClassName() {
		return "form";
	}

	get trans() {
		return trans('report.components.' + this.name.toLowerCase());
	}

	get transMisc() {
		return trans('report.misc');
	}

	get className() {
		let classList = [this.baseClassName];

		if (this.state.loading) {
			classList.push("loading");
		}

		return classList.join(" ");
	}

	get actionUrl() {
		// ...
	}

	get successMessage() {
		//
	}

	buildPayload(form) {
		return new FormData(form);
	}

	onCancel = () => {
		this.setState({
			loading: false
		});

		if (typeof this.props.onCancel === 'function') {
			this.props.onCancel();
		}
	}

	onSubmit = (e) => {
		e.preventDefault();
		this.performSubmit(e.target);
	};

	beforeSubmit() {
		if (this.state.loading) {
			return false;
		}
		// Set as loading
		this.setState({loading: true, message: ''});
		return true;
	}

	performSubmit(form) {
		if (this.beforeSubmit() === false) {
			return;
		}
		return axios.post(this.actionUrl, this.buildPayload(form))
			.then(response => {
				this.onComplete(response.data);
				return response;
			})
			.catch(error => {
				this.onError(error.response.data);
			});
	}

	onComplete(response) {
		this.setState({
			loading: false,
			message: this.successMessage,
			errors: null,
		});
		if (typeof this.props.onComplete === 'function') {
			this.props.onComplete();
		}
	}

	onError(response) {
		let state = {
			loading: false
		};
		
		if (response.errors) {
			state.errors = response.errors;
		}

		this.setState(state);
	}

	renderMessage() {
		return (
			<div className="response">
				<div className="message">{this.state.message}</div>
			</div>
		);
	}

	renderForm() {
		// ...
	}

	renderError(name, extraClass = null) {
		const className = "form-error" + (extraClass ? ` ${extraClass}` : "");

		if (this.state.errors && this.state.errors[name]) {
			return (<div className={className}>{this.state.errors[name][0]}</div>);
		}
	}
	
	renderHeader() {
		// ...
	}
	
	renderBody() {
		return (
			<div ref={el => this.bodyElement = el} >{this.renderForm()}</div>
		);
	}
	
	renderFooter() {
		// ...
	}

	render() {
		return (
			<div id={this.props.id} className={this.className} className={`form-body ${this.state.loading ? "loading" : ""}`}>
				{this.renderHeader()}
				{this.renderBody()}
				{this.renderFooter()}
			</div>
		);
	}

}

module.exports = Form;
