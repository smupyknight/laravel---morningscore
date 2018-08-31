const {Component} = require("react");
const PropTypes = require("prop-types");
const env = require("app/services/env");

class LocaleField extends Component {
    constructor(props) {
    	super(props);

    	this.state = {
			country: "",
			language: "",
		};
	}

	static get propTypes() {
		return {
			choose_country:	PropTypes.string.isRequired,
			choose_lang:	PropTypes.string.isRequired,
			required:		PropTypes.bool,
			onSelect:		PropTypes.func.isRequired,
		};
	}

	static defaultProps = {
		locales: env.get('locales')
	}

	changeCountry = (e) => {
		let country = e.target.value;
		let locale	= this.props.locales[country];
		let primary;

		for (let language in locale) {
			if (locale[language].is_primary) {
				primary = locale[language];
			}
		}

		this.setState({country: country});
		this.props.onSelect(primary.id);
	}

	changeLanguage = (e) => {
		let language = e.target.value;
		let {country} = this.state;
		let locale	= this.props.locales[country][language];

		this.setState({language: language});
		this.props.onSelect(locale.id);
	}

	renderLanguage() {
		let languages	= this.props.locales[this.state.country];
		let langs		= Object.keys(languages);

		return (
			<div className="field-container">
				<select
					required={this.props.required}
					value={this.state.language}
					onChange={this.changeLanguage}
				>
					<option value="" disabled>{this.props.choose_lang}</option>

					{ langs.map((lang, index) => (
						<option
							key={index}
							value={lang}
						>
							{lang}
						</option>
					))}
				</select>
			</div>
		);
	}

	render() {
		let {locales}	= this.props;
		let {country}	= this.state;

		let countries	= Object.keys(locales);
		let needs_lang	= (locales[country] && Object.keys(locales[country]).length > 1);

		return (
			<div className="fields-group fields-group--inline fields-group--2-col">
				<div className="field-container">
					<select
						required={this.props.required}
						value={this.state.country}
						onChange={this.changeCountry}
					>
						<option value="" disabled>{this.props.choose_country}</option>

						{ countries.map((country, index) => (
							<option
								key={index}
								value={country}
							>
								{country}
							</option>
						))}
					</select>
				</div>

				{ needs_lang ? this.renderLanguage() : null }

			</div>


		);
	}
}

module.exports = LocaleField;
