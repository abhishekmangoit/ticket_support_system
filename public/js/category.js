$(document).ready(function () {
    $("#categoryForm").validate({
      rules: {
        name: { required: true, minlength: 2, },
        status: { required: true, },
      },
      messages: {
        name: {
          required: "The name field is required.",
          minlength: "The name field must be at least 2 characters.",
        },
        status: {
          required: "The status field is required.",
        },
      },
      errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
  
    
  });
//    //document .ready ends here
  
  