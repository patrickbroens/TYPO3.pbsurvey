window.Parsley.addValidator('matrixMincheck', {
	requirementType: 'integer',
	validateNumber: function (value, requirement, parsleyInstance) {
		var container = jQuery(parsleyInstance.$element).closest('[data-pbsurvey-matrix]');
		var amount = container.find('input[type=radio]:checked').length;
		return 0 === amount || amount >= requirement;
	},
	messages: {
		en: 'Not all of %s options have been selected'
	}
});

window.Parsley.addValidator('textMinimum', {
	requirementType: ['integer', 'boolean'],
	validateString: function (value, minimum, mandatory, parsleyInstance) {
		var container = jQuery(parsleyInstance.$element).closest('[data-pbsurvey-matrix]');
		var amount = container.find('input[type=text]').filter(function () {
			return $(this).val() != ''
		}).length;
		return (!mandatory && amount === 0) || amount >= minimum;
	},
	messages: {
		en: 'Enter at least %s value'
	}
});

window.Parsley.addValidator('textMaximum', {
	requirementType: 'integer',
	validateString: function (value, maximum, parsleyInstance) {
		var container = jQuery(parsleyInstance.$element).closest('[data-pbsurvey-matrix]');
		var amount = container.find('input[type=text]').filter(function () {
			return $(this).val() != ''
		}).length;
		return amount <= maximum;
	},
	messages: {
		en: 'Enter no more than %s values'
	}
});

window.Parsley.addValidator('textRange', {
	requirementType: ['number', 'number', 'boolean'],
	validateString: function (value, minimum, maximum, mandatory, parsleyInstance) {
		var container = jQuery(parsleyInstance.$element).closest('[data-pbsurvey-matrix]');
		var amount = container.find('input[type=text]').filter(function () {
			return $(this).val() != ''
		}).length;
		return (!mandatory && amount === 0) || (amount >= minimum && amount <= maximum);
	},
	messages: {
		en: 'Enter at least %s and no more than %s values'
	}
});

window.Parsley.addValidator('equals', {
	requirementType: 'integer',
	validateNumber: function (value, requirement) {
		return 0 === value || value === requirement;
	},
	messages: {
		en: 'The sum of all answers must add up to %s'
	}
});

window.Parsley.addValidator('dateMinimum', {
	requirementType: 'string',
	validateString: function (value, requirement) {
		var timestamp = new Date(value.replace(/(\d{2})-(\d{2})-(\d{4})/, '$2/$1/$3'));
		var minimumTimeStamp = new Date(requirement.replace(/(\d{2})-(\d{2})-(\d{4})/, '$2/$1/$3'));
		return '' === value || isNaN(timestamp) ? false : timestamp >= minimumTimeStamp;
	},
	messages: {
		en: 'Enter a date that is greater than or equal to %s'
	}
});

window.Parsley.addValidator('additional', {
	requirementType: 'string',
	validateMultiple: function (value, requirement, parsleyInstance) {
		var checked = jQuery.inArray('-1', value) > -1;
		var additional = jQuery(parsleyInstance.$element).attr('data-parsley-additional');
		var additionalValue = jQuery('.' + additional).val();
		return !checked || additionalValue != '';
	},
	validateString: function (value, requirement, parsleyInstance) {
		var checked = value === '-1';
		var additional = jQuery(parsleyInstance.$element).attr('data-parsley-additional');
		var additionalValue = jQuery('.' + additional).val();
		return !checked || additionalValue != '';
	},
	messages: {
		en: 'Enter the additional value'
	}
});

window.Parsley.addValidator('dateMaximum', {
	requirementType: 'string',
	validateString: function (value, requirement) {
		var timestamp = new Date(value.replace(/(\d{2})-(\d{2})-(\d{4})/, '$2/$1/$3'));
		var minimumTimeStamp = new Date(requirement.replace(/(\d{2})-(\d{2})-(\d{4})/, '$2/$1/$3'));
		return '' === value || isNaN(timestamp) ? false : timestamp <= minimumTimeStamp;
	},
	messages: {
		en: 'Enter a date that is less than or equal to %s'
	}
});



var pbsurveyForm = jQuery('#pbsurvey-form');

pbsurveyForm.parsley()
	.on('field:validated', function () {
		var ok = $('.parsley-error').length === 0;
		$('.page-error').toggleClass('hidden', ok);
	//})
	//.on('form:submit', function () {
	//	return false; // Don't submit form for this demo
	});

// Uncheck radio button in the same row of a matrix
pbsurveyForm.find('input[data-pbsurvey-row]').click(function () {
	var row = jQuery(this).attr('data-pbsurvey-row');
	jQuery('input[data-pbsurvey-row="' + row + '"]').not(jQuery(this)).each(function () {
		this.checked = false;
	});
});

// Reveal additional input
pbsurveyForm.find('input[data-pbsurvey-reveal]').change(function () {
	var checked = jQuery(this).is(':checked');
	var value = jQuery(this).val();
	var additional = jQuery(this).attr('data-pbsurvey-reveal');
	if (checked && value === '-1') {
		jQuery('.' + additional).show();
	} else {
		jQuery('.' + additional).hide();
	}
});

// Calculate total sum
pbsurveyForm.find('[data-pbsurvey-sum] input').change(function () {
	total = 0;
	var container = jQuery(this).closest('[data-pbsurvey-sum]');
	var sumField = jQuery('#' + container.attr('data-pbsurvey-sum'));
	container.find('input').not(sumField).each(function () {
		var value = parseInt(jQuery(this).val());
		total += isNaN(value) ? 0 : value;
	});
	sumField.val(total === 0 ? '' : total);
});