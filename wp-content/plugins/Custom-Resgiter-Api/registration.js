jQuery(document).ready(function() {
   
    jQuery('#submit').click(function(e) {
        e.preventDefault();

    });
    jQuery('#submit').on('click', function() {
        var registerData = {
            username: jQuery('#username').val(),
            password: jQuery('#password').val(),
            email: jQuery('#email').val(),
            phone: jQuery('#phone').val(),
        };

        var token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3NpdGUzIiwiaWF0IjoxNzAwNzMyNzU4LCJuYmYiOjE3MDA3MzI3NTgsImV4cCI6MTcwMTMzNzU1OCwiZGF0YSI6eyJ1c2VyIjp7ImlkIjoiMSJ9fX0.w7kNrO7B0gorlk04vb_5hkwcQglU00I9fd2hzyRaok8";

        jQuery.ajax({
            url: 'http://localhost/site3/wp-json/jwt-auth/v1/token',
            type: 'post',
            headers: {
                'Authorization': 'Bearer ' + token,
            },
            data: {
                action: 'registration_api_callback',
                register_data: registerData,
            },
            dataType: 'json',            
            success: function(response) {
                alert(response.message);
                jQuery('#username').val('');
                jQuery('#password').val('');
                jQuery('#email').val('');
                jQuery('#phone').val('');
            },
            error: function(error) {
                console.error(error);
            },

        });
    });

    jQuery(document).ready(function(){
        jQuery('#update-profile').click(function(){
            window.location.href = "http://localhost/site3/registration-api/update-user-profile/";
        });
    });
});
