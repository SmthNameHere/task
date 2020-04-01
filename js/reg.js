function funcSuccess(data){
  var url = "auth.php";
  if(data['result'] == 'ok') {
    $('#reg_user').text('Все готово');
    $('#errorBlock').hide();
    //document.location.reload(true);
    $(location).attr('href',url);
  } else {
    $('#errorBlock').show();
    $('#errorBlock').text(data['result']);
  }
}

$(document).ready(function(){
  $('#reg_user').click(function() {
    var name = $('#username').val();
    var email = $('#email').val();
    var login = $('#login').val();
    var pass = $('#pass').val();
    var passagain = $('#passagain').val();
    var pattern = /^[a-z0-9]+$/i;
    if (pattern.test(name) && pattern.test(login)){
    $.ajax({
      url: 'ajax/reg.php',
      type: 'POST',
      cache: false,
      data: {'username': name, 'email' : email, 'login' : login, 'pass' : pass, 'passagain' : passagain},
      dataType: 'json',
      success: funcSuccess
    });
  }
  else {alert('Только латинские символы!');}
  });
});
