const Component = require("./Base");
const PropTypes = require("prop-types");
// const formatNumber = require("../../util/formatNumber");
// const socketIOClient = require("socket.io-client");
const {SeoPotential} = require("morningscore-charts");
const formatNumber = require("app/util/formatNumber");
const formatURL = require("app/util/formatURL");
const assign = require("object-assign");
const competitorColors = require("app/util/competitorColors");
const EnvData = require("app/api/EnvData");
const Image = require("app/components/mixins/Image");
const Anchor = require("app/components/modals/triggers/Anchor");
const router = require("app/services/router");

class SEOPotential extends Component {

	get name() {
		return 'seo_potential';
	}

    get requiredParams() {
        return assign({}, super.requiredParams, {
			competitors: "domain.competitors.domains",
        });
    }

	get subscriptions() {
        return [
            EnvData.period,
            EnvData.target,
			EnvData.competitors,
        ];
	}

	handleError(error) {
		this.setState({data:undefined, stats:undefined, refreshing: false})
	}

	initializeChart() {
		this.chart = new SeoPotential(this.chartElement, {
            margin: {
                top: 10,
                right: 25,
                bottom: 40,
                left: 45
            }
		});
	}

	destroyChart() {
		delete this.chart;
	}

	get initialData() {
		return {
			data: SeoPotential.randomData(4, 0, 0, [
				{id: "me", name: "You", domain: "mydomain.com"},
				{id: "competitor_1", name: "competitor 1", domain: "competitor 1"},
				{id: "competitor_2", name: "competitor 2", domain: "competitor 2"},
				{id: "competitor_3", name: "competitor 3", domain: "competitor 3"}
			])
		};
	}

	didLoadData() {
		if (this.chartElement) {
			if (!this.chart) {
				this.initializeChart();
			}

			this.chart.render(this.state.data.map((d, i) => {
				d.color = competitorColors(d.domain);

				if (d.color === null) {
					d.color = "#87f5ff";
				}

				d.domain = formatURL(d.domain);

				return assign({}, d, {
					name: i === 0 ? this.trans.you : null,
					periods: d.periods.slice(0, 1)
				});
			}));
		}
	}

	get totalTrafficPotentialValue() {
		return this.state.stats.potential.value;
	}

	get trafficShareValue() {
		return this.state.stats.actual.value;
	}

	get percentageValue() {
		return this.state.stats.ratio.value * 100;
	}

	get totalTrafficPotentialChange() {
		return this.state.stats.potential.change !== 0.0 ?
			this.state.stats.potential.change : null;
	}

	get trafficShareChange() {
		return this.state.stats.actual.change !== 0.0 ?
			this.state.stats.actual.change : null;
	}

	get percentageChange() {
		return this.state.stats.ratio.change !== 0.0 ?
			this.state.stats.ratio.change * 100 : null;
	}

	getChangeClass(key) {
		let classList = ["tab-result"];

		const change = this.state.stats[key].change;

		if (change > 0.0) {
			classList.push("increasing");
		}
		else if (change < 0.0) {
			classList.push("decreasing");
		}

		return classList.join(" ");
	}

	get totalTrafficPotentialClass() {
		return this.getChangeClass("potential");
	}

	get trafficShareClass() {
		return this.getChangeClass("actual");
	}

	get percentageClass() {
		return this.getChangeClass("ratio");
	}

	renderTabs() {
		return (
			<div className="tabs-container">
				<div className="tab">
					<span className="tab-title">{this.trans.total_traffic_potential}</span>
					<div className={this.totalTrafficPotentialClass}>
						<span className="tab-number">{formatNumber(this.totalTrafficPotentialValue)}</span>
						<div className="change">
							<span>{formatNumber.signed(this.totalTrafficPotentialChange)}</span>
							<div className="status-icon">
								<div></div>
								<div></div>
								<div></div>
							</div>
						</div>
					</div>
				</div>
				<div className="tab">
					<span className="tab-title">{this.trans.traffic_share}</span>
					<div className={this.trafficShareClass}>
						<span className="tab-number">{formatNumber(this.trafficShareValue)}</span>
						<div className="change">
							<span>{formatNumber.signed(this.trafficShareChange)}</span>
							<div className="status-icon">
								<div></div>
								<div></div>
								<div></div>
							</div>
						</div>
					</div>
				</div>
				<div className="tab">
					<span className="tab-title">{this.trans.percentage}</span>
					<div className={this.percentageClass}>
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


	renderLeftContent() {
		return (
			<div className={`traffic-box-content ${this.state.refreshing ? 'loading' : ''}`}>
				
				<div className="traffic-title">
					<span className="title">{this.trans.title} </span>
					<Anchor
						title=""
						img={{src: router.url("img/icons/information.svg"), alt: "information icon", class: "asd"}}
						refId="seo-potential-modal"
						className="anchor anchor-info anchor--align-right"
					/>
				</div>
				<p className="traffic-description">{this.trans.description}</p>
				{this.renderTabs()}

				<Anchor
					className="view-calculation potential-math"
					title=""
					refId="seo-traffic-potential-math-modal"
				>
					<span className="percentage-circle"></span>{this.transMisc.show_me_the_math}
				</Anchor>
			</div>
		);
	}

	renderRightContent() {
		return (
			<div className={`traffic-box-graph ${this.state.refreshing ? 'loading' : ''}`}>
				<div className="traffic-box-graph-result">
					<div ref={el => this.chartElement = el} className="chart"></div>
				</div>
			</div>
		);
	}


	renderLeftLoadContent() {
		return (
			<div className="traffic-box-content">
				<Anchor
					title=""
					img={{src: router.url("img/icons/information.svg"), alt: "information icon", class: "asd"}}
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
		);
	}

	renderRightLoadContent() {

		/*
		* Destroys chart in order to reinitialize it when 'renderContent()' runs
		* Fixes chart breaking when selecting a period that has no data
		*/
		this.destroyChart();

		return (
			<div className="traffic-box-graph-result">
				<div ref={el => this.chartElement = el} className="chart"></div>
			</div>
		);
	}

	render() {

		const {data} = this.state;
		const {stats} = this.state;

		return (
            <div className="traffic-box-container">
				{
					(stats && Object.keys(stats).length > 0)
						? this.renderLeftContent()
						: this.renderLeftLoadContent()
				}
				{
					(data && data.length > 0)
						? this.renderRightContent()
						: this.renderRightLoadContent()
				}
			</div>
		);
	}
}

module.exports = SEOPotential;
