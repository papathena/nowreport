$(document).ready(function() {

	checkSize();

	$(window).resize(function(event) {
		checkSize();
	});
	
	function checkSize(argument) {
		if (!window.matchMedia("(max-width: 768px)").matches) {	    
			$(".menu").stick_in_parent();
		} else {
			$('.menu').trigger("sticky_kit:detach");
		}
	}

	//$(".menu").stick_in_parent();



	$('[data-touch="showpass"]').click(function(event) {
		event.stopPropagation();
		event.preventDefault();
		var getInput = $(this).parent().parent().find('input');
		if (getInput.attr('type') === 'password') {
			getInput.prop('type', 'text');
			$(this).addClass('cross');
		} else {
			getInput.prop('type', 'password');
			$(this).removeClass('cross');
		}
	});

	
	$('[data-act="js-touch"]').click(function(event) {
		event.stopPropagation();
		$(this).find('[data-act="js-show"]').toggleClass('open');
	});


	
	$('[data-act="js-drop"]').click(function(event) {
		event.stopPropagation();
		$(this).toggleClass('open');
		event.preventDefault();
		$(this).next('[data-act="js-show"]').toggleClass('open');
	});


	$('.popshow__content').click(function(event) {
		event.stopPropagation();
	});

	$('[data-touch="popup"]').click(function(event) {
		event.stopPropagation();
		$('[data-show="popup"]').addClass('open');
	});

	$('[data-touch="close"]').click(function(event) {
		event.stopPropagation();
		event.preventDefault();
		var target = $(this).attr('data-target');
		console.log(target);
		$('[data-show="'+target+'"]').removeClass('open');
	});
	
	$('.authpage__input').change(function(event) {

		if ($(this).val() != '') {
			$(this).next('label').addClass('stayed');
		} else {
			$(this).next('label').removeClass('stayed');
		}

	});

	$('input[data-type="range"]').daterangepicker({
		locale: {
        	"format": "DD/MM/YYYY",
    	}
	});

	
	$('input[data-type="range-single"]').daterangepicker({

	    showDropdowns: true,
	    ranges: {
	        'This Month': [moment().startOf('month'), moment().endOf('month')],
	        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
	        'Last 2 Months': [moment().subtract(2, 'month').startOf('month'), moment().subtract(2, 'month').endOf('month')],
	        'Last 3 Months': [moment().subtract(3, 'month').startOf('month'), moment().subtract(3, 'month').endOf('month')],
	        'Last 6 Months': [moment().subtract(6, 'month').startOf('month'), moment().subtract(6, 'month').endOf('month')],
	        'Last Year': [moment().subtract(12, 'month').startOf('month'), moment().subtract(12, 'month').endOf('month')],
	    },
	    "linkedCalendars": false,
	    "showCustomRangeLabel": true,
	     "alwaysShowCalendars": true,
	    "opens": "center",
	  
	});

	$('table[data-table="sorter"]').tablesorter();

	$('.rdrop').click(function(event) {
		event.stopPropagation();
		$(this).next('.rdrop__act').toggleClass('open');
	});
	$('.sdrop').click(function(event) {
		event.stopPropagation();
		$(this).next('.sdrop__act').toggleClass('open');
	});
	$('.rdrop__act,.sdrop__act').click(function(event) {
		event.stopPropagation();
	});

	$('.options-multi').click(function(event) {
		var get = $(this);
		var name = 'options';

		get.find('input[type="checkbox"]').change(function(event) {

			var count = get.find('input[type="checkbox"]:checked').length;

			if (count > 0) {
				get.parent().find('.rdrop__count').html('('+count+')');
			} else {
				get.parent().find('.rdrop__count').html(name);
			}
			if (count >= 5) {
				
				get.find('input[type="checkbox"]').each(function(index, el) {
					if ($(this).is(':checked')) {
						$(this).removeAttr('disabled');
					} else {
						$(this).attr('disabled','disabled');
					}
				});
			} else {
				get.find('input[type="checkbox"]').removeAttr('disabled');
			}
		});


	});

	$('.options-single').click(function(event) {
		var get = $(this);

		get.find('input[type="radio"]').change(function(event) {
			var text = $(this).parent().text();
			get.parent().find('.sdrop__item-title').html(text);

			get.removeClass('open');

		});


	});

	$(window).click(function() {
		$('.open').each(function(index, el) {
			if (!$(this).hasClass('menu__drop') && !$(this).hasClass('menu__link')) {
				$(this).removeClass('open');
			}
		});
	});


	$('.m-menu').click(function(event) {
		event.stopPropagation();
		event.preventDefault();
		$(this).toggleClass('open');
		$(this).toggleClass('closed');
		$('.sidebar').toggleClass('open');

	});

	$('.header__brand-mobile').click(function(event) {
		event.stopPropagation();
		$('.dropmenu__brand').toggleClass('open');
		$('.sidebar').removeClass('open');

	});

	$('.filter__dots').click(function(event) {
		event.stopPropagation(); 
		$(this).next('.filter__menu').toggleClass('open');
	});

	var start = moment().subtract(1, 'month');
    var end = moment();


	$('#startMonth').MonthPicker({ 
      Button: false,
      ShowIcon: false,
      MonthFormat: 'M, yy',
    }).val(start.format('MMM, YYYY'));;
	$('#endMonth').MonthPicker({ 
      Button: false,
      ShowIcon: false,
      MonthFormat: 'M, yy',
    }).val(end.format('MMM, YYYY'));;
});
