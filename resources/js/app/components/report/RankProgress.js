// NOT IN USE

const Component = require("app/components/report/Base");

class RankProgress extends Component {
     
    render() {
        return (
            <div className="rank-progress">
                <div className="rank-progress-title-container">
                    <div className="rank-progress-title">
                        <h5>KEYWORD RANK PROGRESS</h5>
                        <div className="rank-progress-title-description">What's your overall keyword ranking and how do you compare to your competitors?</div>
                    </div>
                    <div className="button competitor">Competitor graph</div>
                </div>
                <div className="rank-progress-content">
                    GRAPH
                </div>
            </div>
        );
    }
}

module.exports = RankProgress;