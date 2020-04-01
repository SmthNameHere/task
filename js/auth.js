function funcSuccess(data){
  var url = "index.php";
  //console.log(data);
  if(data["result"] == "ok") {
    $('#auth_user').text('Готово');
    $('#errorBlock').hide();
    //document.location.reload(true);
    $(location).attr('href',url);
  } else {
    $('#errorBlock').show();
    $('#errorBlock').text(data['result']);
  }
}


$(document).ready(function(){
  $('#auth_user').click(function() {
    var login = $('#login').val();
    var pass = $('#pass').val();
    var pattern = /^[a-z0-9]+$/i;
    if (pattern.test(login)){
    $.ajax({
      url: 'ajax/auth.php',
      type: 'POST',
      cache: false,
      data: {'login' : login, 'pass' : pass},
      dataType: 'json',
      //beforeSend:funcBefore,
      success: funcSuccess
    });
  }
  else {alert('Только латинские символы!');}
  });
});
