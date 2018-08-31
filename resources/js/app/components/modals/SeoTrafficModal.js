const Modal = require("app/components/modals/main/Modal");
const PropTypes = require("prop-types");
const assign = require("object-assign");
const Image = require("app/components/mixins/Image");

class SeoTrafficModal extends Modal
{
    

    renderHeader() {
		return (
            <div>
                <div className="information-modal-infographic">
                    <div className="modal-title">
                        <h2>SEO Potential Explanation</h2>
                    </div>
                    <img src={router.url("img/infographics/seo-potential-explainer.svg")} alt="SEO infographic" />
                </div>
            </div>
        );
    }
    
    renderContent() {
        null;
    }


}

module.exports = SeoTrafficModal;
