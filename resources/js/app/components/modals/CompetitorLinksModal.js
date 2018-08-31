const Modal = require("app/components/modals/main/Modal");
const Infographic = require("app/components/report/InfographicTable");
const trans = require("app/services/i18n").trans;

class CompetitorLinksModal extends Modal
{

    get trans() {
        return trans('report.modals.competitor_links');
    }

    renderHeader() {
		return (
            <div>
                <div className="infographics-head">
                    <h2>{this.trans.title}</h2>
                </div>

                <Infographic
                    name='competitor_links'
                />
            </div>
        );
    }
    
    renderContent() {
        null;
    }
}

module.exports = CompetitorLinksModal;