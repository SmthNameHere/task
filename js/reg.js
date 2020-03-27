$('#reg_user').click(function() {
  var name = $('#username').val();
  var email = $('#email').val();
  var login = $('#login').val();
  var pass = $('#pass').val();
  var passagain = $('#passagain').val();
  var url = "auth.php";

  $.ajax({
    url: 'ajax/reg.php',
    type: 'POST',
    cache: false,
    data: {'username': name, 'email' : email, 'login' : login, 'pass' : pass, 'passagain' : passagain},
    dataType: 'html',
    success: function(data) {
      dataj = JSON.parse(data);
      if(dataj['result'] == 'ok') {
        $('#reg_user').text('Все готово');
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
