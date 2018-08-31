import anime from 'animejs'

/**
 * Single star object
 * @param {number} 	x
 * @param {number} 	y
 * @param {string} 	type
 */
let Star = function(x, y, type) {
	this.x = x;
	this.y = y;
	this.type = type;
};

/**
 * Check distance from star to elementX and elementY
 * @param  {number} elementX the x that our star coordinates should be compared with
 * @param  {number} elementY the y that our star coordinates should be compared with
 * @return {float} the distance from the star to the given element coordinates
 */
Star.prototype.distance = function(elementX, elementY) {
	return Math.sqrt(Math.pow(elementX - this.x, 2) + Math.pow(elementY - this.y, 2));
};

/**
 * Checks if the star is inside a specific element
 * @param  {string} element the id of the element
 * @param  {number} padding amount of padding that should be added around the element
 * @return {boolean} returns true if inside element false if not
 */
Star.prototype.insideElement = function(element, padding, leftOffset, topOffset) {
	if(element === false || element === null || element === undefined) {
		return false;
	}

	if(!document.querySelectorAll){
		return false;
	}

	if(typeof(this.els) === 'undefined') {
        this.els = document.querySelectorAll(element);
    }

	var myLeftOffset = leftOffset !== undefined ? leftOffset : 0;
	var myTopOffset = topOffset !== undefined ? topOffset : 0;

	let overlaps = false;

	this.els.forEach((el) => {

        var x1 = el.offsetLeft - myLeftOffset - padding / 2;
        var y1 = el.offsetTop - myTopOffset - padding / 2;
        var x2 = x1 + el.offsetWidth + padding;
        var y2 = y1 + el.offsetHeight + padding;

        if((x1 <= this.x) && (this.x <= x2) && (y1 <= this.y) && this.y <= y2) {
            overlaps = true;
        }

	});

	return overlaps;

}

/**
 * StarFactory to create stars at random positions
 * @type {Object}
 */
let StarFactory = {
	getRandomPosition: function(width, height) {
		return {
			x: Math.floor(Math.random() * width),
			y: Math.floor(Math.random() * height)
		}
	},
	createStar: function(width, height, type) {
		const coordinates = this.getRandomPosition(width, height);
		return new Star(coordinates.x, coordinates.y, type);
	}
}

/**
 * StarField object
 * @param {string}  		containerId id for the star container
 * @param {number}  		totalStars  number of total stars
 * @param {Boolean/string} 	exclude     selector that stars shouldn't enter (false for none)
 * @param {Number}  		spacing     minimum spacing from one star to the next
 */
let StarField = function(containerId, totalStars, spacing = 10, exclude = false) {
	// Star container
	this.element = containerId;
	this.container = document.getElementById(this.element);
	this.containerWidth = 0;
	this.containerHeight = 0;
	this.spacing = spacing;
	this.exclude = exclude;

	// Stars
	this.starArray = [];
	this.totalStars = totalStars;
	this.plusStarRatio = 5;

	// Offset excluded title x and y
	this.leftOffset = 0;
	this.topOffset = 0;
};

/**
 * Push star object to the starArray
 */
StarField.prototype.createArray = function() {
	// Max loop attempts
	let maxAttempts = this.totalStars * 3;

	while(this.starArray.length < this.totalStars && maxAttempts > 0) {
		let available = true;
		const star = StarFactory.createStar(this.containerWidth, this.containerHeight, 'none');

		// Check if star is inside specified element
		if(!star.insideElement(this.exclude, 50, this.leftOffset, this.topOffset)) {
			// Check if overlapping with other stars 
			for (let i = this.starArray.length - 1; i >= 0; i--) {
				if(star.distance(this.starArray[i].x, this.starArray[i].y) < this.spacing) {
					available = false;
					break;
				}
			}
			if(available) {
				// Check if type should be plus or round
				this.starArray.length % this.plusStarRatio === 0 ? star.type = 'plus' : star.type = 'round';

				// Push to the starArray
				this.starArray.push(star);
			}
		}

		maxAttempts -= 1;
	}
}

/**
 * Appends the starArray to the star container
 */
StarField.prototype.appendStars = function() {
	for (let i = this.starArray.length - 1; i >= 0; i--) {
		const star = this.starArray[i];
		const starStyle = 'top: ' + star.y + 'px; ' + 'left: ' + star.x + 'px';
		const node = document.createElement('div');

		switch(star.type) {
			case 'round':
				this.container.appendChild(node).classList.add('round-star');
				break;
			case 'plus':
				this.container.appendChild(node).classList.add('plus-star');
				break;
			default:
				this.container.appendChild(node).classList.add('round-star');
				break;
		}

		node.setAttribute('style', starStyle);
	}
}

/**
 * Use anime.js to display the stars
 */
StarField.prototype.animateStars = function() {
	anime({
		targets: '#' + this.element + ' .round-star',
		scale: function() {
			return [0, anime.random(4, 10) / 10];
		},
		opacity: function(el, i) {
			return i % 2 ? anime.random(3, 8) / 10 : 1;
		},
		delay: function(el, i) {
			return i + 40 * anime.random(20, 70);
		}
	});

	anime({
		targets: '#' + this.element + ' .plus-star',
		scale: function() {
			return [0, anime.random(6, 10) / 10];
		},
		delay: function(el, i) {
			return i * anime.random(200, 500);
		}
	});
}

/**
 * Init function to set up everything and display the stars
 */
StarField.prototype.init = function() {
	// Container width and height
	this.containerWidth = this.container.offsetWidth;
	this.containerHeight = this.container.offsetHeight;
	// Reset container and starArray
	this.container.innerHTML = '';
	this.starArray = [];
	// Create starArray, appendStars and animate them
	this.createArray();
	this.appendStars();
	this.animateStars();
}

export default StarField;