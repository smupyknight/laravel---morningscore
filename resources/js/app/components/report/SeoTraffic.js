const Component = require("./Base");
const PropTypes = require("prop-types");
const logger = require("app/services/logger");
const {ScoreProgress} = require("morningscore-charts");
const formatNumber = require("app/util/formatNumber");
const Image = require("app/components/mixins/Image");
const EnvData = require("app/api/EnvData");
const env = require("app/services/env");
const validData = require('app/util/validData');
const Anchor = require("app/components/modals/triggers/Anchor");
const router = require("app/services/router");
const moment = require("moment");
const assign = require("object-assign");
// const formatNumber = require("../../util/formatNumber");
// const socketIOClient = require("socket.io-client");
// const formatNumber = require("../../util/formatNumber");
// const socketIOClient = require("socket.io-client");

class SeoTraffic extends Component {

    get name() {
        return 'seo_traffic';
    }

    get requiredParams() {
        return assign({}, super.requiredParams, {
            competitors: "domain.competitors.domains",
        });
    }

    initializeChart() {
        this.chart = new ScoreProgress(this.chartElement, {
            plotPast: this.state.has_past_data,

            hideAxisX: false,
            hideAxisY: true,
            dateFormat: 'D. MMM YYYY',
            margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }

        });
    }

    get initialData() {
        return {
            entries: ScoreProgress.nullData(0),
            currency: "DKK",
            has_past_data: false
        };
    }

    didLoadData() {
        if (this.chartElement) {
            if (!this.chart) {
                this.initializeChart();
            }

			let domain = env.get('domain.domain');
			var domainEntries = this.state.entries[domain];

			// Handles case for single day selected
			if (validData(domainEntries) && domainEntries.length === 1) {
				
				// Makes sure it doesn't pass a refference
				let currentDay = Object.assign(domainEntries[0]);

				let nextDay = { 
					date: moment(domainEntries[0].date).add(1, "d").toISOString(),
					current: domainEntries[0].current
				};

				this.chart.render([
					currentDay,
					nextDay,
				]);
			}
			else {
				this.chart.render(this.state.entries[domain]);
			}
        }
    }

	renderTabs() {
		return (
			<div className="tabs-container">
				<div className="tab">
					<span className="tab-title">Total Organic Traffic</span>
					<div className="tab-result">
						<span className="tab-number">{formatNumber(this.percentageValue)}%</span>
						<div className="change">
							<span>{formatNumber.signed(this.percentageChange)}%</span>
							<div className="status-icon">
								<div></div>
								<div></div>
								<div></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		);
	}


    renderContent() {
        return (
            <div className="traffic-box-container">
                <div className="traffic-box-content">
                    <div className="traffic-title">
                        <span className="title">{this.trans.title}</span>
                        <Anchor
                            title=""
                            img={{src: router.url("img/icons/information.svg"), alt: "information icon", class: "asd"}}
                            refId="seo-potential-modal"
                            className="anchor anchor-info anchor--align-right"
                        />
                    </div>
                    <p className="traffic-description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation 
                    </p>
                    {this.renderTabs()}
                </div>
                <div className="traffic-box-graph traffic-box-graph__seo-traffic">  
                    <div className="traffic-box-graph-result">
                        <div ref={el => this.chartElement = el} className="chart" height="100%"></div>
                    </div>
                </div>
            </div>
        );
    }

    renderLoadContent() {
        return (
            <div className="traffic-box-container">
				<div className="traffic-box-content">
					<Anchor
						title=""
						img={{src: "img/icons/information.svg", alt: "information icon", class: "asd"}}
						refId="seo-potential-modal"
						className="seo-box-anchor anchor anchor-info"
					/>
					<div className="traffic-title">
						<span className="title"><h2>{this.transMisc.loading.working_hard}</h2></span>
					</div>
					
					<p className="traffic-description">
						{this.transMisc.loading.mission}
						{this.transMisc.loading.not_long}
					</p>
				</div>
                <div className="traffic-box-graph traffic-box-graph__seo-traffic">  
                    <div className="traffic-box-graph-result">
						<div ref={el => this.chartElement = el} className="chart" height="100%"></div>
                    </div>
                </div>
            </div>
        );
    }

    render() {

        return (
            this.loaded && validData(this.state.entries) 
                ? this.renderContent() 
                : this.renderLoadContent()
        );
    }
}

module.exports = SeoTraffic;
