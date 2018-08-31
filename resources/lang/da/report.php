<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | MISCELLANEOUS
    |--------------------------------------------------------------------------
    */
    "page_title"   => "Rapport",
    "misc"         => [
        "cover"            => [
            "title"   => "Velkommen ombord, kaptajn",
            "tagline" => "Her er status fra dit kontrolcenter",
        ],
        "coming_soon"      => [
            "title"    => "Kommer snart!",
            "spaceman" => "SPACEMAN",
            "desc"     => "arbejder hårdt på at gøre funktionen klar til os.",
            "expect"   => "Tid tilbage",
            "days"     => "dage",
        ],
        "manage_domains"   => "Tilføj / Fjern",
        "see_more"         => "Se flere detaljer her",
        "show_me_the_math" => "Vis mig udregningen",
        "save"             => "Gem",
        "save_settings"    => "Gem indstillinger",
        "loading"          => [
            "working_hard" => "SPACEMAN er ved at finde dine data",
            "mission"      => "Rumrejsen for at finde dine data er i gang. ",
            "not_long"     => "Det vil ikke tage lang tid, og vær helt rolig, SPACEMAN er altid succesfuld. Tak for tålmodigheden, kaptajn.",
            "roadmap"      => "Tjek kommende features på vores \"roadmap\" mens du venter på data",
        ],
        "columns"          => [
            "keyword"   => "Søgeord",
            "searches"  => "Søgninger/md",
            "prev_rank" => "Tidl. position",
            "rank"      => "Din Position",
            "traffic"   => "Din Trafik",
            "score"     => "Din Morningscore",
            "visits"    => "Din Trafik",
        ],
		"ranks" => [
			'all'		=> 'Alle',
			'ranks'		=> 'Positioner',
			'all_ranks'	=> 'Alle positioner',
		],
        "date_ranges"      => [
            "today"      => "I dag",
            "this_week"  => "Denne uge",
            "this_month" => "Denne måned",
            "this_year"  => "Dette år",
            "yesterday"  => "I går",
            "last_week"  => "Sidste uge",
            "last_month" => "Sidste måned",
            "last_year"  => "Sidste år",
        ],
        "paginator"        => [
            "prev" => "Forrige",
            "next" => "Næste",
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
            "title" => "Din Morningscore",
			"loading"	=> [
				"title"		=> "SPACEMAN udforsker dine data",
				"desc"	=> "SPACEMAN udforsker rummet for at finde dine data. Dette kan tage alt i mellem 2 timer og 2 dage. Tjek venligst igen lidt senere.",
			],
        ],
        
        /*
        | Morningscore math --------------------------------------------------
        */
        "morningscore_math"       => [
            "title"           => "Tallene bag din Morningscore",
			"title_2"         => "Tallene bag",
            "description"     => "Nedenfor er alle de data som udgør Morningscoren. Hvis du vil vide mere om hvordan vi finder disse søgeord samt udregner Morningscore, kan du klikke på info-ikonet",
            "clicks"          => "Din Trafik",
            "click_price"     => "Klikpris",
            "click_nr"        => "Antal klik",
            "we_found_part_1" => "Vi har fundet",
            "we_found_part_2" => "søgeord som bidrager til din Morningscore",
            "we_found_part_2_alt" => "søgeord som bidrager til Morningscoren på",
            "columns"         => [
                "clicks" => "Din Trafik",
                "cpc"    => "Klikpris i",
            ],
            "loading"         => [
                "title" => "SPACEMAN er i gang med noget tung matematik",
                "desc"  => "Det vil ikke tage lang tid, da SPACEMAN er virkelig god til det. Det han gør lige nu er, er at indsamle og beregne alle tallene, så han kan vise dig præcis hvordan din Morningscore beregnes her oppefra rummet.",
            ],
        ],
        
        /*
        | SEO Potential math --------------------------------------------------
        */
        "seo_potential_math"      => [
            "title"           => "Tallene bag",
            "description"     => "Nedenfor er alle de data som udgør Morningscoren. Hvis du vil vide mere om hvordan vi finder disse søgeord samt udregner Morningscore, kan du klikke på info-ikonet",
            "clicks"          => "Din Trafik",
            "click_price"     => "Klikpris",
            "click_nr"        => "Antal klik",
			"traffic_val"	  => "trafik andel",
			"traffic_pot"	  => "trafik potentiale",
            "we_found_part_1" => "Vi har fundet",
            "we_found_part_2" => "søgeord som bidrager til potentiale af",
            "columns"         => [
                "clicks" => "Din Trafik",
                "cpc"    => "Klikpris i",
            ],
            "loading"         => [
                "title" => "SPACEMAN er i gang med noget tung matematik",
                "desc"  => "Det vil ikke tage lang tid, da SPACEMAN er virkelig god til det. Det han gør lige nu er, er at indsamle og beregne alle tallene, så han kan vise dig præcis hvordan din Morningscore beregnes her oppefra rummet.",
            ],
        ],
        
        /*
        | Morningscore graph  --------------------------------------------------
        */
        "historical_morningscore" => [
            "title"   => "Morningscore trend",
            "loading" => [
                "desc" => "SPACEMAN startede med at samle data den dag du tilmeldte dig Morningscore. Data før det tidspunkt, er desværre ikke tilgængeligt i de fleste tilfælde.",
            ],
        ],
        
        /*
        | Competitors --------------------------------------------------
        */
        "competitors"             => [
            "name"      => "Konkurrent",
            "change_in" => "Ændring i", // Change in {curency}
            "add"       => "Tilføj dine konkurrenter for at sammenligne",
            "button"    => "Tilføj konkurrenter",
        ],
        
        /*
        | SEO Traffic Potential --------------------------------------------------
        */
        "seo_potential"           => [
            "title"                   => "Potentiale for SEO trafik",
            "description"             => "Hvad er dit månedlige trafik potentiale ved #1 placeringer på alle dine top-20 søgeord? En andel på 10% er høj. Se dine konkurrenters performance på dine søgeord.",
            "total_traffic_potential" => "Dit trafik potentiale i klik/md",
            "traffic_share"           => "Din Trafik andel i klik/md",
            "percentage"              => "Din Andel i procent",
            "you"                     => "Dig",
        ],
        
        /*
        | Reports tabs --------------------------------------------------
        */
        "report_tabs"             => [
            "title" => "Rapport",
            "tabs"  => [
                "keywords" => [
                    "title" => "Søgeord",
                    "desc"  => "Tjek dine søgeords-positioner",
                ],
                "links"    => [
                    "title" => "Links",
                    "desc"  => "Tjek dine links og deres værdi",
                ],
                "onsite"   => [
                    "title" => "ONSITE",
                    "desc"  => "Fuldt SEO helbreds-tjek",
                ],
            ],
        ],
        
        /*
        |--------------------------------------------------------------------------
        | REPORT TABS COMPONENTS
        |--------------------------------------------------------------------------
        */
        "tracked_keywords"        => [
            "title"       => "Dine udvalgte søgeord",
            "add_keyword" => "Tilføj søgeord",
        ],
        "suggested_keywords"      => [
            "title" => "Top 10 foreslåede søgeord",
        ],
        "refdomains_top_lost"     => [
            "titles" => [
                "singular" => "Tabt link",
                "plural"   => "Tabte links",
				"none"		=> "0 Tabte links",
				"fallback"	=> "Ingen tabte links i den valgte periode",
            ],
            "table"  => [
                "link"   => "Link",
                "change" => "Værdi",
            ],
        ],
        "refdomains_top_new"      => [
            "titles" => [
                "singular" => "Nyt link",
                "plural"   => "Nye links",
				"none"		=> "0 Nye links",
				"fallback"	=> "Ingen nye links i den valgte periode",
            ],
            "table"  => [
                "link"   => "Link",
                "change" => "Værdi",
            ],
        ],
        "refdomains_all"          => [
            "title"    => "Alle links",
            "table"    => [
                "link"   => "Link",
                "change" => "Værdi",
            ],
            "no_links" => "Ingen links fundet",
        ],
        "refdomains_competitors"  => [
            "title"    => "Link Overblik",
            "domains"  => "Domæner",
            "links"    => "Hjemmeside Links",
            "strength" => "Global Rangering",
        ],
        
        /*
        |--------------------------------------------------------------------------
        | COMING SOON COMPONENTS
        |--------------------------------------------------------------------------
        */
        "coming_onsite"           => [
            "title"    => "ONSITE SEO",
            "subtitle" => "helbreds-tjek",
            "desc_1"   => "Lever dit website op til de tekniske krav fra søgemaskinger som Google? Dette værktøj vil fortælle dig det. Op til 200 undersider testes for at give dig svaret på dette spørgsmål.",
            "desc_2"   => "Du modtager en liste med problemer og løsningsforslag, som SEO teamet kan løse. Værktøjet tjekker om vi får taget os af to-do listen.",
            "table"    => [
                "activity"  => "aktivitet",
                "hours"     => "events",
                "new_meta"  => "nye meta title tags",
                "new_pages" => "nye sider",
                "new_links" => "nye links til dit website",
            ],
        ],
        "coming_seo"              => [
            "title" => "SEO trafik",
            "desc"  => "Se hvor meget trafik du (og dine konkurrenter) får på generiske søgeord samt brandede søgeord.",
        ],
        "seo_traffic"             => [
            "title" => "SEO trafik",
            "desc"  => "Se hvor meget trafik du (og dine konkurrenter) får på generiske søgeord samt brandede søgeord.",
        ],
        "coming_activities"       => [
            "title"  => "SEO aktivitet",
            "desc_1" => "Her modtager du det komplette overblik over alle aktiviteter relateret til dit websites SEO, så du nemt kan følge med i hvad der sker",
            "desc_2" => "Konkurrent aktivitet måles også. Du vil kunne indsamle et komplet overblik over deres aktiviteter, så du nemt kan se hvem der trækker fra og hvem der står stille.",
            "desc_3" => "Det vil også være muligt at se hvilke links dine konkurrenter får bygget og hvordan det påvirker deres position.",
        ],
        "coming_investments"      => [
            "title"  => "Investeringer der øger din Morningscore",
            "desc_1" => "I eksemplet til højre bliver de mest relevante investeringer vist til dig.",
            "desc_2" => "Eksemplet du ser, er kun en lille appetizer.",
            "desc_3" => "\"Generelle investeringer\" er primært tekniske fixes du kan implementere på dit site og som vil bidrage positivt til din Morningscore.",
            "desc_4" => "\"Specifikke investeringer\" er udvalgte søgeord ud fra devisen \"lavt hængende frugter\". Her kan vi måle den præcise stigning i Morningscore",
            "table"  => [
                "title_1"   => "Generelle investeringer",
                "examp_1_1" => "Sørg for at redirecte http til https",
                "examp_1_2" => "Der er 15 links udefra der fører til 404 fejl",
                
                "title_2"   => "Specifikke investeringer",
                "examp_2_1" => "Få hættetrøje fra plads 7 op på plads",
                "examp_2_2" => "Få hoodie fra plads 14 op på plads",
            ],
        ],
        
        /*
        |--------------------------------------------------------------------------
        | SETTINGS & FORMS
        |--------------------------------------------------------------------------
        */
        "settings"                => [
            "title"         => "Indstillinger for din konto",
            "desc"          => "Nedenfor kan du ændre dine oplysninger og indstillinger for Morningscore.",
            "logout_title"  => "Ønsker du at logge ud?",
            "logout_button" => "Log ud",
        ],
        "target_settings"         => [
            "title"       => "Dit website",
            "success_msg" => "Website er nu opdateret",
            "website"     => [
                "label"       => "Website",
                "placeholder" => "dit-website.dk",
            ],
            "country"     => [
                "label" => "Søgeord måles i",
            ],
        ],
        "company_settings"        => [
            "title"       => "Virksomhed",
            "success_msg" => "Virksomhed er nu opdateret",
            "comp_name"   => [
                "label"       => "Virksomhedsnavn",
                "placeholder" => "Virksomhedsnavn",
            ],
            "country"     => [
                "label"       => "Land",
                "placeholder" => "Land",
            ],
            "city"        => [
                "label"       => "By",
                "placeholder" => "By",
            ],
            "zip_code"    => [
                "label"       => "Postnr.",
                "placeholder" => "Postnr.",
            ],
            "address"     => [
                "label"       => "Adresse",
                "placeholder" => "Adresse",
            ],
            "phone"       => [
                "label"       => "Telefon",
                "placeholder" => "Telefon",
            ],
            "website"     => [
                "label"       => "Website",
                "placeholder" => "Website URL",
            ],
        ],
        "competitor_settings"     => [
            "title"       => "Konkurrenter",
            "success_msg" => "Konkurrenter er nu opdateret",
            "label"       => "Konkurrent",
            "placeholder" => "Konkurrent.dk",
        ],
        "system_lang_settings"    => [
            "title" => "Systemsprog",
        ],
		"system_currency_settings"	=> [
			"title"	=> "Valuta",
		],
        "account_settings"        => [
            "title"       => "Konto",
            "success_msg" => "Bruger er nu opdateret",
            "f_name"      => [
                "label"       => "Fornavn",
                "placeholder" => "Dit fornavn",
            ],
            "l_name"      => [
                "label"       => "Efternavn",
                "placeholder" => "Dit efternavn",
            ],
            "email"       => [
                "label"       => "Email",
                "placeholder" => "Din Email",
            ],
        ],
        "password_settings"       => [
            "title"        => "Ændre adgangskode",
            "success_msg"  => "Adgangskode er nu opdateret",
            "old_pass"     => [
                "label"       => "Gammel adgangskode",
                "placeholder" => "Gammel adgangskode",
            ],
            "new_pass"     => [
                "label"       => "Ny adgangskode",
                "placeholder" => "Ny adgangskode",
            ],
            "confirm_pass" => [
                "label"       => "Bekræft adgangskode",
                "placeholder" => "Bekræft ny adgangskode",
            ],
        ],
        
        /*
        |--------------------------------------------------------------------------
        | OTHER MODALS
        |--------------------------------------------------------------------------
        */
        "add_kw"                  => [
            "title"       => "Tilføj søgeord",
            "desc"        => "Du kan tilføje dine søgeord her. Brug komma eller linjeskift, for at tilføje flere søgeord.",
            "placeholder" => "Dine søgeord",
            "submit"      => "Tilføj søgeord",
        ],
        "remove_kw"               => [
            "title"  => "Er du sikker?",
            "desc_1" => "Søgeordet",
            "desc_2" => "vil ikke blive sporet længere",
            "submit" => "fjern søgeord",
            "cancel" => "Afbryd",
        ],
		"add_domain" => [
			"title" 			=> "Tilføj website",
			"desc"				=> "Du kan tilføje dit website her.",
			"domain"			=> "Dit website",
			"locale"			=> "Google målretning",
			"choose_country"	=> "Vælg land",
			"choose_lang"		=> "Vælg sprog",
			"submit"			=> "Tilføj website",
			"manage"			=> "Administrér dine domæner",
			"manage_desc"		=> "Se og slet dine domæner",
        ],
        "welcome"                 => [
            "title"     => "Velkommen ombord på Morningscore BETA",
            "sub_title" => "Her er nøglerne til første del af vores mission.",
            "title_2"   => "Vores første mission sammen",
            "p_1"       => "Tak, fra alle os på Morningsscore teamet! Vi er superstolte over at have dig med på rejsen - og vi glæder os til at udvikle Morningscore sammen med dig.",
            "p_2"       => "Morningscore v1.0 er kun begyndelsen. Vi kommer løbende til at udgive nye funktioner og features (ca. hver 14. dag - med forbehold for ændringer).",
            "p_3"       => "Her er en oversigt over de planlagte udgivelser (engelsk).",
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | MODALS
    |--------------------------------------------------------------------------
    */
    "modals"       => [
        "current_morningscore" => [
            "title_1" => "Morningscore er:",
            "title_2" => "Simplificeret eksempel:",
            "title_3" => "En præcis forklaring:",
            
            "left"   => "De månedlige organiske (gratis) kliks fra Google til dit website",
            "center" => "gange",
            "right"  => "Prisen du skulle have betalt for disse kliks igennem Google Adwords",
            
            "img1" => "img/infographics/da/current_morningscore/addition/morningscore-01.svg",
            "img2" => "img/infographics/da/current_morningscore/addition/morningscore-02.svg",
        ],
        
        "seo_potential" => [
            "title" => "SEO trafik potentiale forklaring",
        ],
        
        "tracked_keywords" => [
            "title" => "Dine udvalgte søgeord forklaring",
        ],
        
        "suggested_keywords" => [
            "title" => "Foreslåede søgeord forklaring",
        ],
        
        "competitor_links" => [
            "title" => "Konkurrenternes links",
        ],
        
        "all_links" => [
            "title" => "Alle links",
        ],
        
        "new_links" => [
            "title" => "Nye links",
        ],
        
        "lost_links" => [
            "title" => "Nyligt tabte links",
        ],
        
        "website_links" => [
            "title" => "Hjemmeside Links",
        ],
        
        "link_strength" => [
            "title" => "Global Rangering",
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
                "title"   => "Du = Tøjbutik",
                "content" => "Vi forklarer Morningscoren ved at antage, at du har en online tøjbutik. Alle tal i denne forklaring er fiktive",
                "img"     => "img/infographics/da/current_morningscore/you_clothing_store.svg",
            ],
            [
                "title"   => "De 4 Metrics",
                "content" => "For at fostå hvordan vi beregner din Morningscore og hvad den betyder for dig, er der 4 metrics du skal kende.",
                "img"     => "img/infographics/da/current_morningscore/the_4_metrics.svg",
            ],
            [
                "title"   => "Søgninger/md",
                "content" => "Søgninger/md (Søgninger per måned) er hvor mange søgninger et søgeord får på Google hver måned. Eksempelvis kan vi nu se at søgeordet ”bikini” har en månedlig søgevolumen på 14.800.",
                "img"     => "img/infographics/da/current_morningscore/traffic_volume.svg",
            ],
            [
                "title"   => "Klik-rate (CTR)",
                "content" => "Klik-rate, eller den kendte engelske forkortelse CTR, angiver hvor mange procent af søgningerne som fører til klik. Pålidelig statistik viser at 1.-pladsen på Google giver en klikrate (CTR) på 20%. SPACEMAN måler på placeringer fra 1-20.",
                "img"     => "img/infographics/da/current_morningscore/click_through_rate.svg",
            ],
            [
                "title"   => "Organisk trafik",
                "content" => "Organisk trafik kan udregnes på følgende måde: Søgninger/md * CTR = Organisk trafik til dit website.",
                "img"     => "img/infographics/da/current_morningscore/organic_traffic.svg",
            ],
            [
                "title"   => "Klikpris (CPC)",
                "content" => "Klikprisen er hvad man betaler for 1 klik når nogen klikker på ens søgeords announcer I Adwords. Dette kaldes også CPC (Cost Per Click).",
                "img"     => "img/infographics/da/current_morningscore/cpc.svg",
            ],
            [
                "title"   => "Regnestykket",
                "content" => "I dette eksempel kommer 6.000 kliks over til dit website fra søgeordet ”bikini” og det ville have kostet dig $0,78 per klik at få disse gennem Google Adwords.\n\nDu kan estimere Morningscore per søgeord eller som en sum af alle søgeord (din totale Morningscore som vises øverst på sitet).",
                "img"     => "img/infographics/da/current_morningscore/conclusion.svg",
            ],
            [
                "title"   => "Vi måler alle dine søgeord",
                "content" => "Hvordan får vi din totale Morningscore?\n\nLad os antage at vi rangerer på i alt 3 søgeord, da vi også ligger højt på \"t-shirt\" og \"jeans\".\n\nDisse søgeord giver os med ovenstående regnestykke henholdsvis $7.458 og $6.787. Så i dette tilfælde vil Morningscoren være $18.923. Dette er altså den værdi du har sparet i Google Adwords og derfor den bedste indikator for værdien af din organiske SEO trafik.",
                "img"     => "img/infographics/da/current_morningscore/thats_all_folks.svg",
            ],
        ],
        
        "seo_potential" => [
            [
                "title"   => "Hvor stort er dit potentielle marked?",
                "content" => "SPACEMAN finder automatisk data omkring alle søgeord på nettet, og scanner mere end 5 mio. søgeord for at finde akkurate data om dit website og dine konkurrenter.",
                "img"     => "img/infographics/da/traffic_potential/how_big_market.svg",
            ],
            [
                "title"   => "Dit trafik potentiale",
                "content" => "\"Dit trafik potentiale\" er det maksimale antal besøg du kan få på dit website hvis du rangerede #1 på alle dine søgeord hvor du har en placering i top-20 resultater på Google (side 1 eller 2 i resultaterne ved en søgning)",
                "img"     => "img/infographics/da/traffic_potential/total_traffic_potential.svg",
            ],
            [
                "title"   => "Din trafik andel",
                "content" => "Lad os antage at du driver en online tøjbutik. Du rangerer lige nu #5 på \"bikini\", #3 på \"shorts\", og #2 på \"t-shirt\". Den totale organiske trafik du får fra alle disse søgeord summeres og giver dig din totale SEO trafik.",
                "img"     => "img/infographics/da/traffic_potential/your_traffic_share.svg",
            ],
            [
                "title"   => "Din andel i procent",
                "content" => "\"Din andel i procent\" viser hvor mange markedsandele af SEO trafik potentialet (#1 på alle søgeord hvor du ligger i top 50 på Google) du på nuværende tidspunkt har opnået og vises i procent.",
                "img"     => "img/infographics/da/traffic_potential/your_percentage_share.svg",
            ],
            [
                "title"   => "Trafik på dit marked",
                "content" => "Denne graf viser hvor meget trafik dine konkurrenter får på DINE søgeord. Det er altså en måde at se hvor mange af dine søgeord, de også opnår placeringer og trafik på og hvor ”ens” deres trafik er i forhold til din trafik.",
                "img"     => "img/infographics/da/traffic_potential/traffic_on_market.svg",
            ],
            [
                "title"   => "Konklusion",
                "content" => "Hvis du har mere end 5% markedsandele er det bestemt ikke dårligt. Det er meget usandsynligt at opnå 30% markedsandele (og kan også betyde at du rangerer på meget få søgeord).\n\nHvis dine konkurrenter er foran dig, foreslår vi at du tjekker deres Global Rank i link-sektionen her på sitet for at se om de gør det bedre end dig.",
                "img"     => "img/infographics/da/traffic_potential/conclusion.svg",
            ],
        ],
        
        "tracked_keywords" => [
            [
                "title"   => "Dine udvalgte søgeord",
                "content" => "I denne sektion kan du selv udvælge hvilke søgeord du ønsker at holde øje med.",
                "img"     => "img/infographics/en/tracked_keywords/keywords_you_are_tracking.svg",
            ],
            [
                "title"   => "SPACEMAN hjælper dig",
                "content" => "Når du har indtastet dine søgeord, hjælper SPACEMAN med at finde data til dem og opdaterer dagligt efterfølgende. De forskellige data forklares nedenfor.",
                "img"     => "img/infographics/en/tracked_keywords/we_help_you.svg",
            ],
            [
                "title"   => "Søgninger/md",
                "content" => "SØGNINGER/MD viser dig det totale antal gange et søgeord er blevet søgt på hver måned i Google.",
                "img"     => "img/infographics/en/tracked_keywords/volume.svg",
            ],
            [
                "title"   => "Din position",
                "content" => "\"DIN POSITION\" fortæller hvor højt dit website er positioneret i Googles søgeresultater når de søger på det specifikke søgeord. Eksempelvis, hvis du søger på ordet ”t-shirt” og du dukker op som det første organiske resultat (altså 1. resultat efter annoncer) så er din position #1",
                "img"     => "img/infographics/en/tracked_keywords/traffic.svg",
            ],
            [
                "title"   => "Trafik",
                "content" => "I trafik kolonnen kan du se hvor mange kliks dit website får per måned fra Google på det enkelte søgeord.",
                "img"     => "img/infographics/en/tracked_keywords/rank.svg",
            ],
        ],
        
        "suggested_keywords" => [
            [
                "title"   => "Top 10 foreslåede søgeord",
                "content" => "Lad os snakke om \"Top 10 foreslåede søgeord\"-sektionen, som vores avancerede alien-matematiker har forberedt til dig.",
                "img"     => "img/infographics/en/suggested_keywords/top_10.svg",
            ],
            [
                "title"   => "Analyser",
                "content" => "Under processen med at finde de bedste forslag, analyserer vi først 500 millioner søgeord, for at finde søgeord hvor du rangerer i top 100.",
                "img"     => "img/infographics/en/suggested_keywords/analysis.svg",
            ],
            [
                "title"   => "Foreslag",
                "content" => "Vi vil så præsentere de 10 mest relevante søgeord for dig, som har det højeste potentiale for at øge din Morningscore.",
                "img"     => "img/infographics/en/suggested_keywords/suggestion.svg",
            ],
            [
                "title"   => "Du må hellere klikke",
                "content" => "Du kan tilføje disse søgeordsforeslag ved at klikke på det blå ikon der kommer frem, når du holder musen over et søgeord.",
                "img"     => "img/infographics/en/suggested_keywords/better_click_it.svg",
            ],
        ],
        
        "competitor_links" => [
            [
                "title"   => "",
                "content" => "Hvorfor behøver min hjemmeside links?",
                "img"     => "img/infographics/en/competitor_links/website need-01.svg",
            ],
            [
                "title"   => "",
                "content" => "Lad os lige lege, at du har udgivet en bog.",
                "img"     => "img/infographics/en/competitor_links/website need-02.svg",
            ],
            [
                "title"   => "",
                "content" => "Og lad os også gå ud fra, at disse links er referencer til bogen.",
                "img"     => "img/infographics/en/competitor_links/website need-03.svg",
            ],
            [
                "title"   => "",
                "content" => "Hvis en masse bøger refererer til din bog, så har du opnået et vis niveau af autoritet.",
                "img"     => "img/infographics/en/competitor_links/website need-04.svg",
            ],
            [
                "title"   => "",
                "content" => "Når du har opnået en masse autoritet betyder det at du er kendt. Så kan folk nemmere finde dig og de vil associere dit navn med det specifikke emne som du taler om.",
                "img"     => "img/infographics/en/competitor_links/website need-05.svg",
            ],
            [
                "title"   => "",
                "content" => "Det er præcis sådan links også virker. Hvis du får flere links betyder det, at dine søgeord vil rangere højere på Google.",
                "img"     => "img/infographics/en/competitor_links/website need-06.svg",
            ],
        ],
        
        "all_links" => [
            [
                "title"   => "",
                "content" => "Hvad viser \"Alle Links\"?",
                "img"     => "img/infographics/en/all_links/all_links-01.svg",
            ],
            [
                "title"   => "",
                "content" => "\"Alle Links\" er blot en liste over alle de domæner som linker til dig.",
                "img"     => "img/infographics/en/all_links/all_links-02.svg",
            ],
            [
                "title"   => "",
                "content" => "Det kan bruges til at give dig et overblik over alle de hjemmesider som linker tilbage til dig, eller til at se styrken af disse hjemmesider (f.eks. hvor meget autoritet de har).",
                "img"     => "img/infographics/en/all_links/all_links-03.svg",
            ],
            [
                "title"   => "",
                "content" => "Vi får dataen om værdien af linksne fra Ahrefs (Domæne rating), hvor værdierne varierer fra 0-100. Vi viser et antal pile baseret på værdien:\n\nMindre end 5: 0 pile,\n5 eller derover: 1 pil,\n30 eller derover: 2 pile,\n50 eller derover: 3 pile,\n70 eller derover: 4 pile.",
                "img"     => "img/infographics/en/new_links/new_links-04.svg",
            ],
        ],
        
        "new_links" => [
            [
                "title"   => "",
                "content" => "Hvad viser \"Nye links\"?",
                "img"     => "img/infographics/en/new_links/new_links-01.svg",
            ],
            [
                "title"   => "",
                "content" => "Som vi allerede ved, så er links basalt set referencer der forbinder andre hjemmesider til din. Jo flere du har, desto mere autoritet har du.",
                "img"     => "img/infographics/en/new_links/new_links-02.svg",
            ],
            [
                "title"   => "",
                "content" => "Denne funktion er særlig brugbar til at tjekke om dine links er blevet indekseret og til at holde øje med kilderne, som dine nye links kommer fra. Du kan også se værdien i de indgående links.",
                "img"     => "img/infographics/en/new_links/new_links-03.svg",
            ],
            [
                "title"   => "",
                "content" => "Vi får dataen om værdien af linksne fra Ahrefs (Domæne rating), hvor værdierne varierer fra 0-100. Vi viser et antal pile baseret på værdien:\n\nMindre end 5: 0 pile,\n5 eller derover: 1 pil,\n30 eller derover: 2 pile,\n50 eller derover: 3 pile,\n70 eller derover: 4 pile.",
                "img"     => "img/infographics/en/new_links/new_links-04.svg",
            ],
        ],
        
        "lost_links" => [
            [
                "title"   => "",
                "content" => "Hvad er \"Nyligt tabte links\"?",
                "img"     => "img/infographics/en/lost_links/lost_links-01.svg",
            ],
            [
                "title"   => "",
                "content" => "Som vi allerede ved, så er links basalt set referencer der forbinder andre hjemmesider til din. Jo flere du har, desto mere autoritet har du.",
                "img"     => "img/infographics/en/lost_links/lost_links-02.svg",
            ],
            [
                "title"   => "",
                "content" => "Links forsvinder engang i mellem og grundende kan være mange, men de hyppigste er:\n\nKilden har ændret linkadressen\n\nTekniske problemer med hjemmesiden der linker til dig\n\nTekniske problemer med din hjemmeside",
                "img"     => "img/infographics/en/lost_links/lost_links-03.svg",
            ],
            [
                "title"   => "",
                "content" => "Denne funktion er særlig brugbar til at holde øje med disse links, så du kan få dem tilbage eller hvis du prøver at løse problemerne.",
                "img"     => "img/infographics/en/lost_links/lost_links-04.svg",
            ],
            [
                "title"   => "",
                "content" => "Vi får dataen om værdien af linksne fra Ahrefs (Domæne rating), hvor værdierne varierer fra 0-100. Vi viser et antal pile baseret på værdien:\n\nMindre end 5: 0 pile,\n5 eller derover: 1 pil,\n30 eller derover: 2 pile,\n50 eller derover: 3 pile,\n70 eller derover: 4 pile.",
                "img"     => "img/infographics/en/new_links/new_links-04.svg",
            ],
        ],
        
        "website_links" => [
            [
                "title"   => "",
                "content" => "Hvad er \"Hjemmeside Links\"?",
                "img"     => "img/infographics/en/website_links/website_links-01.svg",
            ],
            [
                "title"   => "",
                "content" => "\"Hjemmeside Links\" viser dig antallet af domæner som linker tilbage på din hjemmeside.",
                "img"     => "img/infographics/en/website_links/website_links-02.svg",
            ],
            [
                "title"   => "",
                "content" => "Og selvfølgelig kan du også se antallet af links der peger på dine konkurrenter.",
                "img"     => "img/infographics/en/website_links/website_links-03.svg",
            ],
        ],
        
        "link_strength" => [
            [
                "title"   => "",
                "content" => "Hvad viser \"Global Rangering\"?",
                "img"     => "img/infographics/en/global_rank/global_rank-01.svg",
            ],
            [
                "title"   => "",
                "content" => "Det viser hvor god eller dårlig din placering, baseret på links, er sammenlignet med alle andre i verden.",
                "img"     => "img/infographics/en/global_rank/global_rank-02.svg",
            ],
            [
                "title"   => "",
                "content" => "Jo højere din rangering er (lavere værdi er bedre), des mere styrke har din hjemmeside. For eksempel har vi Facebook som nummer 1, Twitter som nummer 2, YouTube som nummer 3 og så videre.",
                "img"     => "img/infographics/en/global_rank/global_rank-03.svg",
            ],
            [
                "title"   => "",
                "content" => "De fleste mindre virksomheder rangerer mellem 10-5 millioner. Hvis du er under 3 millioner vil du se en stor forbedring i dine rangeringer.",
                "img"     => "img/infographics/en/global_rank/global_rank-04.svg",
            ],
        ],
    
    ],
];
