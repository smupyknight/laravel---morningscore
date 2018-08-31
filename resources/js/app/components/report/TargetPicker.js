const {Component} = require("react");
const env = require("app/services/env");
const router = require("app/services/router");
const EnvData = require("app/api/EnvData");
 
class TargetPicker extends Component {
    constructor(props) {
    	super(props);

    	this.state = {
			targets: env.get('domains'),
			selected: {
				domain: env.get('domain.id'),
				//locale: env.get('domain.locale_id'),
			},
		};
	}

	static defaultProps = {
		locales: env.get('locales'),
	}

	componentDidMount() {
		EnvData.domains.add.onChange(this.refresh);
		EnvData.domains.remove.onChange(this.refresh);
	}

	refresh = () => {
    	this.setState({
			targets: env.get('domains'),
			selected: {
				domain: env.get('domains').slice(-1)[0].id,
				//locale: env.get('domains').slice(-1)[0].locales[0],
			}
		}, () => {
			this.handleChange();
		});
	}

	onDomainChange = (e) => {
		let id = parseInt(e.target.value);
		let {selected} = this.state;
		selected.domain = id;

		this.setState({selected}, () => {
			this.handleChange();
		});
	}

	//onLocaleChange = (e) => {
	//	let id = parseInt(e.target.value);
	//	let {selected} = this.state;
	//	selected.locale = id;

	//	this.setState({selected}, () => {
	//		this.handleChange();
	//	});
	//}

	handleChange() {
		let {selected} = this.state;

		env.set('domain', {
			id: selected.domain,
			//locale_id: selected.locale
		});
		EnvData.target.run(null);

		history.pushState('', '', router.route('portal.home', null, {
			domain: selected.domain,
			//locale: selected.locale,
		}));
	}

    render() {
    	let {targets} = this.state;
    	let {selected} = this.state;
    	//let locales = targets.find(t => t.id === selected.domain).locales;

        return (
        	<div>
				<select
					className='target-picker'
					value={selected.domain}
					onChange={this.onDomainChange}
				>
					{ targets.map((target, index) => (
						<option key={index} value={target.id}>{target.domain}</option>
					))}
				</select>

				{/*
				<select
					className='target-picker'
					value={selected.locale}
					onChange={this.onLocaleChange}
				>
					{ locales.map((locale, index) => (
						<option key={index} value={locale}>{this.props.locales.find(l => l.id === locale).display}</option>
					))}
				</select>
				*/}
			</div>
        );
	}
}
module.exports = TargetPicker;
