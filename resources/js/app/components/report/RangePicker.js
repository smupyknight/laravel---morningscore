const {Component} = require("react");
const { DateRange } = require("react-date-range");
const moment = require("moment");
const env = require("app/services/env");
const EnvData = require("app/api/EnvData");
const trans = require("app/services/i18n").trans;
const cookie = require("app/util/cookie");
const router = require("app/services/router");

 
class RangePicker extends Component {

    constructor () {
        super();

		// if valid cookie dates are provided -> overwrite in env
        let range = cookie.get('date_range');
        if (range) {
			range = JSON.parse(range);
			if (
				range.from && range.to
				&& moment(range.from).isValid()
				&& moment(range.to).isValid()
			) {
				env.set('period.from', range.from);
				env.set('period.to', range.to);
			}
		}


        this.state = {
            activePicker: false,
			from: env.get('period.from'),
			to: env.get('period.to'),
        };

    }

    get trans() {
    	return trans('report.misc.date_ranges');
	}

    get predefinedRanges() {
        return {
            [this.trans.today]: {
                startDate: moment(),
                endDate: moment()
            },
            [this.trans.this_week]: {
                startDate: moment().startOf("isoWeek"),
                endDate: moment()
            },
            [this.trans.this_month]: {
                startDate: moment().startOf("month"),
                endDate: moment()
            },
            [this.trans.this_year]: {
                startDate: moment().startOf("year"),
                endDate: moment()
            },
            [this.trans.yesterday]: {
                startDate: moment().subtract(1, "day").startOf("day"),
                endDate: moment().subtract(1, "day").endOf("day")
            },
            [this.trans.last_week]: {
                startDate: moment().subtract(1, "week").startOf("isoWeek"),
                endDate: moment().subtract(1, "week").endOf("isoWeek"),
            },
            [this.trans.last_month]: {
                startDate: moment().subtract(1, "month").startOf("month"),
                endDate: moment().subtract(1, "month").endOf("month"),
            },
            [this.trans.last_year]: {
                startDate: moment().subtract(1, "year").startOf("year"),
                endDate: moment().subtract(1, "year").endOf("year")
            },
        };
    }

    get display_val() {
    	let {from} = this.state;
    	let {to} = this.state;
		let ranges = this.predefinedRanges;

		for (let key in ranges) {
			if (
				ranges[key].startDate.isSame(from, 'day')
				&& ranges[key].endDate.isSame(to, 'day')
			) {
				return key;
			}
		}

    	let format = 'DD[.]MM[.]YYYY';
		let display_val =	moment(from).format(format) +
							' - ' +
							moment(to).format(format);

    	if (from === to) {
    		display_val = moment(from).format(format);
		}

		return display_val;
	}

    get theme() {
        return {
            DateRange: {
                width: "500px",
                background: "none",
                position: "relative",
                top: "-68px",
            },
            Calendar: {
                width: "250px",
                height: "100%",
                position: "relative",
                top: "-42px",
                borderRadius: "0",
                padding: "20px",
            },
            MonthAndYear: {
                font: "bold .9em Gotham, sans-serif",
                color: "#3498DB"
            },
            Weekday: {
                color: "#777"
            },
            Day: {
                transition: "all .1s ease-out",
                font: "Gotham, sans-serif"
            },
            DayInRange: {
                background: "#E2EBF7"
			},
			DayPassive: {
				cursor: "default"
			},
            DayHover: {
                background: "#E2EBF7",
            },
            DaySelected: {
                background: "#3498DB",
            },
            DayActive: {
                background: "#3498DB",
                boxShadow: "none",
                transform: "scale(0.8)",
            },
            PredefinedRanges: {
                background: "#FFF",
                position: "relative",
                top: "310px",
                width: "100%",
                display: "flex",
                flexWrap: "wrap",
                flexBasis: "25%",
                verticalAlign: "none",
                paddingBottom: "7px",
            },
            PredefinedRangesItem: {
                background: "none",
                font: "Gotham, sans-serif",
                fontWeight: "500",
                fontSize: "14px",
                color: "#B0BAC8",
                flexBasis: "25%",
                textAlign: "center",
                padding: "10px 0 0 0"
            },
            PredefinedRangesItemActive: {
                color: "#3498DB",
            }

        };
    }


    handleClick = () => {
        this.setState({ 
            activePicker: !this.state.activePicker
        });
    }

    handleChange = (range) => {

        var startDate = moment(range.startDate._d).utc().startOf("day").toISOString();
        var endDate = moment(range.endDate._d).utc().startOf("day").toISOString();
        var dateRange;
        if (startDate === endDate) {
            dateRange = {
                from: startDate,
                to: endDate
            };
        } else {
            startDate = moment(range.startDate._d).utc().startOf("day").add(1, "d").toISOString();
            dateRange = {
                from: startDate,
                to: endDate
            };
        }
        
        this.setState({from: dateRange.from, to: dateRange.to}, () => {
        	env.set('user.display_period', this.display_val);
		});
        EnvData.period.update(dateRange);

        cookie.set('date_range', JSON.stringify(dateRange), 1/24, false);
    }

    renderDatePicker() {
    	let {from} = this.state;
    	let {to} = this.state;

        return (
            
            <div className={ `range-picker ${this.state.activePicker ? "active-picker" : ""}` }>
                <div className="carret"></div>
                <DateRange

                    startDate = { moment(from).format("DD/MM/YYYY").toString() }
                    endDate = { moment(to).format("DD/MM/YYYY").toString() }

                    minDate = { moment("02-20-2018", "MM-DD-2018") }
                    maxDate = { moment() }

                    firstDayOfWeek = { 1 }
                    ranges = { this.predefinedRanges }
                    linkedCalendars = { true }
                    theme = { this.theme }

                    onInit = { this.handleChange }
                    onChange = { this.handleChange }
                />
                
            </div>
            
        );
    }

    render(){
        return (
            <div>
                <div onClick={ this.handleClick } className="range-picker-trigger-container">
                    <p>{this.display_val}</p> 
                    <img src={router.url("img/icons/sort-grey.svg")} className="range-picker-icon range-picker-icon-grey" />
                    <img src={router.url("img/icons/sort.svg")} className="range-picker-icon range-picker-icon-white" />
                </div>
                <div className=
                    { `overlay ${this.state.activePicker ? "active-picker" : ""}`} 
                    onClick={ this.handleClick }>
                </div>
                { this.renderDatePicker() }
            </div>
        );
    }
}
 

module.exports = RangePicker;
