
/////////////////////////////////
// Polyfills
/////////////////////////////////

const polyfill = require("app/util/polyfills");
polyfill();


import StarField from "app/util/starfield";

/////////////////////////////////
// Debugger
/////////////////////////////////

const debug = require("app/services/debugger");
// debug.expose({renderer:require("app/services/renderer")});

debug.expose({
	formatNumber: require("app/util/formatNumber")
});

/////////////////////////////////
// Register components
/////////////////////////////////

const renderer = require("app/services/renderer");

renderer.register("portal", {
	Notifications: require("app/components/Notifications"),
	modals: {
		UserSetup: require("app/components/modals/UserSetup"),
		Settings: require("app/components/modals/Settings"),
		AddKeyword: require("app/components/modals/AddKeyword"),
		ManageDomains: require("app/components/modals/ManageDomains"),
		RemoveKeyword: require("app/components/modals/RemoveKeyword"),
		MorningscoreMathModal: require("app/components/modals/MorningscoreMathModal"),
		InformationModal: require("app/components/modals/InformationModal"),
		SEOPotentialModal: require("app/components/modals/SEOPotentialModal"),
		CompetitorLinksModal: require("app/components/modals/CompetitorLinksModal"),
		NewLinksModal: require("app/components/modals/NewLinksModal"),
		LostLinksModal: require("app/components/modals/LostLinksModal"),
		AllLinksModal: require("app/components/modals/AllLinksModal"),
		WebsiteLinksModal: require("app/components/modals/WebsiteLinksModal"),
		LinkStrengthModal: require("app/components/modals/LinkStrengthModal"),
		SEOTrafficModal: require("app/components/modals/SeoTrafficModal"),
		TrackedKeywordsModal: require("app/components/modals/TrackedKeywordsModal"),
		SuggestedKeywordsModal: require("app/components/modals/SuggestedKeywordsModal"),
		WelcomeModal: require("app/components/modals/WelcomeModal"),
		CompetitorsMathModal: require("app/components/modals/CompetitorsMathModal"),
		SeoTrafficPotentialMathModal: require("app/components/modals/SeoTrafficPotentialMathModal"),
		triggers: {
			Button: require("app/components/modals/triggers/Button"),
			Anchor: require("app/components/modals/triggers/Anchor"),
		},
	},
	Test: require("app/components/report/Test"),
	UserSetup: require("app/components/forms/UserSetup"),
	MobileOverlay: require("app/components/MobileOverlay"),

	Competitors: require("app/components/report/Competitors"),
	CurrentMorningscore: require("app/components/report/CurrentMorningscore"),
	HistoricalMorningscore: require("app/components/report/HistoricalMorningscore"),
	SEOPotential: require("app/components/report/SEOPotential"),
    SeoTraffic: require("app/components/report/SeoTraffic"),
	ReportTabs: require("app/components/report/ReportTabs"),
	RangePicker: require("app/components/report/RangePicker"),
	TargetPicker: require("app/components/report/TargetPicker"),
	DomainPicker: require("app/components/report/DomainPicker"),

	ComingActivities: require("app/components/coming-soon/ComingActivities"),
	ComingInvestments: require("app/components/coming-soon/ComingInvestments"),
});

/////////////////////////////////
// Bootstrap
/////////////////////////////////

const logger = require("app/services/logger");

require("app/bootstrap").dispatch()
	.then(payload => {
		// At this point the application was bootstrapped and is ready.
		// You can require your javascript code here and be 100% sure it is ran in the browser.
		const debounce = require("app/util/debounce");

		// Add stars to the cover
		if (document.getElementById('star-container') !== null) {
			const stars = new StarField('star-container', 50, 75, '.no-stars');
			stars.init();

			const resizeStars = debounce(500, function () {
				stars.init();
			});
			window.addEventListener('resize', resizeStars);
		}

		require("app/modules/nav-onscroll")();
		
		// Make sure you keep this return as it continues to pipe the payload towards the end of the pipeline
		return payload;
	})
	.then(() => logger.info("The application was bootstrapped."))
	.catch(error => logger.error(error));
