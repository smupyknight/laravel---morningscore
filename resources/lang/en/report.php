<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | MISCELLANEOUS
    |--------------------------------------------------------------------------
    */
    "page_title"   => "Report",
    "misc"         => [
        "cover"            => [
            "title"   => "Welcome onboard, Captain",
            "tagline" => "Here's your status from mission control",
        ],
        "coming_soon"      => [
            "title"    => "Coming soon!",
            "spaceman" => "SPACEMAN",
            "desc"     => "is working hard on getting this ready for us.",
            "expect"   => "Time left",
            "days"     => "days",
        ],
        "manage_domains"   => "Manage Domains",
        "see_more"         => "See more details here",
        "show_me_the_math" => "Show me the math",
        "save"             => "Save",
        "save_settings"    => "Save settings",
        "loading"          => [
            "working_hard" => "SPACEMAN is finding your data.",
            "mission"      => "Right now, he is on a mission to find your data.",
            "not_long"     => "This won't take long and don't worry he's always successful. Thank you for your patience!",
            "roadmap"      => "Check out the roadmap while we are getting your data",
        ],
        "columns"          => [
            "keyword"   => "Keyword",
            "searches"  => "Searches/mo",
            "prev_rank" => "Prev. rank",
            "rank"      => "Your Rank",
            "traffic"   => "Your Traffic",
            "score"     => "Morningscore",
            "visits"    => "Your Traffic",
        ],
		"ranks" => [
			'all'		=> 'All',
			'ranks'		=> 'Ranks',
			'all_ranks'	=> 'All ranks',
		],
        "date_ranges"      => [
            "today"      => "Today",
            "this_week"  => "This week",
            "this_month" => "This month",
            "this_year"  => "This year",
            "yesterday"  => "Yesterday",
            "last_week"  => "Last week",
            "last_month" => "Last month",
            "last_year"  => "Last year",
        ],
        "paginator"        => [
            "prev" => "Prev",
            "next" => "Next",
        ],
    ],
    
    
    /*
    |--------------------------------------------------------------------------
    | COMPONENTS
    |--------------------------------------------------------------------------
    */
    "components" => [

		/*
		| Your morningscore --------------------------------------------------
		*/
        "current_morningscore" => [
            "title" => "Your Morningscore",
			"loading"	=> [
				"title"		=> "SPACEMAN is exploring your data",
				"desc"	=> "SPACEMAN is exploring space looking for your data. This will take anywhere from 2 hours to 2 days. It usually takes around 24 hours though. Please check back later.",
			],
        ],
        
        /*
        | Morningscore math --------------------------------------------------
        */
        "morningscore_math"       => [
            "title"           => "The numbers behind your Morningscore",
            "title_2"         => "The numbers behind",
            "description"     => "Below is the data that makes up the Morningscore. If you want to understand how you find these keywords and how the calculation works you can click the info icon.",
            "clicks"          => "Your Traffic",
            "click_price"     => "Click price",
            "click_nr"        => "Amount of clicks",
            "we_found_part_1" => "We have found",
            "we_found_part_2" => "keywords which contribute to your Morningscore",
            "we_found_part_2_alt" => "keywords which contribute to the Morningscore of",
            "columns"         => [
                "clicks" => "Your Traffic",
                "cpc"    => "CPC in",
            ],
            "loading"         => [
                "title" => "SPACEMAN is doing some complex math",
                "desc"  => "This won't take too long because he's really good at it. Right now he is crunching down the numbers so he could show you exactly how your Morningscore is being created up here in space.",
            ],
        ],
        
        /*
        | SEO potential math --------------------------------------------------
        */
        "seo_potential_math"      => [
            "title"           => "The numbers behind",
            "description"     => "Below is the data that makes up the Morningscore. If you want to understand how you find these keywords and how the calculation works you can click the info icon.",
            "clicks"          => "Your Traffic",
            "click_price"     => "Click price",
            "click_nr"        => "Amount of clicks",
			"traffic_val"	  => "traffic share",
			"traffic_pot"	  => "traffic potential",
            "we_found_part_1" => "We have found",
            "we_found_part_2" => "keywords which contribute to the potential of",
            "columns"         => [
                "clicks" => "Your Traffic",
                "cpc"    => "CPC in",
            ],
            "loading"         => [
                "title" => "SPACEMAN is doing some complex math",
                "desc"  => "This won't take too long because he's really good at it. Right now he is crunching down the numbers so he could show you exactly how your Morningscore is being created up here in space.",
            ],
        ],
        
        /*
        | Morningscore graph  --------------------------------------------------
        */
        "historical_morningscore" => [
            "title"   => "Morningscore trend",
            "loading" => [
                "desc" => "SPACEMAN started tracking your data the day you signed up. No data is available earlier than that in most cases.",
            ],
        ],
        
        /*
        | Competitors --------------------------------------------------
        */
        "competitors"             => [
            "name"      => "Competitor",
            "change_in" => "Change in", // Change in {curency}
            "add"       => "Add your competitors and see how they compare to you",
            "button"    => "Add competitors",
        ],
        
        /*
        | SEO Traffic Potential --------------------------------------------------
        */
        "seo_potential"           => [
            "title"                   => "SEO traffic Potential",
            "description"             => "What is your traffic potential with #1 ranking on all your top-20 keywords? A share of over 10% is high. See your competitors performance on your keywords.",
            "total_traffic_potential" => "Your Total traffic potential in clicks/mo",
            "traffic_share"           => "Your Traffic share in clicks/mo",
            "percentage"              => "Your Percentage share",
            "you"                     => "You",
        ],
        
        /*
        | Reports tabs --------------------------------------------------
        */
        "report_tabs"             => [
            "title" => "Reports",
            "tabs"  => [
                "keywords" => [
                    "title" => "keywords",
                    "desc"  => "Check your keywords rankings",
                ],
                "links"    => [
                    "title" => "links",
                    "desc"  => "Check your links and value",
                ],
                "onsite"   => [
                    "title" => "onsite",
                    "desc"  => "Full SEO health check",
                ],
            ],
        ],
        
        /*
        |--------------------------------------------------------------------------
        | REPORT TABS COMPONENTS
        |--------------------------------------------------------------------------
        */
        "tracked_keywords"        => [
            "title"       => "Keywords you are tracking",
            "add_keyword" => "Add keyword",
        ],
        "suggested_keywords"      => [
            "title" => "Top 10 suggested keywords",
        ],
        "refdomains_top_lost"     => [
            "titles" => [
                "singular" => "Lost link",
                "plural"   => "Lost links",
				"none"		=> "0 Lost links",
				"fallback"	=> "No lost links in the currently selected period",
            ],
            "table"  => [
                "link"   => "Link",
                "change" => "Value",
            ],
        ],
        "refdomains_top_new"      => [
            "titles" => [
                "singular" => "New link",
                "plural"   => "New links",
				"none"		=> "0 New links",
				"fallback"	=> "No new links in the currently selected period",
            ],
            "table"  => [
                "link"   => "Link",
                "change" => "Value",
            ],
        ],
        "refdomains_all"          => [
            "title"    => "All links",
            "table"    => [
                "link"   => "Link",
                "change" => "Value",
            ],
            "no_links" => "No links found",
        ],
        "refdomains_competitors"  => [
            "title"    => "Link Summary",
            "domains"  => "Domains",
            "links"    => "Website links",
            "strength" => "Global Rank",
        ],
        
        /*
        |--------------------------------------------------------------------------
        | COMING SOON COMPONENTS
        |--------------------------------------------------------------------------
        */
        "coming_onsite"           => [
            "title"    => "ONSITE SEO",
            "subtitle" => "health-check",
            "desc_1"   => "Does your website live up to the requirements from search engines like Google? This tool will tell us. All the essential requirements from Google are being tested. Up to 200 subpages are being tested to give us a complete answer.",
            "desc_2"   => "You receive a list of problems and recommendations to solve those problems, that you can give on to your SEO team for them to solve. The tool checks if you are taking care of the to-do-list.",
            "table"    => [
                "activity"  => "activity",
                "hours"     => "events",
                "new_meta"  => "new meta title tags",
                "new_pages" => "new pages",
                "new_links" => "new links to your website",
            ],
        ],
        "coming_seo"              => [
            "title" => "SEO traffic",
            "desc"  => "See how much traffic you (and your competitors) are getting on generic keywords as well as branded keywords.",
        ],
        "seo_traffic"             => [
            "title" => "SEO traffic",
            "desc"  => "See how much traffic you (and your competitors) are getting on generic keywords as well as branded keywords.",
        ],
        "coming_activities"       => [
            "title"  => "SEO activities",
            "desc_1" => "Here you will receive the complete overview of all activities related to your websites SEO, so you can easily track what's going on.",
            "desc_2" => "Competitors activity is also measured. You will be able to gather a complete overview of their activities. That way, you can see who is pulling ahead and who is stuck behind us.",
            "desc_3" => "It will also be possible to see very specific details of what links your competitors are building and how it influences their position.",
        ],
        "coming_investments"      => [
            "title"  => "Investments to increase your Morningscore",
            "desc_1" => "In the example to the right the most important investment ideas will be presented to us.",
            "desc_2" => "What you see is just a small appetizer",
            "desc_3" => "\"General investments\" are mostly technical fixes you can do on your site that will increase your overall keyword rankings and therefore boost the Morningscore.",
            "desc_4" => "\"Specific investments\" are selected keywords that has been labeled as \"low hanging fruit\". Here we can calculate the precise gain to your Morningscore",
            "table"  => [
                "title_1"   => "General investments",
                "examp_1_1" => "Redirect http to https",
                "examp_1_2" => "15 links from other webistes lead to 404 errors",
                
                "title_2"   => "Specific investments",
                "examp_2_1" => "Get sweatshirt from position 7 to position",
                "examp_2_2" => "Get hoodie from position 14 to position",
            ],
        ],
        
        /*
        |--------------------------------------------------------------------------
        | SETTINGS & FORMS
        |--------------------------------------------------------------------------
        */
        "settings"                => [
            "title"         => "Settings for your account",
            "desc"          => "Below you can change system settings and update your information.",
            "logout_title"  => "Do you wish to log out?",
            "logout_button" => "Log out",
        ],
        "target_settings"         => [
            "title"       => "Your target website",
            "success_msg" => "Website is now updated",
            "website"     => [
                "label"       => "Website",
                "placeholder" => "your-website.com",
            ],
            "country"     => [
                "label" => "Keyword data from",
            ],
        ],
        "company_settings"        => [
            "title"       => "Company",
            "success_msg" => "Company is now updated",
            "comp_name"   => [
                "label"       => "Company name",
                "placeholder" => "Company name",
            ],
            "country"     => [
                "label"       => "Country",
                "placeholder" => "Country",
            ],
            "city"        => [
                "label"       => "City",
                "placeholder" => "City",
            ],
            "zip_code"    => [
                "label"       => "Postal code",
                "placeholder" => "Postal code",
            ],
            "address"     => [
                "label"       => "Address",
                "placeholder" => "Address",
            ],
            "phone"       => [
                "label"       => "Phone",
                "placeholder" => "Phone",
            ],
            "website"     => [
                "label"       => "Website",
                "placeholder" => "Website URL",
            ],
        ],
        "competitor_settings"     => [
            "title"       => "Competitors",
            "success_msg" => "Competitors are now updated",
            "label"       => "Competitor",
            "placeholder" => "competitor.com",
        ],
        "system_lang_settings"    => [
            "title" => "System language",
        ],
		"system_currency_settings"	=> [
			"title"	=> "System currency",
		],
        "account_settings"        => [
            "title"       => "Account",
            "success_msg" => "User is now updated",
            "f_name"      => [
                "label"       => "First name",
                "placeholder" => "Your first name",
            ],
            "l_name"      => [
                "label"       => "Last name",
                "placeholder" => "Your last name",
            ],
            "email"       => [
                "label"       => "Email",
                "placeholder" => "Your email",
            ],
        ],
        "password_settings"       => [
            "title"        => "Change Password",
            "success_msg"  => "Password is now updated",
            "old_pass"     => [
                "label"       => "Old Password",
                "placeholder" => "Old password",
            ],
            "new_pass"     => [
                "label"       => "New Password",
                "placeholder" => "New password",
            ],
            "confirm_pass" => [
                "label"       => "Confirm Password",
                "placeholder" => "Confirm new password",
            ],
        ],
        
        /*
        |--------------------------------------------------------------------------
        | OTHER MODALS
        |--------------------------------------------------------------------------
        */
        "add_kw"                  => [
            "title"       => "Add keywords",
            "desc"        => "You can add your keywords here. Use comma or new lines to add multiple keywords.",
            "placeholder" => "Your keywords",
            "submit"      => "add keywords",
        ],
        "remove_kw"               => [
            "title"  => "Are you sure?",
            "desc_1" => "The keyword",
            "desc_2" => "will not be tracked anymore",
            "submit" => "remove keyword",
            "cancel" => "cancel",
        ],
		"add_domain" => [
			"title" 			=> "Add domain",
			"desc"				=> "You can add your domain here",
			"domain"			=> "Your domain",
			"locale"			=> "Google target",
			"choose_country"	=> "Choose country",
			"choose_lang"		=> "Choose language",
			"submit"			=> "add domain",
			"manage"			=> "Manage your domains",
			"manage_desc"		=> "View and delete your existing domains",
		],
        "welcome"                 => [
            "title"     => "Welcome aboard the Morningscore BETA",
            "sub_title" => "Here are the keys to the first part of our mission",
            "title_2"   => "Our first launch together",
            "p_1"       => "A big thank you from the Morningscore team for being part of our journey so early on.",
            "p_2"       => "This is only the beginning. We will release new features every month (exceptions will occur).",
            "p_3"       => "Below is the roadmap of upcoming features.",
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | MODALS
    |--------------------------------------------------------------------------
    */
    "modals"       => [
        "current_morningscore" => [
            "title_1" => "The Morningscore is:",
            "title_2" => "Simplified example:",
            "title_3" => "A precise explanation:",
            
            "left"   => "The monthly clicks from Google to your website",
            "center" => "times",
            "right"  => "The price you would pay for the clicks in Google AdWords",
            
            "img1" => "img/infographics/en/current_morningscore/addition/morningscore-01.svg",
            "img2" => "img/infographics/en/current_morningscore/addition/morningscore-02.svg",
        ],
        
        "seo_potential" => [
            "title" => "SEO Potential Explanation",
        ],
        
        "tracked_keywords" => [
            "title" => "Keywords You Are Tracking Explanation",
        ],
        
        "suggested_keywords" => [
            "title" => "Suggested Keywords Explanation",
        ],
        
        "competitor_links" => [
            "title" => "Competitor Links",
        ],
        
        "all_links" => [
            "title" => "All Links",
        ],
        
        "new_links" => [
            "title" => "New Links In",
        ],
        
        "lost_links" => [
            "title" => "Recently Lost Links",
        ],
        
        "website_links" => [
            "title" => "Website Links",
        ],
        
        "link_strength" => [
            "title" => "Link Strengths",
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | INFOGRAPHICS
    |--------------------------------------------------------------------------
    */
    "infographics" => [
        "current_morningscore" => [
            [
                "title"   => "You = Clothing Store",
                "content" => "We'll start by assuming you run an online clothing store. For the sake of this explanation, the numbers shown here are made up.",
                "img"     => "img/infographics/en/current_morningscore/you_clothing_store.svg",
            ],
            [
                "title"   => "The 4 Metrics",
                "content" => "To understand how we calculate your Morningscore and how it affects your bottom line, there are 4 metrics we need to look at first.",
                "img"     => "img/infographics/en/current_morningscore/the_4_metrics.svg",
            ],
            [
                "title"   => "Traffic Volume",
                "content" => "That's an easy one. The Traffic Volume metric represents the number of searches certain keywords get on Google per month. Example: You are trying to rank your store for the keywords \"bikini\", and you can see how many searches these keywords get per month.",
                "img"     => "img/infographics/en/current_morningscore/traffic_volume.svg",
            ],
            [
                "title"   => "Click-Through Rate",
                "content" => "This is the distribution of link clicks on the result page for a given keyword. Statistics show that on average, the first position for any keyword receives about 20% of all the clicks.",
                "img"     => "img/infographics/en/current_morningscore/click_through_rate.svg",
            ],
            [
                "title"   => "Organic Traffic",
                "content" => "It can be calculated from the equation: Traffic Volume * CTR = Organic Traffic",
                "img"     => "img/infographics/en/current_morningscore/organic_traffic.svg",
            ],
            [
                "title"   => "Cost-Per-Click",
                "content" => "The CPC metric represents the price you pay for one user clicking on an AdWords ad.",
                "img"     => "img/infographics/en/current_morningscore/cpc.svg",
            ],
            [
                "title"   => "The Conclusion",
                "content" => "In this example, 6000 people are coming to your website from the keyword \"bikini\" and it would cost you $0.78 to get each of them through ads. From there, you can determine how much money you save from organic traffic compared to paid traffic.\n\nYou can estimate a Morningscore per keyword or as a sum of all keywords.\n\nThe per-keyword calculations can be seen under \"Show me the math\".",
                "img"     => "img/infographics/en/current_morningscore/conclusion.svg",
            ],
            [
                "title"   => "That's all folks",
                "content" => "So how do we get your total Monrningscore?\n\nLet's say we rank for 2 more keywords like \"t-shirt\" and \"jeans\".\n\nThat would ammount to $7,458 and $6,787 respectively so in our case the collective score would ammount to $18,923.",
                "img"     => "img/infographics/en/current_morningscore/thats_all_folks.svg",
            ],
        ],
        
        "seo_potential" => [
            [
                "title"   => "How big is your potential market?",
                "content" => "Let's get to the bottom of this \"Traffic Potential\" and why it's important for your business. It might seem complicated at first, but it's nothing near SEO-rocket engineering so let's take a look.",
                "img"     => "img/infographics/en/traffic_potential/how_big_market.svg",
            ],
            [
                "title"   => "Total traffic potential",
                "content" => "The \"Total Traffic Potential\" is the maximum number of visits that you can get on your website if you ranked #1 on Google for all keywords Morningscore finds on your site that are are in the top-20 results on Google (first or 2nd page of Google results).",
                "img"     => "img/infographics/en/traffic_potential/total_traffic_potential.svg",
            ],
            [
                "title"   => "Your traffic share",
                "content" => "Let's look at the clothing store example again. Say you're ranked #5 for \"bikini\", #3 for \"shorts\", and #2 on \"t-shirt\". These rankings will form \"Your Traffic Share\" as you already pull traffic from them.",
                "img"     => "img/infographics/en/traffic_potential/your_traffic_share.svg",
            ],
            [
                "title"   => "Your percentage share",
                "content" => "As to the \"Your Percentage Share\" - it displays how much market share you've captured on the keywords we've found. Intuitively, from this number, you can see how much you can grow.",
                "img"     => "img/infographics/en/traffic_potential/your_percentage_share.svg",
            ],
            [
                "title"   => "Traffic on your market",
                "content" => "This graph shows you how much traffic your competitors get on YOUR keywords. So it's a way to see how many of your keywords they are also trying to rank for and how \"similar\" they are to you.",
                "img"     => "img/infographics/en/traffic_potential/traffic_on_market.svg",
            ],
            [
                "title"   => "Conclusion",
                "content" => "If you have more than 5% market share it's definitely not bad. It's highly unlikely you will have more than 30% market share.\n\nIf your competitors are way ahead of you we suggest to check their link performance to see if they are stronger than you. If not then it's mostly because they have a better SEO-optimized website than you.",
                "img"     => "img/infographics/en/traffic_potential/conclusion.svg",
            ],
        ],
        
        "tracked_keywords" => [
            [
                "title"   => "Keywords you are tracking",
                "content" => "In this section you decide which keywords you want to track.",
                "img"     => "img/infographics/en/tracked_keywords/keywords_you_are_tracking.svg",
            ],
            [
                "title"   => "We help you",
                "content" => "Once you have entered your keywords, we find all the relevant data for them. We take you through the data below.",
                "img"     => "img/infographics/en/tracked_keywords/we_help_you.svg",
            ],
            [
                "title"   => "Volume",
                "content" => "The \"Volume\" column shows you the total times the keywords is searched for on Google every month.",
                "img"     => "img/infographics/en/tracked_keywords/volume.svg",
            ],
            [
                "title"   => "Traffic",
                "content" => "In the \"Traffic\" column, you can see the number of people going to your website when searching for the keyword.",
                "img"     => "img/infographics/en/tracked_keywords/traffic.svg",
            ],
            [
                "title"   => "Rank",
                "content" => "Your keywords' \"Rank\" is how high your website ranks on Google when people search for that keyword. For example, if you search for the word \"bucket\" in Google and your website is the first result, your rank is #1.",
                "img"     => "img/infographics/en/tracked_keywords/rank.svg",
            ],
        ],
        
        "suggested_keywords" => [
            [
                "title"   => "Top 10 suggested keywords",
                "content" => "Let's talk about the \"Top 10 Suggested Keywords\" section our advanced alien mathematicians prepared for you.",
                "img"     => "img/infographics/en/suggested_keywords/top_10.svg",
            ],
            [
                "title"   => "Analysis",
                "content" => "In the process of finding the best keyword suggestions, we first analyze 500 million keywords, to find keywords where you rank in the top 100.",
                "img"     => "img/infographics/en/suggested_keywords/analysis.svg",
            ],
            [
                "title"   => "Suggestion",
                "content" => "We present the 10 most relevant keywords, that have the highest potential impact on your Morningscore.",
                "img"     => "img/infographics/en/suggested_keywords/suggestion.svg",
            ],
            [
                "title"   => "Better click it",
                "content" => "You can then add those keyword suggestions by clicking on the blue plus mark that appears to the left when you hover over a keyword.",
                "img"     => "img/infographics/en/suggested_keywords/better_click_it.svg",
            ],
        ],
        
        "competitor_links" => [
            [
                "title"   => "",
                "content" => "Why does my website need links?",
                "img"     => "img/infographics/en/competitor_links/website need-01.svg",
            ],
            [
                "title"   => "",
                "content" => "Let's say you published a book.",
                "img"     => "img/infographics/en/competitor_links/website need-02.svg",
            ],
            [
                "title"   => "",
                "content" => "And let's assume that links are references to your book.",
                "img"     => "img/infographics/en/competitor_links/website need-03.svg",
            ],
            [
                "title"   => "",
                "content" => "If a lot of books reference your book, then you achieve a certain level of authority.",
                "img"     => "img/infographics/en/competitor_links/website need-04.svg",
            ],
            [
                "title"   => "",
                "content" => "Once you have a lot of authority, this means you are well known. Then people can find you more easily and will associate your name with the specific topic that you talk about.",
                "img"     => "img/infographics/en/competitor_links/website need-05.svg",
            ],
            [
                "title"   => "",
                "content" => "That’s exactly how links work too. Achieving more links will mean that your keywords will rank higher on Google.",
                "img"     => "img/infographics/en/competitor_links/website need-06.svg",
            ],
        ],
        
        "all_links" => [
            [
                "title"   => "",
                "content" => "What are \"All Links\"?",
                "img"     => "img/infographics/en/all_links/all_links-01.svg",
            ],
            [
                "title"   => "",
                "content" => "\"All Links\" is basically a list of all the domains linking to you.",
                "img"     => "img/infographics/en/all_links/all_links-02.svg",
            ],
            [
                "title"   => "",
                "content" => "It can be used to give you an overview of all the websites that link back to you in some way, or to see the strength rating of those websites (i.e. how much authority they have).",
                "img"     => "img/infographics/en/all_links/all_links-03.svg",
            ],
            [
                "title"   => "",
                "content" => "We get the data about the value of the link from Ahrefs (Domain Rating), the values can range 0-100. We display a number of arrows based on the value:\n\nLess than 5: 0 arrows,\nif the value is 5 or above: 1 arrows,\nif the value is 30 or above: 2 arrows,\nif the value is 50 or above: 3 arrows,\nif the value is 70 or above: 4 arrows.",
                "img"     => "img/infographics/en/new_links/new_links-04.svg",
            ],
        ],
        
        "new_links" => [
            [
                "title"   => "",
                "content" => "What are \"New Links In\"?",
                "img"     => "img/infographics/en/new_links/new_links-01.svg",
            ],
            [
                "title"   => "",
                "content" => "As we already know, links are basically references that connect other websites to you. The more you have, the more authority you have.",
                "img"     => "img/infographics/en/new_links/new_links-02.svg",
            ],
            [
                "title"   => "",
                "content" => "This metric is useful for tracking if your links have been indexed and to track the sources your new links are coming from. You can also see the value of incoming links.",
                "img"     => "img/infographics/en/new_links/new_links-03.svg",
            ],
            [
                "title"   => "",
                "content" => "We get the data about the value of the link from Ahrefs (Domain Rating), the values can range 0-100. We display a number of arrows based on the value:\n\nLess than 5: 0 arrows,\nif the value is 5 or above: 1 arrows,\nif the value is 30 or above: 2 arrows,\nif the value is 50 or above: 3 arrows,\nif the value is 70 or above: 4 arrows.",
                "img"     => "img/infographics/en/new_links/new_links-04.svg",
            ],
        ],
        
        "lost_links" => [
            [
                "title"   => "",
                "content" => "What are \"Recently Lost Links\"?",
                "img"     => "img/infographics/en/lost_links/lost_links-01.svg",
            ],
            [
                "title"   => "",
                "content" => "As we already know, links are basically references, that connect other websites to you. The more you have, the more authority you have.",
                "img"     => "img/infographics/en/lost_links/lost_links-02.svg",
            ],
            [
                "title"   => "",
                "content" => "Links sometimes get lost along the way, the reasons are numerous, but the most common causes are:\n\nThe source has changed the link address\n\nTechnical issue with the website that is linking to you\n\nTechnical issues with your website",
                "img"     => "img/infographics/en/lost_links/lost_links-03.svg",
            ],
            [
                "title"   => "",
                "content" => "This metric is useful for tracking these links so you can get them back or if you are trying to fix the problems.",
                "img"     => "img/infographics/en/lost_links/lost_links-04.svg",
            ],
            [
                "title"   => "",
                "content" => "We get the data about the value of the link from Ahrefs (Domain Rating), the values can range 0-100. We display a number of arrows based on the value:\n\nLess than 5: 0 arrows,\nif the value is 5 or above: 1 arrows,\nif the value is 30 or above: 2 arrows,\nif the value is 50 or above: 3 arrows,\nif the value is 70 or above: 4 arrows.",
                "img"     => "img/infographics/en/new_links/new_links-04.svg",
            ],
        ],
        
        "website_links" => [
            [
                "title"   => "",
                "content" => "What is \"Website Links\"?",
                "img"     => "img/infographics/en/website_links/website_links-01.svg",
            ],
            [
                "title"   => "",
                "content" => "\"Website Links\" shows you the number of domains that point back to your website.",
                "img"     => "img/infographics/en/website_links/website_links-02.svg",
            ],
            [
                "title"   => "",
                "content" => "And of course, you can also look at the amount of domains that link to your competitors.",
                "img"     => "img/infographics/en/website_links/website_links-03.svg",
            ],
        ],
        
        "link_strength" => [
            [
                "title"   => "",
                "content" => "What is the \"Global Rank\" stat?",
                "img"     => "img/infographics/en/global_rank/global_rank-01.svg",
            ],
            [
                "title"   => "",
                "content" => "It shows you how good or bad your position based on links is, compared to everyone else in the world.",
                "img"     => "img/infographics/en/global_rank/global_rank-02.svg",
            ],
            [
                "title"   => "",
                "content" => "The higher your rank is (lower number is better), the more strength your website has. For example, we have Facebook at number 1, Twitter at 2, YouTube at 3 and so on.",
                "img"     => "img/infographics/en/global_rank/global_rank-03.svg",
            ],
            [
                "title"   => "",
                "content" => "Most smaller businesses, rank between 10-5 million. If you are below 3 million, then you will see a big improvement in your rankings.",
                "img"     => "img/infographics/en/global_rank/global_rank-04.svg",
            ],
        ],
    
    ],
];
