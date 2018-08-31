const {Component} = require("react");
const EnvData = require("app/api/EnvData");
const env = require("app/services/env");
const trans = require("app/services/i18n").trans;
const router = require("app/services/router");

class SystemCurrency extends Component {
	constructor(props) {
		super(props);
		let currency = env.get('user.currency');

		if( currency == null || this.props.currencies.indexOf(currency) < 0) {
			currency = 'DKK';
		}

		this.state = {
			currency: currency
		};
	}

	static get defaultProps() {
		return {
			currencies: [
				"AED",
				"AFN",
				"ALL",
				"AMD",
				"ANG",
				"AOA",
				"ARS",
				"AUD",
				"AWG",
				"AZN",
				"BAM",
				"BBD",
				"BDT",
				"BGN",
				"BHD",
				"BIF",
				"BMD",
				"BND",
				"BOB",
				"BRL",
				"BSD",
				"BTC",
				"BTN",
				"BWP",
				"BYN",
				"BZD",
				"CAD",
				"CDF",
				"CHF",
				"CLF",
				"CLP",
				"CNH",
				"CNY",
				"COP",
				"CRC",
				"CUC",
				"CUP",
				"CVE",
				"CZK",
				"DJF",
				"DKK",
				"DOP",
				"DZD",
				"EGP",
				"ERN",
				"ETB",
				"EUR",
				"FJD",
				"FKP",
				"GBP",
				"GEL",
				"GGP",
				"GHS",
				"GIP",
				"GMD",
				"GNF",
				"GTQ",
				"GYD",
				"HKD",
				"HNL",
				"HRK",
				"HTG",
				"HUF",
				"IDR",
				"ILS",
				"IMP",
				"INR",
				"IQD",
				"IRR",
				"ISK",
				"JEP",
				"JMD",
				"JOD",
				"JPY",
				"KES",
				"KGS",
				"KHR",
				"KMF",
				"KPW",
				"KRW",
				"KWD",
				"KYD",
				"KZT",
				"LAK",
				"LBP",
				"LKR",
				"LRD",
				"LSL",
				"LYD",
				"MAD",
				"MDL",
				"MGA",
				"MKD",
				"MMK",
				"MNT",
				"MOP",
				"MRO",
				"MRU",
				"MUR",
				"MVR",
				"MWK",
				"MXN",
				"MYR",
				"MZN",
				"NAD",
				"NGN",
				"NIO",
				"NOK",
				"NPR",
				"NZD",
				"OMR",
				"PAB",
				"PEN",
				"PGK",
				"PHP",
				"PKR",
				"PLN",
				"PYG",
				"QAR",
				"RON",
				"RSD",
				"RUB",
				"RWF",
				"SAR",
				"SBD",
				"SCR",
				"SDG",
				"SEK",
				"SGD",
				"SHP",
				"SLL",
				"SOS",
				"SRD",
				"SSP",
				"STD",
				"STN",
				"SVC",
				"SYP",
				"SZL",
				"THB",
				"TJS",
				"TMT",
				"TND",
				"TOP",
				"TRY",
				"TTD",
				"TWD",
				"TZS",
				"UAH",
				"UGX",
				"USD",
				"UYU",
				"UZS",
				"VEF",
				"VND",
				"VUV",
				"WST",
				"XAF",
				"XAG",
				"XAU",
				"XCD",
				"XDR",
				"XOF",
				"XPD",
				"XPF",
				"XPT",
				"YER",
				"ZAR",
				"ZMW",
				"ZWL",
			],
		};
	}
	
	get trans() {
		return trans('report.components.system_currency_settings');
	}

	submit = (e) => {
		e.preventDefault();
		this.setState({currency: e.target.value});
        EnvData.currency.run({
			currency: e.target.value,
        });
	}

    render() {
		return (
			<div className="modal-title">
				<div className="modal-title--has-icon">
					<span>{this.trans.title}</span>
					<div className="modal-title__icon modal-title__system-language">
						<select value={this.state.currency} onChange={this.submit} className="currency-picker">
							{this.props.currencies.map((val, index) => (
								<option key={index} value={val}>{val}</option>
							))}
						</select>
					</div>
				</div>
			</div>
		);
	}
}

module.exports = SystemCurrency;
