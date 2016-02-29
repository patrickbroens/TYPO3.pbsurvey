window.Parsley.addValidator('matrixMincheck', {
	requirementType: 'integer',
	validateNumber: function (value, requirement, validator) {
		var container = jQuery(validator.$element).closest('[data-pbsurvey-matrix]');
		var amount = container.find('input[type=radio]:checked').length;
		return 0 === amount || amount >= requirement;
	},
	messages: {
		en: 'Not all of %s options have been selected'
	}
});

window.Parsley.addValidator('matrixTextRequired', {
	requirementType: 'integer',
	validateString: function (value, requirement, validator) {
		var container = jQuery(validator.$element).closest('[data-pbsurvey-matrix]');
		var amount = container.find('input[type=text]').filter(function () {
			return $(this).val() != ''
		}).length;
		return amount >= requirement;
	},
	messages: {
		en: 'Enter at least %s value'
	}
});

var pbsurveyForm = jQuery('#pbsurvey-form');

pbsurveyForm.parsley()
	.on('field:validated', function () {
		var ok = $('.parsley-error').length === 0;
		$('.bs-callout-info').toggleClass('hidden', !ok);
		$('.bs-callout-warning').toggleClass('hidden', ok);
	})
	.on('form:submit', function () {
		return false; // Don't submit form for this demo
	});

// Uncheck radio button in the same row of a matrix
pbsurveyForm.find(':input[data-pbsurvey-row]').click(function () {
	var row = jQuery(this).attr('data-pbsurvey-row');
	jQuery('input[data-pbsurvey-row="' + row + '"]').not(jQuery(this)).each(function () {
		this.checked = false;
	});
});