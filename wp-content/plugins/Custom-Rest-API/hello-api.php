<?php
/*
Plugin Name: Hello API
Description: A simple API endpoint that returns "Hello, World!"
Version: 1.0
Author: WordPress Tutorial
*/
function hello_api_callback()
{
    $response = array(
        'message' => 'Hello, World!'
    );

    wp_send_json($response);
}

add_action('rest_api_init', function () {
    register_rest_route('hello-api/v1', '/hello', array(
        'methods' => 'GET',
        'callback' => 'hello_api_callback',
    ));
});

function hello_api()
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hello API Demo</title>
        <script src="path/to/script.js" defer></script>
    </head>

    <body>
        <button id="getHello">Get Hello Message</button>
        <div id="helloResponse"></div>
    </body>
    <script>
        jQuery(document).ready(function() {
            jQuery('#getHello').click(function() {
                jQuery.ajax({
                    url: 'http://localhost/site3/wp-json/hello-api/v1/hello',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        jQuery('#helloResponse').text(data.message);
                    },
                });
            }); 
        }); 
    </script>

    </html>
<?php
}

add_shortcode('hello-api', 'hello_api');

