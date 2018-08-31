class CookieService {
    static set(name, value, daysToExpire = 1, escape = true, path = '/') {
        var expirationDate = new Date();
        expirationDate.setDate(expirationDate.getDate() + daysToExpire);

		if(escape) {
			value = escape(value);
		}
        document.cookie = name + "=" + value + "; expires=" + expirationDate.toUTCString() + "; path=" + path;
    }

    static get(name) {
        var key, value, cookies = document.cookie.split(";");

        for (var i = 0, length = cookies.length; i < length; i++) {
            key = cookies[i].substr(0, cookies[i].indexOf("=")).replace(/^\s+|\s+$/g, "");
            value = cookies[i].substr(cookies[i].indexOf("=") + 1);

            if (key === name) {
                return decodeURI(value);
            }
        }
    }

}

module.exports = CookieService;
