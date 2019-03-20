 $(function () {
    var flag = false;
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });

    loginResults = $('#login-results');

    $('#login-form').on('submit', function (e) {
      e.preventDefault();

      if (flag === true){ return false;}

      form          = $(this);

      requestUrl    = form.attr('action');

      requestMethod = form.attr('method');

      requestData   = form.serialize();

      $.ajax({
        url : requestUrl,
        type: requestMethod,
        data: requestData,
        dataType: 'json',
        beforeSend: function () {
            flag = true;
            $('button').attr('disabled', true);
            loginResults.removeClass().addClass('alert alert-info').html('Connexion...');
        },
        success: function(results){
            if (results.errors) {
              loginResults.removeClass().addClass('alert alert-danger').html(results.errors);
               $('button').removeAttr('disabled');
               flag = false;
            }else if (results.warnings) {
              loginResults.removeClass().addClass('alert alert-warning').html(results.warnings);
              $('button').removeAttr('disabled');
              flag = false;
            } else if (results.success) {
              loginResults.removeClass().addClass('alert alert-success').html(results.success);

              if (results.redirect) {
                window.location.href = results.redirect;
              }
            }
        }
      });
    });
  });