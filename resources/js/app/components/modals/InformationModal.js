const Modal = require("app/components/modals/main/Modal");
const PropTypes = require("prop-types");
const assign = require("object-assign");
const Infographic = require("app/components/report/InfographicTable");
const trans = require("app/services/i18n").trans;
const router = require("app/services/router");

class InformationModal extends Modal 
{
    static get propTypes() {
        return assign({}, super.propTypes, {
            videoUrl: PropTypes.string, 
            videoUrlAutoplay: PropTypes.string,
        });
    }
    
    static get defaultProps () {
        return assign({}, super.defaultProps, {
            videoUrlAutoplay: "https://www.youtube-nocookie.com/embed/Ypq97f0Eoeo?controls=0&amp;disablekb=1&amp;fs=0&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;iv_load_policy=3&amp;autoplay=1",
        });
    }
    
    constructor (props) {
        super(props);
        this.state = assign({}, this.state, {
            playing: false,
            videoUrl: props.videoUrl 
        });
    }

    get trans() {
        return trans('report.modals.current_morningscore');
    }

    get className() 
    {
        let classList = [super.className, "information-modal", "video-modal"];
        return classList.join(' ');
    }

    
    renderHeader() {
        return (
			<div>
				<div className="information-modal-header">
					<div className="information-modal-header-video">       
						<iframe 
							width="100%" 
							height="100%" 
							src="https://www.youtube-nocookie.com/embed/Ypq97f0Eoeo?controls=1&amp;disablekb=1&amp;fs=1&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;iv_load_policy=3&amp;autoplay=0">
						</iframe>
					</div>
				</div>

                <div className="infographics-body">
                    <h2>{this.trans.title_1}</h2>

                    <div className="current_morningscore--first">
                        <div>{this.trans.left}</div>
                        <div>{this.trans.center}</div>
                        <div>{this.trans.right}</div>
                    </div>
                    <img src={router.url(this.trans.img1)} alt={this.trans.title_1} />
					<br/><br/>
					<h2>{this.trans.title_2}</h2>
					
                    <img src={router.url(this.trans.img2)} alt={this.trans.title_2} />
					<br/><br/><br/><br/>
                    <h2>{this.trans.title_3}</h2>
                </div>

                <Infographic
                    name='current_morningscore'
                />
            </div>
        );
    }
    
 renderContent() {
        null;
    }
}

module.exports = InformationModal;
