const Component = require("app/components/coming-soon/ComingBase"); 
const Image = require("app/components/mixins/Image");
const setLaunchDate = require("app/util/setLaunchDate");
const router = require("app/services/router");

class ComingInvestments extends Component
{
	get name() {
		return 'coming_investments';
	}

    render () {
        return (
            <div className="coming-investments">
                <div className="coming-investments__info">
                    <div className="coming-investments__info__description">
                        <div className="coming-soon"><span>{this.cs.title.toUpperCase()}</span> Version <b>1.0 ·</b> Stay crafty</div>
                        <h2>{this.trans.title}</h2>
                        <p>{this.trans.desc_1}</p>
                        <p>{this.trans.desc_2}</p>
                        <a href="http://morningscore.io/roadmap" target="_blank" className="roadmap-link">{this.transMisc.see_more}</a>
                    </div>
                    <hr/>
                    <div className="coming-investments__info__time-to-release">
                        <Image
                            src={router.url("img/figures/spaceman-round.svg")}
                            alt="seo-spaceman"
                            scale="1x"
                        />
                        <p>
                            <span>
                                {this.cs.spaceman}&nbsp;
                            </span> 
                            {this.cs.desc} {this.cs.expect}:&nbsp;
                            <span className="highlight">
                                {setLaunchDate("June 29, 2018 10:00:00", "days")}&nbsp;
                                {this.cs.days}
                            </span>
                        </p>
                    </div>
                </div>
                <div className="coming-investments__table">
                    <table>
                        <thead>
                            <tr>
                                <td><h5>{this.trans.table.title_1}</h5></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div>
                                        <div className="dummyTitle"></div>
                                        {/*
                                        <div className="circle"></div>
                                        <p>{this.trans.table.examp_1_1}</p>
                                        */}
                                    </div>
                                    <div className="dummyValue"></div>
                                    {/*
                                    <p className="section">ONSITE</p>
                                    */}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <div className="dummyTitle medium"></div>
                                        {/*
                                        <div className="circle"></div>
                                        <p>{this.trans.table.examp_1_2}</p>
                                        */}
                                    </div>
                                    <div className="dummyValue"></div>
                                    {/*
                                    <p className="section">LINK</p>
                                    */}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <table>
                        <thead>
                            <tr>
                                <td>
                                    <h5>{this.trans.table.title_2}</h5>
                                    <h5><div className="dummyValue"></div></h5>
                                    {/*
                                    <h5 className="total">750 <span className="currency">DKK</span></h5>
                                    */}
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div className="dummyTitle medium"></div><span><div className="dummyValue"></div></span>
                                    {/*
                                    <p>{this.trans.table.examp_2_1} <span>4</span></p>
                                    <p><span className="amount">500</span> <span className="currency">DKK</span></p>
                                    */}
                                </td>
                            </tr>
                            <tr>
                                <td><div className="dummyTitle long"></div><span><div className="dummyValue"></div></span>
                                    {/*
                                    <p>{this.trans.table.examp_2_2} <span>4</span></p>
                                    <p><span className="amount">250</span> <span className="currency">DKK</span></p>
                                    */}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div className="coming-investments__additional-description">
                        <p>
                        	{this.trans.desc_3}
                        </p>
                        <p>
                        	{this.trans.desc_4}
                        </p>
                </div>
            </div>
        );
    }
}

module.exports = ComingInvestments;
