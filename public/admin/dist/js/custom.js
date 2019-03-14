$(function () {
CKEDITOR.replaceAll( 'details' );

    //Pagination
    $(document).ready(function(){
        $('.pag').dataTable();
    });

    // Steps to set the active sidebar link
    // 1- Get the current url
    var currentUrl = window.location.href;
    // 2- Get the last segment of the url
    var segment = currentUrl.split('/').pop();
    // 3- Add the "active" class to the id in sidebar of the current url
    $('#' + segment + '-link').addClass('active');

    //Popup
    $('.open-popup').on('click', function () {
        btn = $(this);
        url = btn.data('target');

        modalTarget = btn.data('modal-target');

        // remove the target from the page

        $(modalTarget).remove();

        $.ajax({
            url: url,
            type: 'POST',
            success: function (html) {
                $('body').append(html);
                $(modalTarget).modal('show');
            },
        });
               /*
        if ($(modalTarget).length > 0) {
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

    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    });

    //edit $ new Form
    $(document).on('click', '.submit-btn', function (e) {
        btn = $(this);

        e.preventDefault();

        form = btn.parents('.form');

        if (form.find('#details').length) {
            // if there is an element in the form has an id 'details'
            // then add the value for it to be gotten from ckeditor
            form.find('#details').val(CKEDITOR.instances.details.getData());
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


    /* Deleting */
    $('.delete').on('click', function (e) {
        e.preventDefault();

        button = $(this);

        var c = confirm('êtes-vous sûre ?');

        if (c === true) {
            $.ajax({
                url: button.data('target'),
                type: 'POST',
                dataType: 'JSON',
                beforeSend: function () {
                    $('#results').removeClass().addClass('alert alert-info').html('Suppression...');
                },
                success: function(results) {
                    if (results.success) {
                        $('#results').removeClass().addClass('alert alert-success').html(results.success);
                        tr = button.parents('tr');

                        tr.fadeOut(function () {
                           tr.remove();
                        });
                    }
                }
            });
        } else {
            return false;
        }
    });
});


 $('.datepicker').datepicker();

  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });