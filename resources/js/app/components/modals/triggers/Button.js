const Trigger = require("app/components/modals/main/Trigger");
const PropTypes = require("prop-types");
const assign = require("object-assign");

class Button extends Trigger {
    static get propTypes() {
        return assign({}, super.propTypes, {
            content: PropTypes.string.isRequired,
            class: PropTypes.string,
        });
    }

    static get defaultProps() {
        return {
            class: 'button white',
        };
    }

    render () {
        return (
            <button onClick={this.open} className={this.props.class}>{this.props.content}</button>
        );
    }
}

module.exports = Button;
