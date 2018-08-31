const Component = require("./Base");
const PropTypes = require("prop-types");
// const socketIOClient = require("socket.io-client");

const logger = require("app/services/logger");

class Test extends Component {
    get name(){
        return 'competitors';
    }

    static get propTypes() {
		return {
            name: PropTypes.string,
			change: PropTypes.number,
			score: PropTypes.number
		};
	}

	static get defaultProps() {
		return {
            name: 'Company name',
			change: 0,
			score: 0
		};
	}

	constructor(props) {
		super(props);
        
        // this.state = {
        //     response: {
        //         'entries':[
        //             {
        //                 'name': 'Company',
        //                 'change': 1,
        //                 'score': 2
        //             },
        //             {
        //                 'name': 'Company',
        //                 'change': 1,
        //                 'score': 0
        //             },
        //             {
        //                 'name': 'Company',
        //                 'change': 1,
        //                 'score': 0
        //             }
        //         ]
        //     }
        // };
    }
    
    renderMessage() {
        return ([
            <div>
                <div>{this.state.response.entries[0].name}</div>
                <div>{this.state.response.entries[0].change}</div>
                <div>{this.state.response.entries[0].score}</div>
            </div>
        ]);
    }

    renderContent() {
        let entriesArray = this.state.response.entries;

        return (
            <div>
                {entriesArray.map((response, index) => (
                    <p key={index}>Name: {response.name}, change: {response.change}!</p>
                ))}
            </div>
        );
    }
    
    render() {
        const {response} = this.state;

        // if(typeof(response.entries) !== 'undefined') {
        //     logger.info("RENDER");
        //     logger.info(response);
        //     logger.info(response.entries);
        //     logger.info(response.entries[0]);
        //     logger.info(this.state);
        // }

        return (
            <div className="test-component" >
                {response
                    ? <span className="done">{this.renderContent()}</span>
                    : <span className="loading">{logger.info('loading')} loading {/*this.renderMessage()*/}</span>
                }
            </div>
        );
    }
}

module.exports = Test;