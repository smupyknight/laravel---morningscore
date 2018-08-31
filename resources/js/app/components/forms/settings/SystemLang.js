const {Component} = require("react");
const Image = require("app/components/mixins/Image");
const EnvData = require("app/api/EnvData");
const env = require("app/services/env");
const trans = require("app/services/i18n").trans;
const router = require("app/services/router");

class SystemLang extends Component {
	constructor(props) {
		super(props);
		let lang = env.get('user.lang');
		this.state = {
			lang: lang ? lang : 'da' // DEFAULT LANG FALLBAKC
		};
	}
	
	get trans() {
		return trans('report.components.system_lang_settings');
	}

    componentDidMount() {
    	EnvData.lang.onChange(this.refresh);
	}

	refresh = () => {
		this.setState({
			lang: env.get('user.lang')
		});
		window.location.reload();
	}

	submit= (lang, e) => {
		e.preventDefault();
        return EnvData.lang.run({
			lang: lang,
        });
	}

    render() {
		return (
			<div className="modal-title">
				<div className="modal-title--has-icon">
					<span>{this.trans.title}</span>
					<div className="modal-title__icon modal-title__system-language">
						<a onClick={(e) => this.submit('da', e)} className={`language ${this.state.lang === 'da' ? 'language--active' : ''}`}>
							<Image src={ router.url("img/language-icons/denmark.svg") } alt="danish" scale="1x"/>
							<h6>Danish</h6>
						</a>
						<a onClick={(e) => this.submit('en', e)} className={`language ${this.state.lang === 'en' ? 'language--active' : ''}`}>
							<Image src={ router.url("img/language-icons/united-states.svg") } alt="english" scale="1x"/>
							<h6>English</h6>
						</a>
					</div>
				</div>
			</div>
		);
	}
}

module.exports = SystemLang;
