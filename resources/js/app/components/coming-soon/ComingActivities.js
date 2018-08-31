const Component = require("app/components/coming-soon/ComingBase"); 
const Image = require("app/components/mixins/Image");
const setLaunchDate = require("app/util/setLaunchDate");
const router = require("app/services/router");

class ComingActivities extends Component
{
	get name() {
		return 'coming_activities';
	}

    get rowsData() {
        return [
            {   
                activity: "3 new pages",
                time: "1 hour ago",
                img: {
                    src: router.url("img/activity-box/page.svg"),
                    alt: "pages"
                }
            },
            {   
                activity: "3 new pages",
                time: "1 hour ago",
                img: {
                    src: router.url("img/activity-box/page.svg"),
                    alt: "pages"
                }
            },
            {   
                activity: "3 new pages",
                time: "1 hour ago",
                img: {
                    src: router.url("img/activity-box/page.svg"),
                    alt: "pages"
                }
            },
            {   
                activity: "12 new links created",
                time: "2.5 hours ago",
                img: {
                    src: router.url("img/activity-box/link.svg"),
                    alt: "links"
                }
            },
        ];
    }

    renderRows = (val, key) => {
        return (
            <tr key={ key }>
                <td>
                    <div>
                        <div className="activity-icon-wrapper">
                            <Image
                                src={ val.img.src } 
                                alt={ val.img.alt }
                                scale="1x"
                                className="activity-icon"
                            />
                        </div>
                        <div className="activit-description-wrapper">
                            <p>{ val.activity }</p>
                            <p>{ val.time }</p>
                        </div>
                    </div>
                    <Image
                        src={router.url("img/icons/information.svg")}
                        alt="info"
                        scale="1x"
                        className="info-icon"
                    />
                </td>
            </tr>
        );
    }

    render () {
        return (
            <div className="coming-activities">
                <div className="coming-activities__info">
                    <div className="coming-activities__info__description">
                        <div className="coming-soon"><span>{this.cs.title.toUpperCase()}</span> Version <b>1.0 ·</b> Stay crafty</div>
                        <h2>{this.trans.title}</h2>
                        <p>{this.trans.desc_1}</p>
                        <a href="http://morningscore.io/roadmap" target="_blank" className="roadmap-link">{this.transMisc.see_more}</a>
                    </div>
                    <hr/>
                    <div className="coming-activities__info__time-to-release">
                        <Image
                            src={router.url("img/figures/spaceman-round.svg")}
                            alt="seo-spaceman"
                            scale="1x"
                        />
                        <p>
                            <span>
                                {this.cs.spaceman}&nbsp;
                            </span> 
                            {this.cs.desc} {this.cs.expect}:&nbsp;
                            <span className="highlight">
                                {setLaunchDate("November 23, 2018 10:00:00", "days")}&nbsp;
                                {this.cs.days}
                            </span>
                        </p>
                    </div>
                </div>
                <div className="coming-activities__table">
                    <table>
                        <tbody>
                        {/* THIS IS TEMPORARY DATA UNTIL THE LOGIC HAS BEEN MADE.
                        THIS IS BETTER THAN SHOWING DUMMY CONTENT THAT LOOKS LIKE REAL DATA */}
                            <tr>
                                <td>
                                    <div>
                                        <div className="dummyIcon"></div>
                                        <div className="activit-description-wrapper">
                                            <div className="dummyTitle"></div>
                                            <div className="dummyDesc"></div>
                                        </div>
                                    </div>
                                    <div className="dummyInfo"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <div className="dummyIcon"></div>
                                        <div className="activit-description-wrapper">
                                            <div className="dummyTitle long"></div>
                                            <div className="dummyDesc"></div>
                                        </div>
                                    </div>
                                    <div className="dummyInfo"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <div className="dummyIcon"></div>
                                        <div className="activit-description-wrapper">
                                            <div className="dummyTitle medium"></div>
                                            <div className="dummyDesc"></div>
                                        </div>
                                    </div>
                                    <div className="dummyInfo"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <div className="dummyIcon"></div>
                                        <div className="activit-description-wrapper">
                                            <div className="dummyTitle"></div>
                                            <div className="dummyDesc"></div>
                                        </div>
                                    </div>
                                    <div className="dummyInfo"></div>
                                </td>
                            </tr>

                        {/* TEMPORARY DATA OVER */}

                            {/* this.rowsData.map(this.renderRows) */}
                        </tbody>
                    </table>
                </div>
                <div className="coming-activities__additional-description">
                        <p>
                        	{this.trans.desc_2}
                        </p>
                        <p>
                        	{this.trans.desc_3}
                        </p>
                </div>
            </div>
        );
    }
}

module.exports = ComingActivities;
