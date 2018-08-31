const Modal = require("app/components/modals/main/Modal");
const Infographic = require("app/components/report/InfographicTable");
const trans = require("app/services/i18n").trans;

class SuggestedKeywordsModal extends Modal
{

    get trans() {
        return trans('report.modals.suggested_keywords');
    }

    renderHeader() {
		return (
            <div>
                <div className="infographics-head">
                    <h2>{this.trans.title}</h2>
                </div>

                <Infographic
                    name='suggested_keywords'
                />
            </div>
        );
    }
    
    renderContent() {
        null;
    }
}

module.exports = SuggestedKeywordsModal;
