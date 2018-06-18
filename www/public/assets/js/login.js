$(function(){
    // Reveal Login form
    setTimeout(function(){
        $(".fade-in-effect").addClass('in');
    }, 50);

    // Validation and Ajax action
    $("form#login").validate({
        rules: {
            username: {
                required: true
            },

            password: {
                required: true
            }
        },

        messages: {
            username: {
                required: '请输入商户号'
            },
            password: {
                required: '请输入商户密码'
            }
        },

        // Form Processing via AJAX
        submitHandler: function(form)
        {
            show_loading_bar(77); // Fill progress bar to 77% (just a given value)
            $.ajax({
                url: "/login",
                method: 'POST',
                dataType: 'json',
                data: {
                    do_login: true,
                    username: $(form).find('#username').val(),
                    password: $(form).find('#password').val()
                },
                success: function(resp)
                {
                    console.log(resp);
                    show_loading_bar({
                        delay: .5,
                        pct: 100,
                        finish: function(){
                            // Redirect after successful login page (when progress bar reaches 100%)
                            if(resp.code == 0)
                            {
                                toastr.success( resp.msg);
                                setTimeout(function () {
                                    window.location.href = "/";
                                },1200);
                            }
                        }
                    });
                    // Remove any alert
                    $(".errors-container .alert").slideUp('fast');

                    // Show errors
                    if(resp.code !== 0)
                    {
                        $(".errors-container").html('<div class="alert alert-danger">\
												<button type="button" class="close" data-dismiss="alert">\
													<span aria-hidden="true">&times;</span>\
													<span class="sr-only">x</span>\
												</button>\
												' + resp.msg + '\
											</div>');

                        $(".errors-container .alert").hide().slideDown();
                        $(form).find('#password').select();
                    }
                }
            });

        }
    });
    // Set Form focus
    $("form#login .form-group:has(.form-control):first .form-control").focus();

});