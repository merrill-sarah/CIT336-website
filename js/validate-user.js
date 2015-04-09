// Uses jquery syntax.
// These functions do some basic client-side validation and then submit the forms.
// Server-Side validation should still be done.

$(document).ready(function() {
	
	$('#buttLogin').click(function() {
            $('#loginform').submit();
	});
	
	$('#buttRegister').click(function() {
            $('#registerform').submit();
	});
});


(function($,W,D)
{
    var JQUERY4U = {};
 
    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#registerform").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    username: {
                        required: "Please enter a username",
                        minlength: "Your username must be at least 3 characters long"
                    },
                    password: {
                        required: "Please enter a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirm_password: {
                        required: "Please confirm your password",
                        equalTo: "Password does not match"
                    },
                    email: "Please enter a valid email address"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            
        }
    };
 
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });
 
})(jQuery, window, document);
