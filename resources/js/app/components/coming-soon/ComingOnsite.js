const Component = require("app/components/coming-soon/ComingBase"); 
const setLaunchDate = require ("app/util/setLaunchDate");
const router = require("app/services/router");

class ComingOnsite extends Component
{
	get name() {
		return 'coming_onsite';
    }
    
    
    

    render () {
        return (
            <div className="coming-onsite">
                <div className="coming-onsite__info">
                    <div className="coming-onsite__info__description">
                        <div className="coming-soon"><span>{this.cs.title.toUpperCase()}</span> Version <b>1.0 ·</b> Stay crafty</div>
                        <h2>{this.trans.title}<br/>{this.trans.subtitle}</h2>
                        <p>
                        	{this.trans.desc_1}
                        </p>
                        <p>
                        	{this.trans.desc_2}
                            <a href="http://morningscore.io/roadmap" target="_blank" className="roadmap-link">{this.transMisc.see_more}</a>
                        </p>
                    </div>
                    <hr/>
                    <div className="coming-onsite__info__time-to-release">
                        <img src={router.url("img/figures/spaceman-round.svg")} alt="seo-spaceman"/>
                        <p>
                            <span>
                                {this.cs.spaceman}&nbsp;
                            </span> 
                            {this.cs.desc} {this.cs.expect}:&nbsp;
                            <span className="highlight">
                                {setLaunchDate("September 27, 2018 10:00:00", "days")}&nbsp;
                                {this.cs.days}
                            </span>
                        </p>
                    </div>
                </div>
                <div className="activity-box">
                <div className="activity-box-title-container">
                    <div className="activity-box-title">
                        <h5>{this.trans.table.activity}</h5>
                        <div className="more-info-line">
                            {/* <span>Need more information?</span> <a href="#" title="">change your plan now</a> */}
                        </div>
                    </div>
                    <div className="time-hours">
                        <span>32</span>
                        <span>/{this.trans.table.hours}</span>
                    </div>
                </div>
                <div className="activity-box-content-wrapper">
                    <ul className="activity-box-content-container">
                        <li>
                            <div className="activity-box-content">
                                <div className="activity-box-content-icon">
                                    <img src={router.url("img/activity-box/page.svg")} alt="new page icon"/>
                                </div>
                                <div className="activity-box-content-text">
                                    <span>3 {this.trans.table.new_pages}</span>
                                    <span>1 hour ago</span>
                                </div>
                            </div>
                            <div className="information-icon" title="More information">
                                <img src={router.url("img/icons/information.svg")} alt="information icon"/>
                            </div>
                        </li>
                        
                        <li>
                            <div className="activity-box-content">
                                <div className="activity-box-content-icon">
                                    <img src={router.url("img/activity-box/link.svg")} alt="link icon"/>
                                </div>
                                <div className="activity-box-content-text">
                                    <span>12 {this.trans.table.new_links}</span>
                                    <span>2 hours ago</span>
                                </div>
                            </div>
                            <div className="information-icon" title="More information">
                                <img src={router.url("img/icons/information.svg")} alt="information icon"/>
                            </div>
                        </li>
                    
                        <li>
                            <div className="activity-box-content">
                                <div className="activity-box-content-icon">
                                    <img src={router.url("img/activity-box/tag.svg")} alt="tag icon"/>
                                </div>
                                <div className="activity-box-content-text">
                                    <span>21 {this.trans.table.new_meta}</span>
                                    <span>3 hours ago</span>
                                </div>
                            </div>
                            <div className="information-icon" title="More information">
                                <img src={router.url("img/icons/information.svg")} alt="information icon"/>
                            </div>
                        </li>
                        <li>
                            <div className="activity-box-content">
                                <div className="activity-box-content-icon">
                                    <img src={router.url("img/activity-box/page.svg")} alt="new page icon" />
                                </div>
                                <div className="activity-box-content-text">
                                    <span>3 {this.trans.table.new_pages}</span>
                                    <span>1 hour ago</span>
                                </div>
                            </div>
                            <div className="information-icon" title="More information">
                                <img src={router.url("img/icons/information.svg")} alt="information icon" />
                            </div>
                        </li>
                        <li>
                            <div className="activity-box-content">
                                <div className="activity-box-content-icon">
                                    <img src={router.url("img/activity-box/link.svg")} alt="link icon"/>
                                </div>
                                <div className="activity-box-content-text">
                                    <span>12 {this.trans.table.new_links}</span>
                                    <span>2 hours ago</span>
                                </div>
                            </div>
                            <div className="information-icon" title="More information">
                                <img src={router.url("img/icons/information.svg")} alt="information icon" />
                            </div>
                        </li>
                        <li>
                            <div className="activity-box-content">
                                <div className="activity-box-content-icon">
                                    <img src={router.url("img/activity-box/tag.svg")} alt="tag icon" />
                                </div>
                                <div className="activity-box-content-text">
                                    <span>21 {this.trans.table.new_meta}</span>
                                    <span>3 hours ago</span>
                                </div>
                            </div>
                            <div className="information-icon" title="More information">
                                <img src={router.url("img/icons/information.svg")} alt="information icon" />
                            </div>
                        </li>
                        <li>
                            <div className="activity-box-content">
                                <div className="activity-box-content-icon">
                                    <img src={router.url("img/activity-box/page.svg")} alt="new page icon" />
                                </div>
                                <div className="activity-box-content-text">
                                    <span>3 {this.trans.table.new_pages}</span>
                                    <span>1 hour ago</span>
                                </div>
                            </div>
                            <div className="information-icon" title="More information">
                                <img src={router.url("img/icons/information.svg")} alt="information icon" />
                            </div>
                        </li>
                        <li>
                            <div className="activity-box-content">
                                <div className="activity-box-content-icon">
                                    <img src={router.url("img/activity-box/link.svg")} alt="link icon"/>
                                </div>
                                <div className="activity-box-content-text">
                                    <span>12 {this.trans.table.new_links}</span>
                                    <span>2 hours ago</span>
                                </div>
                            </div>
                            <div className="information-icon" title="More information">
                                <img src={router.url("img/icons/information.svg")} alt="information icon" />
                            </div>
                        </li>
                        <li>
                            <div className="activity-box-content">
                                <div className="activity-box-content-icon">
                                    <img src={router.url("img/activity-box/tag.svg")} alt="tag icon" />
                                </div>
                                <div className="activity-box-content-text">
                                    <span>21 {this.trans.table.new_meta}</span>
                                    <span>3 hours ago</span>
                                </div>
                            </div>
                            <div className="information-icon" title="More information">
                                <img src={router.url("img/icons/information.svg")} alt="information icon" />
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
            
        );
    }
}

module.exports = ComingOnsite;
