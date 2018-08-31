const { Component } = require("react");

class MobileOverlay extends Component 
{
	constructor(props) {
		super(props);

		this.state = {
			open: false
		}
	}

	componentDidMount() {
		if (this.getWindowWidth() < 856) {
			this.setState({
				open: true
			});
		}
		window.addEventListener("orientationchange", () => {
			this.setState({
				open: false
			});
			window.removeEventListener("orientationchange", null);
		});
	}

    getWindowWidth() {
        let w = window,
            d = document,
            e = d.documentElement,
            g = d.getElementsByTagName('body')[0],
            x = w.innerWidth || e.clientWidth || g.clientWidth;

        return x;
	}

	handleClick = () => {
		this.setState({
			open: !this.state.open
		});
		window.removeEventListener("orientationchange", null);
	}

    render () {
        return (
			<div className={`mobile-overlay ${this.state.open ? "mobile-overlay--show" : '' }`}>
				<h2>For a better experience, please use your device in landscape mode</h2>
				<img src="img/icons/rotate-screen.svg"/>
				<div className="button" onClick={this.handleClick}>Close</div>
            </div>
        );
    }
}

module.exports = MobileOverlay;