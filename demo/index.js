$(window).on('load',function(){
 $('#userPreferences').modal('show');
});

$('.form-group .btn').click(function(e) {
  e.preventDefault();
  $(this).addClass('active');
});
