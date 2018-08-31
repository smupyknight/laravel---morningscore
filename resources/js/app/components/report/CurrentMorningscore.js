const Component = require("./Base");
const PropTypes = require("prop-types");
const formatNumber = require("../../util/formatNumber");
const formatChange = require("../../util/formatChange");
// const socketIOClient = require("socket.io-client");
const logger = require("app/services/logger");
const Anchor = require("app/components/modals/triggers/Anchor");
const Image = require("app/components/mixins/Image");
const router = require("app/services/router");

class CurrentMorningscore extends Component {
    get name() {
        return 'current_morningscore';
    }

    get initialData() {
        return {
            score: 0,
            currency: "DKK",
            percentage: 0,
            change: 0
        };
	}
	
	renderChange() {
		let {currency} = this.state;
		let {change} = this.state;
		let highlight = "";

		if (change <= -0.1) {
			highlight = "value-change--negative";
		}

		if (change >= 0.1 || change <= -0.1) {
			return (
				<div className={`value-change ${highlight}`}>
					{formatChange(change)}<span>{currency}</span>
				</div>	
			);
		}

		return null;
	}

	renderPercentage() {
		var {percentage} = this.state;
		var highlight = "";

		if (percentage <= -0.00001) {
			highlight = "percentage-highlight--negative";
		}

		if (percentage >= 0.00001 || percentage <= -0.00001) {
			return (
				<span className={`percentage-highlight ${highlight}`}>
					{formatChange(percentage.toFixed(4)*100)}%
				</span>
			);
		}

		return null;
	}
 
    renderContent() {
        let {score} = this.state;
		let {currency} = this.state;
		

        return (
            <div className="morningscore-box">
                <div className="info-toggle">
                    <Anchor
                        title=""
                        img={{src: router.url("img/icons/information.svg"), alt: "information icon"}}
                        refId="information-modal"
                    />
                </div>
                <div className="morningscore-box-title">
                    <div className="title-wrap">
                        <h5>{this.trans.title}</h5>
						{this.renderPercentage()}
                    </div>

                </div>
                <div className="morningscore-box-value">
					<div className="value">{formatNumber(score)}<span>{currency}</span></div>
					{this.renderChange()}
                </div>
                <div className="morningscore-box-bar">
                    {/* <div className={ `current-bar-fill ${ this.state.percentage > 0 ? "increasing" : "decreasing"}`}>
                        <div className="status-icon">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <div className="previous-bar-fill"></div> */}
                </div>
                <div className="morningscore-box-footer">
                    <Anchor
                        className="view-calculation"
                        title=""
                        refId="morningscore-math-modal"
                    >
                        <span className="percentage-circle"></span>{this.transMisc.show_me_the_math}
                    </Anchor>
                </div>
            </div>
        );
    }

    renderLoadContent() {
        if (this.state.score <= 0) {
            return (
                <div className="morningscore-box">
                    <div className="morningscore-box-title">
                        <div className="title-wrap">
                            <h5>{this.trans.loading.title}</h5>
                        </div>
                        <div className="info-toggle">
                            <Image 
                                src={ router.url("img/icons/information.svg") }
                                alt="information icon"
                                scale="1x"
                            />
                        </div>
                    </div>
                    <div className="morningscore-box-description">
                        <br/>
                        <p>{this.trans.loading.desc}</p>
                    </div>
                </div>
            );
        }
        else {
            return (
                <div className="morningscore-box">
                    <div className="info-toggle">
                        <Anchor
                            title=""
                            img={{src: router.url("img/icons/information.svg"), alt: "information icon"}}
                            refId="information-modal"
                        />
                    </div>
                    <div className="morningscore-box-title">
                        <div className="title-wrap">
                            <h5>Spaceman is calculating your total score</h5>
                            {/* <h5>{this.trans.title}</h5> */}
                        </div>
                    </div>
                    <div className="morningscore-box-value load-this">
                        <div className="loader"></div>
                        <div className="value">0<span>CUR</span></div>
                        <div className="value-change">0<span>CUR</span></div>
                    </div>
                    <div className="morningscore-box-bar load-this">
                        <div className="loader"></div>
                    </div>
                    <div className="morningscore-box-footer load-this">
                        <div className="loader"></div>
                        <a href="#" className="view-calculation"><span className="percentage-circle">%</span>{this.transMisc.show_me_the_math}</a>
                    </div>
                </div>
            );
        }

    }

    render() {
        // const {score} = this.state;

        return (
            <div className={`competitor-box-wrapper ${this.state.refreshing ? 'loading' : ''}`}>
                {this.loaded && this.state.score > 0 ? this.renderContent() : this.renderLoadContent()}
            </div>
        );
    }
}

module.exports = CurrentMorningscore;
