$(function () {
    adjustFooter();

    "use strict";
    
    new WOW().init();

    $(".dropdown").hover(function () {
        $(this).toggleClass('open');
    });

    $('.placeholder').each(function () {
        var input = $(this),
            placeholder = input.attr('placeholder');

        input.attr('data-placeholder', placeholder);
        input.attr('placeholder', '');
        input.val(placeholder);
    }).on('focus', function () {
        var input = $(this),
            placeholder = input.attr('data-placeholder'),
            inputVal = input.val();

        if (inputVal == placeholder) {
            input.val('');
        }
    }).on('focusout', function () {
        var input = $(this),
            placeholder = input.attr('data-placeholder'),
            inputVal = input.val();

        if (inputVal == '') {
            input.val(placeholder);
        }
    });

    //Report Comment
    $('#report-form').submit( function () {

        var choice = confirm($(this).attr('data-confirm'));

        if (choice) {
            return true;
        }
        else{
            return false;
        }
    });

    // submit form
    $(document).on('click', '.submit-btn', function (e) {
        btn = $(this);

        e.preventDefault();

        form = btn.parents('.form');

        // check if the form inputs values are the same as thier palceholders
        // if so, then we will just make them empty

        form.find('input').each(function () {
            input = $(this);
            placeholder = input.attr('data-placeholder');

            if (! placeholder) return false;

            if (input.val() == placeholder) {
                input.val('');
            }
        });

        if (form.find('#message').length) {
            // if there is an element in the form has an id 'details'
            // then add the value for it wich be gotten from tinymce to form
            form.find('#message').val(tinymce.get("message").getContent());
        }

        url = form.attr('action');

        data = new FormData(form[0]);

        formResults = form.find('#form-results');

        $.ajax({
            url: url,
            data: data,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                formResults.removeClass().addClass('alert alert-info').html('Chargement...');
            },
            success: function(results) {
                if (results.errors) {
                    formResults.removeClass().addClass('alert alert-danger').html(results.errors);
                }else if (results.warnings) {
                  formResults.removeClass().addClass('alert alert-warning').html(results.warnings);
                } else if (results.success) {
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
});

function adjustFooter() {
    setFixedFooter();
    $(window).on('resize', function () {
        setFixedFooter();
    });
}

function setFixedFooter() {
    var footer = $('footer');

    var body = $('body');

    if (body.height() < $(window).height()) {
        footer.addClass('fixed-footer');
    } else {
        footer.removeClass('fixed-footer');
    }
}