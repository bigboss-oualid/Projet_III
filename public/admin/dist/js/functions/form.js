// don't work in posts form fix probelem after
//CKEDITOR.replaceAll('details');
/*open popup*/
$('.open-popup').on('click', function() {
	var btn = $(this);
	var url = btn.data('target');
	var modalTarget =  btn.data('modal-target');

	//remove the target from the page
	//$(modalTarget).remove();
	$.ajax({
			url: url,
			type: 'POST',
			success: function (html) {
				$('body').append(html);
				$(modalTarget).modal('show');
			},
		});
/*
	if($(modalTarget).length > 0){
		$(modalTarget).modal('show');
	} else {
		$.ajax({
			url: url,
			type: 'POST',
			success: function (html) {
				$('body').append(html);
				$(modalTarget).modal('show');
			},
		});
	}
*/
	return false;
});

/* store or update data */

$(document).on('click', '.submit-btn', function(e) {
	e.preventDefault();

	var btn = $(this);

	var form = btn.parents('.form');

	var url = form.attr('action');

	var data = new FormData(form[0]);

	var formResults = form.find('#form-results');

	var messageInput = form.find('.message-input');

	$.ajax({
		url: url,
		data: data,
		type: 'POST',
		dataType: 'json',
		beforeSend: function() {
			formResults.removeClass().addClass('alert alert-info').html('Chargement...')
		},
		success: function (results) {
			if (results.errors) {
				formResults.removeClass().addClass('alert alert-danger').html(results.errors);
				messageInput.removeClass().addClass('form-group col-sm-12 has-error');
			}else if (results.success) {
				formResults.removeClass().addClass('alert alert-success').html(results.success);
			}

			if (results.redirectTo) {
				window.location.href = results.redirectTo;
			}
		},			
		cache: false,
		processData: false,
		contentType: false,
	});	
});

/*Deleting data*/
$('.delete').on('click', function (e){
	e.preventDefault();

	button = $(this);

	var c = confirm('Êtes-vous sûr de vouloir supprimer');

	if (c === true) {
		$.ajax({
			url: button.data('target'),
			type: 'POST',
			dataType: 'JSON',
			beforeSend: function() {
				$('#results').removeClass().addClass('alert alert-info').html('Suppression...');
			},
			success: function (results) {
				if (results.success) {
					$('#results').removeClass().addClass('alert alert-success').html(results.success);
					tr = button.parents('tr');

					tr.fadeOut(function(){
						tr.remove();
					});
				}

			},
		});

	} else {
		return false;
	}
});


/*Modify data*/
$('.modify').on('click', function (e){
	e.preventDefault();

	button = $(this);

	var c = confirm('êtes vous sure?');

	if (c === true) {
		$.ajax({
			url: button.data('target'),
			type: 'POST',
			dataType: 'JSON',
			beforeSend: function() {
				$('#modification').removeClass().addClass('alert alert-info').html('Modification...');
			},
			success: function (results) {
				if (results.success) {
					$('#modification').removeClass().addClass('alert alert-success').html(results.success);
					div = button.parents('div');

					div.fadeOut(function(){
						div.remove();
					});
				} else if (results.errors) {
					$('#modification').removeClass().addClass('alert alert-danger').html(results.errors);
				}

			},
		});

	} else {
		return false;
	}
});
