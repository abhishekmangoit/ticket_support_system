$(document).ready(function () {
    $("#ticketForm").validate({
      rules: {
        title: { required: true, minlength: 2, },
        category: {required: true},
        details: {required: true},
      },
      messages: {
        title: {
          required: "The name field is required.",
          minlength: "The name field must be at least 2 characters.",
        },
        category: {
          required: "The category field is required.",
        },
        details: {
            required: "The details field is required.",
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
  
  