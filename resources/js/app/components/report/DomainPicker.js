const {Component} = require("react")
const Anchor = require("app/components/modals/triggers/Anchor");
const renderer = require("app/services/renderer");
const env = require("app/services/env");
const EnvData = require("app/api/EnvData");
const router = require("app/services/router");
const trans = require("app/services/i18n").trans;

class DomainPicker extends Component{
	
	constructor(props) {
		super(props);

		this.state = {
			targets: env.get('domains'),
			locales: env.get('locales'),
			selected: {
				domain: env.get('domain.id'),
				//locale: env.get('domain.locale_id'),
			},
			openPicker: false,
		}
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

	handleClick = () => {
		this.setState({
			openPicker: false,
		})
	}

	//onLocaleChange = (e) => {
	//	let id = parseInt(e.target.value);
	//	let {selected} = this.state;
	//	selected.locale = id;

	//	this.setState({selected}, () => {
	//		this.handleChange();
	//	});
	//}

	onDomainChange = (e) => {
		let id = parseInt(e.currentTarget.getAttribute("data-tag"));
		let {selected} = this.state;
		selected.domain = id;

		this.setState({selected}, () => {
			this.handleChange();
			this.togglePicker();
		});
	}

	togglePicker = () => {
		this.setState({
			openPicker: !this.state.openPicker
		});
	}

	openModal = (e) => {
        e.preventDefault();
        const el = renderer.element("manage-domains-modal");
        if (el) {
			el.open();
			this.togglePicker();
        }
    }

    findLocale(id) {
    	let {locales} = this.state;

    	for (country in locales) {
    		for (language in locales[country] ) {
    			let local = locales[country][language];
    			if (local.id === id) {
    				return local;
				}
			}
		}
		return null;
	}

	renderDomains = (val, key) => {
		let locale = this.findLocale(val.locales[0]);

		return(
			<div 
				className="domain-picker__domains-list__entry" 
				key={key}
				onClick={this.onDomainChange}
				data-tag={val.id}
			>
				<div>
					{ locale ? (
						<span title={locale.display} className={`flag-icon flag-icon-${locale.icon_name}`}></span>
					) : null }
					{val.domain}
				</div>
			</div>
			
		);
	}

	
	render () {
		let {targets} = this.state;
		let {selected} = this.state
		let selectetDomain = targets.find(t => t.id === selected.domain).domain;
		
		//let locales = targets.find(t => t.id === selected.domain).locales;
		
		return (
			<div className="domain-picker-container">
				<div className={`domain-picker ${this.state.openPicker ? "domain-picker--active" : ""}`}>
					<div className="domain-picker__active-domain" onClick={this.togglePicker}>
						<p>{selectetDomain}</p>
					</div>
					<div className="domain-picker__domains-box">
						<div className="domain-picker__domains-list-wrapper">
							{/*<input type="text" name="search_domains" placeholder="Search" id="search_domains"/>*/}
							<div className="domain-picker__domains-list">
								{targets.map(this.renderDomains)}
							</div>
						</div>
						<div className="domain-picker__manage-domains">
							<a onClick={this.openModal}>{trans('report.misc.manage_domains')}</a>
						</div>
					</div>
				</div>
				<div className={
						`domain-picker-overlay 
						${this.state.openPicker 
							? "domain-picker-overlay--active" 
							: ""}`
					}
					onClick={this.handleClick}
					>
				</div>
			</div>
		);
	}
}

module.exports = DomainPicker;
