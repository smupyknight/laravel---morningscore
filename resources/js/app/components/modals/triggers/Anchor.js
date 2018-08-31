const Trigger = require("app/components/modals/main/Trigger");
const Image = require("app/components/mixins/Image");
const PropTypes = require("prop-types");
const assign = require("object-assign");
const {pluckKeysExcept} = require("app/util/object");

class Anchor extends Trigger {
    static get propTypes() {
        return assign({}, super.propTypes, {
            title: PropTypes.string.isRequired,
            href: PropTypes.string,
            data: PropTypes.object,
            
            // Img content
            img: PropTypes.shape({
              src: PropTypes.string,
              alt: PropTypes.string,
            }),
            // Or text
            content: PropTypes.string,
        });
    }

    static get defaultProps() {
        return {
            href: '#',
        };
    }
    
    get modalState() {
        if (this.props.data) {
            return this.props.data;
        }
    }

    renderContent() {
        const p = this.props;
        if (p.img) {
            return (
                <Image src={p.img.src} alt={p.img.alt} />
            );
        } else if (p.content) {
            return (p.content);
        } else {
            return (this.props.children);
        }
    }

    render () {
        const p = this.props;
        const propsToAssign = pluckKeysExcept(this.props, ['refId', 'img', 'openToId']);
        return (
            <a {...propsToAssign}
                onClick={this.open}
                href={p.href}
                title={p.title}
            >
                {this.renderContent()}
            </a>
        );
    }
}

module.exports = Anchor;
