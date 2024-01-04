jQuery(document).ready(function ($) {
    var modal = $('#modalDialog');
    var btn = $("#mbtn");
    var span = $(".close");

    btn.on('click', function () {
        modal.show();
    });

    span.on('click', function () {
        modal.hide();
    });

    $('body').bind('click', function (e) {
        if ($(e.target).hasClass("modal")) {
            modal.hide();
        }
    });

   

    $('#submit').click(function (event) {
        event.preventDefault();

        // Gather form data
        var quota_data={
            'fname': $('input[name="fname"]').val(),
            'lname': $('input[name="lname"]').val(),
            'email': $('input[name="email"]').val(),
            'phone': $('input[name="phone"]').val(),
            'size': $('input[name="size"]').val(),
            'length': $('input[name="length"]').val(),
            'title': $('input[name="title"]').val(),
            'description': $('textarea[name="description"]').val(),
        }

        // Ajax request
        $.ajax({
            type: 'POST',
            url: custom_script_params.ajax_url,
            data: {
                action: 'save_special_quota',
                quota_data: quota_data, 
              
            },
            success: function (response) {
                alert(response);
            }
        });
    });
});
