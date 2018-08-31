const Modal = require("app/components/modals/main/Modal");
const Infographic = require("app/components/report/InfographicTable");
const trans = require("app/services/i18n").trans;

class SEOPotentialModal extends Modal
{

    get trans() {
        return trans('report.modals.seo_potential');
    }

    renderHeader() {
		return (
            <div>
                <div className="infographics-head">
                    <h2>{this.trans.title}</h2>
                </div>

                <Infographic
                    name='seo_potential'
                />
            </div>
        );
    }
    
    renderContent() {
        null;
    }
}

module.exports = SEOPotentialModal;
