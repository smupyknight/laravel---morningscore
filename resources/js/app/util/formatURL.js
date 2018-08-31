function formatUrl (url) {
    if (typeof url === String) {
        console.error("Type of parameter is not StringConstructor", typeof url);
        return url;
    }
    return url.replace(/www./, "");
}

module.exports = formatUrl;