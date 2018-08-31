const Component = require("app/components/report/Base");
const EnvData = require("app/api/EnvData");

class LinksBase extends Component {

	get name() {
		return '';
	}

    get subscriptions() {
        return [
            EnvData.period,
            EnvData.target,
        ];
    }

    handleLink = link => {
        if (link.length > 42) {
            link = link.slice(0, 42) + "...";
            return link;
        }
        return link;
    }

    calculateArrowsAmount = strength => {
    	let val;

    	switch (true) {
			case (strength >= 70):
				val = 4;
				break;
			case (strength >= 50):
				val = 3;
				break;
			case (strength >= 30):
				val = 2;
				break;
			case (strength >= 5):
				val = 1;
				break;
			default:
				val = 0;
		}
		return val;
    }

    renderArrows = strength => {
        let arrows = [];
        let arrowState = "";
        let activeArrows = this.calculateArrowsAmount(strength);

        for (let i = 0; i < 4; i++) {
            activeArrows > 0 ? arrowState = "active" : arrowState = "";

            arrows.push(<div key={i} className={ arrowState }></div>);
            activeArrows--;
        }
        return arrows;
    }

    renderRows = (val, key) => {
        return (
            <tr key={key} className={ this.calculateArrowsAmount(val.strength) > 0 ? `increasing` : `` }>
				{/*<td><a href={`\/\/${val.link}`} target="_blank">{ this.handleLink(val.link) }</a></td>*/}
				<td>{this.handleLink(val.link)}</td>
                <td>
                    <div className="status-icon">
						<span className="tooltip">{val.strength}</span>
                        { this.renderArrows(val.strength) }
                    </div>
                </td>
            </tr>
        );
    }

	

	render() {

		if (this.state[this.name] && this.state[this.name].length > 0) {
			return this.renderContent(this.state[this.name]);
		}
		return this.renderFallback();
	}

}

module.exports = LinksBase;
