const {Component} = require("react");
const LinksCompetitors = require('app/components/report/links/LinksCompetitors');
const NewLinks = require('app/components/report/links/links-activity/NewLinks');
const LostLinks = require('app/components/report/links/links-activity/LostLinks');
const AllLinks = require("app/components/report/links/AllLinks");


class Links extends Component{
	
	render() {
		return (
			<div>
				<LinksCompetitors/>
				<div className="links-activity-container">
					<NewLinks/>
					<LostLinks/>
				</div>
				<AllLinks/>
			</div>
		);
	}
}

module.exports = Links;
