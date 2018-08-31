function setLaunchDate(launchDate, forceFormat) {
    if (typeof launchDate === "string") {
        
        let distance = new Date(launchDate).getTime() - Date.now();

        let _m = Math.floor(distance / (1000 * 60));
        let _h = Math.floor(distance / (1000 * 60) / 60);
        let _d = Math.floor(distance / (1000 * 60) / (60 * 24));
        let _w = Math.floor((distance / (1000 * 60) / (60 * 24)) / 7);
        let _M = Math.floor((distance / (1000 * 60) / (60 * 24)) / 30);

    
        let timeObject = {
            months: {
                amount: _M,
                unit: "months"
            },
            weeks: {
                amount: _w,
                unit: "weeks"
            },
            days: {
                amount: _d,
                unit: "days"
            },
            hours: {
                amount: _h,
                unit: "hours"
            },
            minutes: {
                amount: _m,
                unit: "minutes"
            }
        };

        // If user forcesFormat return the requested format
        if (forceFormat && timeObject.hasOwnProperty(forceFormat)) {
            return (
                timeObject[forceFormat].amount 
                // + 
                // " "
                // + 
                // timeObject[forceFormat].unit;
            );
            
        }


        // Skips any 0 values and return the first occurence of a value > 0
        for (var key in timeObject) {
            if (timeObject[key].amount <= 0) {
                continue;
            }
            else {
                return (
                    timeObject[key].amount 
                    // + 
                    // " " 
                    // + 
                    // timeObject[key].unit
                );
            }
        }
    }
    else {
        throw "Parameter is not a string";
    }        
}

module.exports = setLaunchDate;