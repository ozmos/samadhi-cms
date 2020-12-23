"use strict";
/**
 * basic form validation using constraint validation browser API https://developer.mozilla.org/en-US/docs/Learn/Forms/Form_validation
 **/
 
// wrap code in IIFE to prevent scope pollution
(function validateContactForm() {
	// form elements
    var form = $('#contact-form');
    var textArea = form['message'];
    var nameInput = form['name'];
    var emailInput = form['email'];

   	 // pattern match function
	function matchPattern({pattern, input, element, error}) {
		if (!pattern.test(input)) {
			element.setAttribute('aria-invalid', true)
			element.setCustomValidity(error);

		} else {
			element.setCustomValidity('');
			element.setAttribute('aria-invalid', false)
		}
	}

	// reusable closure function for convenient event handler function creation
	function validatePattern(regex, inputElement) {
		// function returns event handler function preloaded with parameters for matchPattern from parent scope parameters
		return function handleInputEvent(event) {
			var parameters = {
    		pattern: regex, 
   			input: event.target.value,
   			element: inputElement,
   			error: inputElement.title
	    	}
   		matchPattern(parameters)
		}
	}

	// create event handler functions
	var handleNameInput = validatePattern(/^[a-zA-Z\.,\- ]*$/, nameInput);
	var handleTextAreaInput = validatePattern(/^[a-zA-Z0-9\?\.,'\- ]*$/, textArea);
	var handleEmailInput = validatePattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/, emailInput);
  
  	// add event handlers
  	textArea.addEventListener('blur', handleTextAreaInput);
    nameInput.addEventListener('blur', handleNameInput);
    emailInput.addEventListener('blur', handleEmailInput);
    textArea.addEventListener('input', handleTextAreaInput);
    nameInput.addEventListener('input', handleNameInput);
    emailInput.addEventListener('input', handleEmailInput);
    return;
})();

