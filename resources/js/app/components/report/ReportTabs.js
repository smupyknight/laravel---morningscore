const {Component} = require("react");
// const RankProgress = require("app/components/report/RankProgress"); GOING TO BE USED LATER
const TrackedKeywords = require("app/components/report/TrackedKeywords");
const SuggestedKeywords = require("app/components/report/SuggestedKeywords");
const ComingLinks = require ("app/components/coming-soon/ComingLinks");
const ComingOnsite = require("app/components/coming-soon/ComingOnsite");
const Links = require("app/components/report/links/Links");
const Image = require("app/components/mixins/Image");
const trans = require("app/services/i18n").trans;
const router = require("app/services/router");

class ReportTabs extends Component
{
    constructor() {
        super();
        this.state = {
            activeItem: 0,
        };
    }

    get name() {
		return 'report_tabs';
	}

	get trans() {
		return trans('report.components.' + this.name.toLowerCase());
	}
    
    get tabsData () {
        return [
            {
                title: this.trans.tabs.keywords.title,
                description: this.trans.tabs.keywords.desc,
                image: {
                    src: router.url('img/activity-box/tag.svg'),
                    alt: 'tag icon'
                },
            },
            {
                title: this.trans.tabs.links.title,
                description: this.trans.tabs.links.desc,
                image: {
                    src: router.url('img/activity-box/link.svg'),
                    alt: 'link image'
                },
                comingsoon: true
            },
            {
                title: this.trans.tabs.onsite.title,
                description: this.trans.tabs.onsite.desc,
                image: {
                    src: router.url('img/portal/browser.svg'),
                    alt: 'browser icon'
                },
                comingsoon: true
            }
        ];
    }

    handleClick = event => {
        this.setState({ activeItem: event.currentTarget.dataset.id });
    }

    renderTabs = (val, key) => {
        return (
            <li data-id={key} key={key} onClick={this.handleClick} className={ this.state.activeItem == key ? "active" : ""}>
                <div className="tab-content">
                    <div className="tab-icon">
                        <Image 
                            src={val.image.src} 
                            alt={val.image.alt} 
                            scale="1x"    
                        />
                    </div>
                    <div className="tab-text">
                        <div className="tab-title">{val.title}</div>
                        <div className="tab-description">{val.description}</div>
                    </div>
                </div>
            </li>
        );
    }

    render () {
        
        return (
            <div>
                <div className="reports-section-tabs">
                    <div className="reports-section-tabs-title">{this.trans.title}</div>
                    <ul>
                        { this.tabsData.map(this.renderTabs)}
                    </ul>
                </div>
                <div className="report-tabs__content">
                    <div className={ `content-container ${this.state.activeItem == 0 ? "content-active" : ""}`  }  >
                        <TrackedKeywords />
                        <SuggestedKeywords />
                    </div>
					<div className={ `content-container ${this.state.activeItem == 1 ? "content-active" : ""}`  }  >
						<div className="shotout">
							<p>Data provided by</p>
							<img src="img/icons/ahrefs-logo.png"/>
						</div>
						<Links/>
                    </div>
                    <div className={ `content-container ${this.state.activeItem == 2 ? "content-active" : ""}`  }  >
                        <ComingOnsite />
                    </div>
                </div>
            </div>
        );
    }
}



module.exports = ReportTabs;
