$(document).ready(function () {
    $("#userForm").validate({
      rules: {
        name: { required: true, minlength: 2, },
        email: { required: true, email: true,},
        password: {required: true, minlength: 8},
        confirmPassword: {required: true, equalTo: "#password"},
        status: { required: true, },
        role: { required: true, },
      },
      messages: {
        name: {
          required: "The name field is required.",
          minlength: "Please enter at least 2 character",
        },
        email: {
            required: "The email field is required.",
            email: "The email field must be a valid email address.",
          },
        password: {
            required: "The password field is required.",
            minlength: "The password field must be at least 8 characters.",
        },
        confirmPassword: {
            required: "The confirm password field is required.",
            equalTo: "The password field confirmation does not match.",
        },
        status: {
          required: "The status field is required.",
        },
        role: {
            required: "The role field is required.",
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
  
  