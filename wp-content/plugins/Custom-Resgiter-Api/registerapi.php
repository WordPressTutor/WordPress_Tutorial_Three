<?php
/*
Plugin Name: Resgistration Api
Description: A Simple API endpoint that return "resgiter form"
Version: 1.0
Author: WordPress Tutorial
*/

function registration_api_script()
{
    wp_enqueue_script('registration-api', plugin_dir_url(__FILE__) . 'registration.js', array('jquery'), '1.0', true);
    wp_localize_script('registration-api', 'registrationApiSettings', array(
        'restApiUrl' => esc_url_raw(rest_url('jwt-auth/v1/token')),
    ));
}

add_action('wp_enqueue_scripts', 'registration_api_script');

function registration_api_callback() {


    $username = sanitize_text_field($_POST['register_data']['username']);
    $password = sanitize_text_field($_POST['register_data']['password']);
    $email = sanitize_email($_POST['register_data']['email']);
    $phone = sanitize_text_field($_POST['register_data']['phone']);

    $hashed_password = wp_hash_password($password);

    $user_id = wp_create_user($username, $hashed_password, $email);

    update_user_meta($user_id, 'phone', $phone);

    $response = array(
        'message' => 'User registered successfully',
        'user_id' => $user_id,
    );

    wp_send_json($response);
}

add_action('rest_api_init', function() {
    register_rest_route('jwt-auth/v1', 'token', array(
        'methods' => 'POST',
        'callback' => 'registration_api_callback',
    ));
});



function registeration_form()
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration Form</title>
        <!-- Link to Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Registration Form</h3>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <!-- Username Field -->
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <!-- Password Field -->
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <!-- Email Field -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <!-- Phone Number Field -->
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                <!-- Submit Button -->
                                <button type="submit" id="submit" class="btn btn-primary btn-block">Register</button>
                            </form><br><br>
                            <button id="update-profile" class="btn btn-primary btn-block">Update User Profile</button>
                            <!-- End Registration Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>

<?php
}

add_shortcode('registeration-form', 'registeration_form');





