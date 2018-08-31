// Function check if the data passed is valid
// Conditions are arraged based on porbability and importance

function validData(data) {
    
    if (Array.isArray(data) && data.length > 0) {
        return true;
    }

    if (data === Object(data) && Object.keys(data).length > 0) {
        return true;
    }

    if (typeof data === 'number' || typeof data === 'string') {
        return true;
	}
	
	return false;
}

module.exports = validData;