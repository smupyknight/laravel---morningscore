const {Component} = require("react");
const PropTypes = require("prop-types");
const router = require("app/services/router");
const debounce = require("app/util/debounce");
const axios = require("axios");

class DomainField extends Component {
	constructor (props) {
		super(props);

		this.state = {
			loading: false,
			errors: null,
			status: '',
		};
	}

	static get propTypes() {
		return {
			type: PropTypes.string.isRequired,
			name: PropTypes.string.isRequired,
			placeholder: PropTypes.string,
			default: PropTypes.string,
			required: PropTypes.bool,
			autofocus: PropTypes.bool,
		};
	}

    onInput = (e) => {
		if (e.target.value.length < 1) {
			this.performCheck.cancel();
			this.handleCheck(null, true);
			return;
		}
		this.setState({loading: true, message: null});
		this.performCheck(e.target.value)
	}

	performCheck = debounce(700, (domain) => {
    	let route = router.route("api.portal.domain.check", {}, {domain: domain});

    	return axios.get(route)
    		.then(response => {
                this.handleCheck(response, true);
                return;
			})
    		.catch(error => {
                this.handleCheck(error.response.data);
			});
	});

	handleCheck(response, clear = false) {
		let	state = {
			loading: false,
			status: '',
			errors: this.state.errors || {},
		};

		if (clear) {
			state.errors = null;
			if (response) {
				state.status = 'input-ok';
			}

		} else if (response.errors && response.errors.domain) {
			state.errors = response.errors.domain;
			state.status = 'input-error';
		}

		this.setState(state);
	}

	render() {
		return (
			<div>
				<input
					type={this.props.type}
					name={this.props.name}
					placeholder={this.props.placeholder}
					defaultValue={this.props.default}
					required={this.props.required}
					autoFocus={this.props.autofocus}

					onChange={this.onInput}
					className={`${this.state.status} ${this.state.loading ? 'input-loading' : ''}`}
				/>
			</div>
		);
	}
}

module.exports = DomainField;
