const Component = require("./Base");
const PropTypes = require("prop-types");
const formatNumber = require("../../util/formatNumber");
const formatChange = require("../../util/formatChange");
// const socketIOClient = require("socket.io-client");
const logger = require("app/services/logger");
const env = require("app/services/env");
const competitorColors = require("app/util/competitorColors");
const Button = require("app/components/modals/triggers/Button");
const EnvData = require("app/api/EnvData");
const formatURL = require("app/util/formatURL");
const assign = require("object-assign");
const Anchor = require("app/components/modals/triggers/Anchor");
const renderer = require("app/services/renderer");


class Competitors extends Component {
    get name() {
        return 'competitors';
    }

    get requiredParams() {
        return assign({}, super.requiredParams, {
            competitors: "domain.competitors.domains",
        });
    }

	get subscriptions() {
		return super.subscriptions.concat([
			EnvData.competitors,
		]);
	}

    styles(domain) {
        return {
            backgroundColor: competitorColors(domain)
        };
    }

	handleError(error) {
		this.setState({entries:undefined, refreshing: false});
	}

    renderExtraRows(n) {
        var extraRows = [];

        for (var i = 0; i < 3 - n; i++) {
            extraRows.push(
                <tr key={i} className="no-borders">
                    <td>
                        <div>
                            <div>&nbsp;</div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div>&nbsp;</div>
                        </div>
                    </td>
                    <td className="no-background">
                        <div>
                            <div>&nbsp;</div>
                        </div>
                    </td>
                </tr>
            );
        }

        return extraRows;
    }

    renderContent() {
        const {entries} = this.state;
		const {currency} = this.state;
		const domainsList =  env.get("domain.competitors.domains");
		
        return (
            <table>
                <thead>
                <tr>
                    <td>{this.trans.name}</td>
                    <td>Morningscore</td>
                    <td>{this.trans.change_in} {currency}</td>
                </tr>
                </thead>
                <tbody>
                {entries.map((entry, index) => (
					<tr key={index}>
							<td>
								<div className="company-name">
									<span 
										style={this.styles(entry.domain)} 
										className="company-color">
									</span>
									<span>
										{formatURL(entry.domain)}
									</span>
								</div>
							</td>

							{ 
								entry.score === 0 
									? <td>—</td>
									: <td>
										{formatNumber(entry.score)} <span>{currency}</span>
									  </td>
							}

							<td>
								{formatChange(entry.change)} <span>{currency}</span>
                                <Anchor data={{domainsList: domainsList, domainIndex: domainsList.indexOf(entry.domain)}}
									title="Se udregningen"
									refId="competitors-math-modal"
								>
									<div className="competitor-math-trigger">
										<p>See math</p>
									</div>
								</Anchor>
								
							</td>
							
					</tr>
					
				))}
				
                {this.renderExtraRows(entries.length)}
                </tbody>
            </table>
        );
    }

    getFallback() {
        if (!(env.get('domain.competitors.domains').length > 0)) {
            return this.renderAddCompetitors();
        }
        return this.renderLoadContent();
    }

    renderAddCompetitors() {
        return (
            <div className="add-competitors-container">
            <h3>{this.trans.add}</h3>
                <Button
                    content={this.trans.button}
                    class="button add-keyword"
                    refId="settings-modal"
                    openToId="competitors-settings-form"
                />
                
            </div>
        );
    }

    renderLoadContent() {
        const emptyArray = ['', '', ''];

        return (
            <table>
                <thead>
                <tr>
                    <td>{this.trans.name}</td>
                    <td>Morningscore</td>
                    <td>{this.trans.change_in}</td>
                </tr>
                </thead>
                <tbody>
                {emptyArray.map((response, index) => (
                    <tr key={index}>
                        <td>
                            <div className="loading-data">
                                <div></div>
                            </div>
                        </td>
                        <td>
                            <div className="loading-data">
                                <div></div>
                            </div>
                        </td>
                        <td>
                            <div className="loading-data">
                                <div></div>
                            </div>
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>
        );
    }

    render() {
		const {entries} = this.state;
        return (
            <div className={`competitor-box-wrapper ${this.state.refreshing ? 'loading' : ''}`}>
                {(entries && entries.length > 0) ? this.renderContent() : this.getFallback()}
            </div>
        );
    }
}

module.exports = Competitors;
