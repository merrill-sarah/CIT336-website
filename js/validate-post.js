///Hmmm, wonder why

$(document).ready(function() {
	
	$('#submitPost').click(function() {
            $('#newPostForm').submit();
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
            $("#newPostForm").validate({
                rules: {
                    postTitle: {
                        required: true,
                        minlength: 2
                    },
                    postContent: {
                        required: true
                    }
                },
                messages: {
                    postTitle: {
                        required: "Please enter a title",
                        minlength: "Title must be at least 2 characters long"
                    },
                    postContent: {
                        required: "Please enter post content"
                    }
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