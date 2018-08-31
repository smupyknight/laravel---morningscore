const Form = require("app/components/forms/Form");
const csrfToken = require("app/services/csrfToken");
const env = require("app/services/env");
const EnvApi = require("app/api/EnvData");
const assign = require("object-assign");
const PropTypes = require("prop-types");

class RemoveKeyword extends Form {
    static get propTypes() {
        return assign({}, super.propTypes, {
            keyword: PropTypes.string.isRequired,
        });
    }

    get name() {
    	return 'remove_kw';
	}

    performSubmit(form) {
        if (this.beforeSubmit() === false) {
			return;
		}
        return EnvApi.keywords.remove.run(this.buildPayload(form))
            .then(response => {
                this.onComplete(response);
                return response;
            })
            .catch(error => {
                this.onError(error.response.data);
            });
    }
    
    renderForm() {
		return (
			<form onSubmit={this.onSubmit}>
				<input type="hidden" name="_token" value={csrfToken()}/>
				<input type="hidden" name="keyword" value={this.props.keyword}/>
				<input type="hidden" name="domain_id" value={env.get('domain.id')}/>
                <div className="submit-container submit-container--buttons-spacing">
                    <button type="button" onClick={this.onCancel} className="button button--extra-mr white">{this.trans.cancel}</button>
                    <input type="submit" name="" value={this.trans.submit} className="button" />
                </div>
			</form>
		);
	}
}

module.exports = RemoveKeyword;
