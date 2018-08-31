const Component = require("app/components/coming-soon/ComingBase"); 
const Image =  require("app/components/mixins/Image");
const setLaunchDate = require("app/util/setLaunchDate");
const router = require("app/services/router");

class ComingLinks extends Component {
	get name() {
		return 'coming_links';
	}

    get rowsData() {
        return [
            {
                link: "bureaubureau.dk/bureauer/morning-train",
                percentage: 55,
            },
            {
                link: "jobindex.dk/jobsoegning/salg",
                percentage: 23
            },
            {
                link: "cphbusiness.dk/studerende/studierabatter",
                percentage: 3
            },
            {
                link: "nemprogrammering.dk/wp/lokal-seo",
                percentage: 8
            },
            {
                link: "bryllupsklar.dk/bryllupsfest/bestil-blomster-online",
                percentage: -2
            },
            {
                link: "business.dk/specialiseret-i-quality-control-systems",
                percentage: 4
            }
        ];
    }

    handleLink = link => {
        if (link.length > 42) {
            link = link.slice(0, 42) + "...";
            return link;
        }
        return link;
    }

    calculateArrowsAmount = percentage => {
        if (percentage >= 45) {
            return 4;
        }
        else if (percentage >= 0 && percentage < 5) {
            return 1;
        }
        else if (percentage < 0) {
            return 0;
        }
        else {
            return Math.round(percentage / 10);
        }
    }

    renderArrows = percentage => {
        let arrows = [];
        let arrowState = "";
        let activeArrows = this.calculateArrowsAmount(percentage);

        for (let i = 0; i < 4; i++) {
            activeArrows > 0 ? arrowState = "active" : arrowState = "";

            arrows.push(<div key={i} className={ arrowState }></div>);
            activeArrows--;
        }
        return arrows;
    }

    renderRows = (val, key) => {
        return (
            <tr key={key} className={ this.calculateArrowsAmount(val.percentage) > 0 ? `increasing` : `` }>
                <td><p>{ this.handleLink(val.link) }</p></td>
                <td><p>{ val.percentage + `%`}</p></td>
                <td>
                    <div className="status-icon">
                        { this.renderArrows(val.percentage) }
                    </div>
                </td>
            </tr>
        );
    }

    render() {
        return (
            <div className="coming-links">
                <div className="coming-links__info">
                    <div className="coming-links__info__description">
                        <div className="coming-soon"><span>{this.cs.title.toUpperCase()}</span> Version <b>1.0 ·</b> Stay crafty</div>
                        <h2>{this.trans.title}</h2>
                        <p>{this.trans.desc_1}</p>
                        <p>
							              {this.trans.desc_2}<br/>
                            <a href="http://morningscore.io/roadmap" target="_blank" className="roadmap-link">{this.transMisc.see_more}</a>
                        </p>
                    </div>
                    <hr/>
                    <div className="coming-links__info__time-to-release">
                        <Image
                            src={router.url("img/figures/spaceman-round.svg")}
                            alt="seo-spaceman"
                            scale="1x"
                        />
                        <p>
                            <span>
                                {this.cs.spaceman}
                            </span>&nbsp;
                            {this.cs.desc} {this.cs.expect}:&nbsp;
                            <span className="highlight">
                                {setLaunchDate("March 28, 2018 10:00:00", "days")}&nbsp;
                                {this.cs.days}
                            </span></p>
                        
                    </div>
                </div>
                <div className="coming-links__table">
                    <h3>{this.trans.table.title}</h3>
                    <div className="coming-links__table_wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <td><h6>{this.trans.table.link}</h6></td>
                                    <td><h6>{this.trans.table.percentage}</h6></td>
                                    <td><h6>{this.trans.table.change}</h6></td>
                                </tr>
                            </thead>
                            <tbody>
                                { this.rowsData.map(this.renderRows) }
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        );
    }
}

module.exports = ComingLinks;
