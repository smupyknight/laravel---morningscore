const {Component} = require("react");
const PropTypes = require("prop-types");
const socket = require("app/socket");
const env = require("app/services/env");
const assign = require("object-assign");
const trans = require("app/services/i18n").trans;
const EnvData = require("app/api/EnvData");
const console = require("app/services/logger");

class Base extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loaded: false,
            refreshing: false,
        };
    }

    get sort_collection() {
        return this.state.entries;
    }

    get subscriptions() {
        return [
            EnvData.period,
            EnvData.target,
            EnvData.currency,
        ];
    }

    get trans() {
    	return trans('report.components.' + this.name.toLowerCase());
	}

	get transMisc() {
		return trans('report.misc');
	}

    componentDidMount() {
		this._ismounted = true;
        const initialData = this.initialData;

        if (initialData && typeof initialData === "object") {
            this.loadData(initialData);
        }

        this.refresh();

        let subs = this.subscriptions;
        if (subs instanceof Array && subs.length > 0) {
            subs.forEach(pipeline => pipeline.onChange(() => this.refresh()));
        }
    }

	componentWillUnmount() {
		this._ismounted = false;
	}

    refresh() {
        if (this.name !== 'base') {

        	this.setState({refreshing: true});
            console.log(this,this.footprint);

            let payload = socket.toPayload(this.footprint);

            this.payload_id = payload.id;

            console.log(`%cExecuting request to services: ${this.name}`, "font-weight:bold; font-size:16px; color:red", payload);
            socket.request('report_data', payload, (response) => {
                if(response.id === this.payload_id && this._ismounted) {
                    console.log(`%cReceived data for component ${this.name}`, "color:green; font-weight:bold; font-size:16px", response, this.payload_id);
                    this.loadData(response.data);
                } else {
                    console.log(`%cReceived OLD data for component ${this.name} -> Ignoring`, "color:green; font-weight:bold; font-size:16px", response, this.payload_id);
                }
            });
        }
    }

    get initialData() {

    }

    get loaded() {
        return this.state.loaded;
    }

    get name() {
        return 'base';
    }

    get requiredParams() {
        return {
            domain: "domain.domain",
            currency: "user.currency",
            gl: "domain.gl",
            hl: "domain.hl",
            period: "period"
        };
    }

    get footprint() {
        let baseFootprint = {
            "component": this.name,
            "id": Math.floor(Math.random() * 20)
        };

        let requiredParams = this.requiredParams;

        if (typeof requiredParams === "object" && requiredParams != undefined) {
            Object.keys(requiredParams).forEach(key => {
                baseFootprint[key] = env.get(requiredParams[key]);
            });
        }

        return baseFootprint;
    }

    get modifyData() {

	}

    loadData(data) {
        console.log(`%cLoading data into: ${this.name}`, "font-weight:bold; font-size:16px; color:blue", data);
        if (data.error) {
            this.handleError(data.error);
        } else {
        	if (typeof this.modifyData === 'function') data = this.modifyData(data);
            this.setState(assign({}, data, {loaded: true, refreshing: false}), () => this.didLoadData());
        }
    }

    unloadData() {
        this.willUnloadData();
        this.setState({loaded: false});
    }

    didLoadData() {

    }

    handleError(error) {
        console.error('Load data error:', error);
    }

    willUnloadData() {

    }

    headerClicked(e) {
        let {target} = e;

        if (target.nodeName.toLowerCase() !== 'th') {
            target = target.closest('th');
        }

        if (typeof(target) !== 'undefined' && target !== null) {
            let col = target.getAttribute('data-col');
            this.sort(col);
            this.forceUpdate();
        }

    }

    sort(col) {

        if (typeof(this.sort_collection) === 'undefined') {
            console.log('Unable to sort unknown collection', this.sort_collection, this.state);
            return;
        }

        if (typeof(col) !== 'undefined') {
            console.log('Sorting col: ', col, this.sorts);

            if (typeof(this.sorts[col]) === 'undefined') {
                this.sorts = {};
                this.sorts[col] = 'desc';
            } else {
                let newSorts = {};
                newSorts[col] = (this.sorts[col] === 'desc') ? 'asc' : 'desc';
                this.sorts = newSorts;
            }

        }

        console.log('About to sort', this.sorts);

        if (Object.keys(this.sorts).length > 0 && this.sort_collection.length > 0) {
            Object.keys(this.sorts).forEach((column) => {
                let direction = this.sorts[column];
                // console.log(column, this.sorts[column]);
                this.sort_collection.sort((a, b) => {
                    if (typeof(a[column]) !== 'undefined' && typeof(b[column]) !== 'undefined') {

                        let toReturn = 1;
                        if (direction === 'asc') {
                            toReturn = -1;
                        }

                        if (!isNaN(parseFloat(a[column]))) {
                            if (parseFloat(a[column]) < parseFloat(b[column])) {
                                return toReturn;
                            } else {
                                return -toReturn;
                            }
                        } else {
                            // console.log('Sorting string', a[column], b[column], a[column].localeCompare(b[column]), direction);

                            return a[column].localeCompare(b[column]) * -toReturn;
                        }
                    } else {
                        console.log(column, a, b);
                    }
                    return 0;
                });
            });
        }
    }


}

module.exports = Base;
