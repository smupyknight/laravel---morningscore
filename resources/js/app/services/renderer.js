const ReactDOM = require("react-dom");
const ReactDOMServer = require("react-dom/server");
const assign = require("object-assign");
const env = require("app/services/env");
const queryObject = require("app/util/queryObject");
let global = global || window;

function attachServerSideRenderer() {
	// Prepare global storage of components so that is doesn't get overriden
	// by other entry scripts that contain this renderer
	global["reactComponents"] = global["reactComponents"] || {};
	global["renderComponent"] = global["renderComponent"] || function (component, props) {
		const Component = queryObject(global["reactComponents"], component);

		if (Component == null) {
			return "";
		}

		return ReactDOMServer.renderToString(<Component {...props} />);
	};
}

class Renderer {

	constructor() {
		this.components = {};
		this.references = {};

		if (env.server()) {
			attachServerSideRenderer();
		}
	}

	register(namespace, components) {
		this.components[namespace] = this.components[namespace] || {};
		assign(this.components[namespace], components);

		// Register global components if server side
		if (env.server()) {
			global["reactComponents"][namespace] = global["reactComponents"][namespace] || {};
			assign(global["reactComponents"][namespace], components);
		}

		return this;
	}

	render() {
		Array.from(document.querySelectorAll("[data-react-class]")).forEach((element) => {
			let components = this.components;

			let Component = queryObject(components, element.dataset.reactClass);
			let props = JSON.parse(element.dataset.reactProps);
			let ref = element.dataset.reactRef;

			if (Component == undefined) {
				throw new Error(`The component ${element.dataset.reactClass} could not be mounted!`);
			}

			let component = ReactDOM.render(
				<Component {...props}/>,
				element
			);

			if (typeof ref === "string" && (ref.length > 0) && component) {
				this.references[ref] = component;
			}
		});

		return this;
	}

	element(reference) {
		return this.references[reference];
	}
}

module.exports = new Renderer();