const {Component} = require("react");
const ReactModal = require("react-modal");
const PropTypes = require("prop-types");
const queryObject = require("app/util/queryObject");
const scroll = require("app/util/scroll");
const Image = require("app/components/mixins/Image");
const router = require("app/services/router");

ReactModal.setAppElement('body');

class Modal extends Component {

    static get propTypes() {
        return {
            startOpen: PropTypes.bool,
            modalContainerClass: PropTypes.string,
        };
    }

    static get defaultProps() {
        return {
            startOpen: false,
            sizeClass: "",
            modalContainerClass: ""
        };
    }

    constructor(props) {
        super(props);
        this.state = {
            showModal: this.props.startOpen,
            options: null,
        };
    }

    get className() {
        return "modal-wrapper";
    }

    getOptions(query, defaults) {
        return queryObject(this.state.options, query, defaults);
    }

    handleOpenModal = (e) => {
        e.preventDefault();
        this.setState({showModal: true});
    }

    handleCloseModal = (e) => {
        e.preventDefault();

        this.setState({showModal: false});
    }

    open(state = null) {
        if (state != null) {
            this.setState({options: state});
        }
        this.setState({showModal: true});
    }

    openTo(el) {
        this.setState({showModal: true}, () => {
            let e = this.bodyElement.querySelector('#' + el),
                position = e.offsetTop;

            scroll.animateScroll([this.bodyElement], position);

            // setTimeout(() => {
            //     e.scrollIntoView({behavior: 'smooth', block: 'start'});
            // }, 800);
        });
    }

    close() {
        this.setState({showModal: false});
    }

    render() {

        return (
            <ReactModal
                isOpen={this.state.showModal}
                contentLabel="onRequestClose Example"
                onRequestClose={this.handleCloseModal}
                shouldCloseOnOverlayClick={true}
                className={"modal-content " + this.props.sizeClass}
                overlayClassName="modal-overlay"
                closeTimeoutMS={300}
            >
                <div ref={el => this.bodyElement = el} className={this.className}>
                    <img onClick={() => this.close()} src={router.url("img/icons/close.svg")} alt="close-icon" className="close-icon"/>
                    {this.renderHeader()}
                    <div className={'modal-container ' + this.props.modalContainerClass}>
                        {this.renderContent()}
                    </div>
                </div>
                <div className="dot-pattern">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 35 35" enableBackground="new 0 0 50 50" xmlSpace="preserve" preserveAspectRatio="none slice"></svg>
                </div>
                <div className="plus-pattern">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 35 35" enableBackground="new 0 0 50 50" xmlSpace="preserve" preserveAspectRatio="none slice"></svg>
                </div>
            </ReactModal>
        );
    }
}

module.exports = Modal;
