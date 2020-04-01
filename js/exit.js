$('#exit_btn').click(function() {
$.ajax({
  url: 'ajax/exit.php',
  type: 'POST',
  cache: false,
  data: {},
  dataType: 'html',
  success: function(data) {
    document.location.reload(true);
  }
});
});
