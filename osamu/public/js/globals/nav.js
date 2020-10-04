"use strict";
//reusable class toggle function:
// ontouchstart="classToggle('nav', 'toggle-reveal')"
// 
(function navigationToggleButton () {
	const button = document.getElementById('menu-toggle');

	function classToggle(id, className) {
	 	return document.getElementById(id).classList.toggle(className);
	}

	function navToggle() {

		classToggle('nav', 'toggle-reveal');
	
	}

	function handleTouchStart(event) {
		navToggle();
		event.preventDefault();
		event.stopPropagation();
	}

	function handleNavPress(event) {
		var enterOrSpace = event.keyCode == 13 || event.keyCode == 32;
		if (event.target.id === 'menu-toggle' && enterOrSpace) {
			navToggle();
		}
		event.target.blur();
		event.preventDefault();
		event.stopPropagation();
	}

	
	(function addClassToggle (){
		button.addEventListener('touchstart', handleTouchStart, false);
	})();

	(function addKeyboardToggle() {
		button.addEventListener('keydown', handleNavPress, false);
	})();

	return button;
})();
