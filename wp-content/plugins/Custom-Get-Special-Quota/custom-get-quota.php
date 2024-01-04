<?php
/*
Plugin Name: Custom Get Special Quota
Description: Get special quota
Version: 1.0
Author: WordPress Tutorial
*/
// Enqueue scripts and styles
function enqueue_custom_scripts_and_styles() {
    wp_enqueue_script('custom-script', plugins_url('custom-get-quota.js', __FILE__), array('jquery'), '1.0', true);
    wp_enqueue_style('custom-style', plugins_url('custom-get-quota.css', __FILE__), array(), '1.0');

    wp_localize_script('custom-script', 'custom_script_params', array(
        'ajax_url'   => admin_url('admin-ajax.php'),
        'nonce'      => wp_create_nonce('save_special_quota_nonce'),
    ));
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts_and_styles');

// Add special quota button to product page
add_action('woocommerce_single_product_summary', 'add_special_quota_button', 25);

function add_special_quota_button() {
    ?>
    <div class="container">
        <button id="mbtn" class="btn btn-primary turned-button">Special Quota</button>

        <!-- The Modal -->
        <div id="modalDialog" class="modal">
            <div class="modal-content animate-top">
                <div class="modal-header">
                    <h5 class="modal-title">Contact Us</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span >×</span>
                    </button>
                </div>
                <form id="contactFrm" method="post">
                    <div class="modal-body">
                        <!-- Form submission status -->
                        <div class="response"></div>

                        <!-- Contact form -->
                        <div>
                            <label>Title:</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter your title">
                        </div>
                        <div class="form-group">
                            <label>First Name:</label>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter your first name">
                        </div>
                        <div class="form-group">
                            <label>Last Name:</label>
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter your last name">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone no.">
                        </div>
                        <div class="form-group">
                            <label>Size:</label>
                            <input type="text" name="size" id="size" class="form-control" placeholder="Enter your size">
                        </div>
                        <div class="form-group">
                            <label>Length:</label>
                            <input type="text" name="length" id="length" class="form-control" placeholder="Enter your length">
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Your message here" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Submit button -->
                        <input type="submit" id="submit" name="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}

add_action('wp_ajax_save_special_quota', 'save_special_quota');
add_action('wp_ajax_nopriv_save_special_quota', 'save_special_quota');

function save_special_quota() {
    if (isset($_POST['quota_data'])) {
        $quota_data = $_POST['quota_data'];

        $title       = sanitize_text_field($quota_data['title']);
        $first_name  = sanitize_text_field($quota_data['fname']);
        $last_name   = sanitize_text_field($quota_data['lname']);
        $email       = sanitize_email($quota_data['email']);
        $phone       = sanitize_text_field($quota_data['phone']);
        $size        = sanitize_text_field($quota_data['size']);
        $length      = sanitize_text_field($quota_data['length']);
        $description = sanitize_textarea_field($quota_data['description']);

        $post_data = array(
            'post_title'   => $title,
            'post_content' => $description,
            'post_type'    => 'special-quota',
            'post_status'  => 'publish',
        );

        $post_id = wp_insert_post($post_data);
        

        if ($post_id) {
            update_post_meta($post_id, 'fname', $first_name, );
            update_post_meta($post_id, 'lname', $last_name, );
            update_post_meta($post_id, 'email', $email, );
            update_post_meta($post_id, 'phone', $phone, );
            update_post_meta($post_id, 'size', $size, );
            update_post_meta($post_id, 'length', $length, );
            update_post_meta($post_id, 'description', $description, );

            echo 'Data saved successfully!';
        } else {
            echo 'Error: Invalid or missing post ID!';
        }

        exit();
    }
}
