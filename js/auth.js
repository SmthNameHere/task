  $('#auth_user').click(function() {
    var login = $('#login').val();
    var pass = $('#pass').val();
    var url = "index.php";
    $.ajax({
      url: 'ajax/auth.php',
      type: 'POST',
      cache: false,
      data: {'login' : login, 'pass' : pass},
      dataType: 'html',
      success: function(data) {
        console.log(data);
        dataj = JSON.parse(data);
        if(dataj['result'] == 'ok') {
          $('#auth_user').text('Готово');
          $('#errorBlock').hide();
          //document.location.reload(true);
          $(location).attr('href',url);
        } else {
          $('#errorBlock').show();
          $('#errorBlock').text(dataj['result']);
        }
      }
    });
  });
