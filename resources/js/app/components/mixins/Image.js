const {Component} = require("react");
const PropTypes = require("prop-types");

class Image extends Component {

	static get propTypes() {
		return {
			src: PropTypes.string.isRequired,
			alt: PropTypes.string.isRequired,
			scale: PropTypes.string,
			className: PropTypes.string
		};
	}

	static get defaultProps() {
		return {
			scale: "3x"
		};
	}

	get srcset() {
		let matches = (/^([0-9]+)x$/i).exec(this.props.scale);
		let sets = [];

		if (matches) {
			let locationParts = this.props.src.split("/");
			let filename = locationParts.pop();
			let location = locationParts.join("/");
			let baseFilename = filename.split(".").shift();
			let extension = filename.split(".").slice(1).join(".");
			let count = parseInt(matches[1]);

			for (let i = 2; i <= count; i++) {
				sets.push(`${location}/${baseFilename}@${i}x.${extension} ${i}x`);
			}
		}

		return sets.join(", ");
	}

	render() {
		return (
			<img src={this.props.src} alt={this.props.alt} srcSet={this.srcset} className={this.props.className}/>
		);
	}
}

module.exports = Image;