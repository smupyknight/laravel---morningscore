const Component = require("./Base");
const PropTypes = require("prop-types");
const logger = require("app/services/logger");
const {ScoreProgress} = require("morningscore-charts");
const formatNumber = require("app/util/formatNumber");
const Image = require("app/components/mixins/Image");
const moment = require("moment");
const env = require("app/services/env");
const router = require("app/services/router");
const validData = require('app/util/validData');
// const formatNumber = require("../../util/formatNumber");
// const socketIOClient = require("socket.io-client");
// const formatNumber = require("../../util/formatNumber");
// const socketIOClient = require("socket.io-client");

class HistoricalMorningscore extends Component {
	constructor(props) {
		super(props);

		this.state = {
			period: env.get('user.display_period'),
		};
	}

	refresh() {
		super.refresh();
		this.setState({period: env.get('user.display_period')});

		if (this.chart) {
			this.chart.options.currency = env.get('user.currency');
		}
	}

	get name() {
		return 'historical_morningscore';
	}

	initializeChart() {
		this.chart = new ScoreProgress(this.chartElement, {
			plotPast: this.state.has_past_data,
            hideAxisX: true,
            hideAxisY: true,
            dateFormat: 'D. MMM YYYY',
            currency: env.get('user.currency'),
            margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
		});
	}

	destroyChart() {
		if (Array.isArray(this.state.entries) && this.state.entries.length < 1) {
			delete this.chart;
		}
	}

	get initialData() {
		return {
			entries: ScoreProgress.nullData(0),
			currency: env.get('user.currency'),
			has_past_data: false
		};
	}

	didLoadData() {
		if (this.chartElement) {
			if (!this.chart) {
				this.initializeChart();
			}
				
			// Handles case for single day selected
			if (validData(this.state.entries) && this.state.entries.length === 1) {
				
				// Makes sure it doesn't pass a refference
				var currentDay = Object.assign(this.state.entries[0]);

				var nextDay = { 
					date: moment(this.state.entries[0].date).add(1, "d").toISOString(),
					current: this.state.entries[0].current
				};

				this.chart.render([
					currentDay,
					nextDay,
				]);
			}
			else {
				this.chart.render(this.state.entries);
			}
		}

	}

	renderContent() {
		return (
			<div className={`${this.state.refreshing ? 'loading' : ''}`}
>
				<div className="morningscore-graph-title">
					<h5>{this.trans.title} {/*this.state.period*/}</h5>
				</div>
				<div className="morningscore-graph-content-wrapper">
					<div ref={el => this.chartElement = el} className="chart" height="100%"></div>
				</div>
			</div>
		);	
	}

	renderLoadContent() {

		/*
		* Destroys chart in order to reinitialize it when 'renderContent()' runs
		* Fixes chart breaking when selecting a period that has no data
		*/
		this.destroyChart();

		return (
			<div className="morningscore-graph--loading">
				<div className={`morningscore-graph-title ${this.state.refreshing ? 'loading' : ''}`}>
					<h5>{this.trans.title}</h5>
				</div>
				<div className={`morningscore-graph-content-wrapper ${this.state.refreshing ? 'loading' : ''}`}>
					<p>
						<br/>
						{this.trans.loading.desc}
					</p>
					<img src={router.url("img/figures/magnifying-glass.svg")}/>
				</div>
			</div>
		);
	}

	render() {

		return (
            <div className="morningscore-graph">
				{
					this.loaded && Array.isArray(this.state.entries) && this.state.entries.length > 0 
					? this.renderContent() 
					: this.renderLoadContent()
				}
			</div>
		);
	}
}

module.exports = HistoricalMorningscore;
