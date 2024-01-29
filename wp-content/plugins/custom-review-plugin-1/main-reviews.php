<?php
/*
Plugin Name: Custom Reviews 
Description: This is a custom reviews plugin that shows reviews.
Version: 1.0
Author: Patchmarket
*/

function custom_reviews_shortcode()
{
    ob_start();
    include(plugin_dir_path(__FILE__) . 'templates/template-reviews.php');
    wp_enqueue_style('blog_archive_style', plugin_dir_url(__FILE__) . 'assets/css/style-reviews.css');
    wp_enqueue_script('blog_archive_script', plugin_dir_url(__FILE__) . 'assets/javascript/jquery-reviews.js');
    wp_enqueue_style('jquery', 'https://code.jquery.com/jquery-3.7.1.min.js');
    wp_localize_script('blog_archive_script', 'ajaxurl', admin_url('admin-ajax.php'));
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('custom_reviews_shortcode', 'custom_reviews_shortcode');


// Add a new tab to WooCommerce product pages
function custom_reviews_tab($tabs)
{
    $tabs['custom_reviews_tab'] = array(
        'title'     => __('Reviews', 'text-domain'),
        'priority'  => 50,
        'callback'  => 'display_custom_reviews_tab_content'
    );
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'custom_reviews_tab');

// Display the content of your custom shortcode in the new tab
function display_custom_reviews_tab_content()
{
    echo do_shortcode('[custom_reviews_shortcode]');
}


//load more reviews function
function load_more_reviews() {
    $comments_per_page = 5;
    $product_id = get_the_ID();
    $page = $_POST['page'];

    $comment_ids = get_comments([
        'post_id' => $product_id,
        'status' => 'approve',
        'type' => 'review',
        'orderby' => 'comment_date',
        'order' => 'DESC',
        'number' => $comments_per_page,
        'paged' => $page,
    ]);

    if ($comment_ids) {
        foreach ($comment_ids as $comment_id) {
            $comment_data = get_comment($comment_id->comment_ID);
            $rating = get_comment_meta($comment_id->comment_ID, 'rating', true);
            $comment_author = get_comment_author($comment_id);
            $review_images = get_comment_meta($comment_id->comment_ID, 'reviews-images', true);
        ?>
    
            <div class="card" onclick="openModal(<?php echo $comment_id->comment_ID; ?>)">
                <div class="card-img-container">
                    <?php
                    if (!empty($review_images)) {
                        foreach ($review_images as $image_id) {
                            $image_url = wp_get_attachment_url($image_id);
                            echo '<img src="' . esc_url($image_url) . '" alt="Review Image">';
                        }
                    }
                    ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 11.1005L7 9.1005L12.5 14.6005L16 11.1005L19 14.1005V5H5V11.1005ZM4 3H20C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM15.5 10C14.6716 10 14 9.32843 14 8.5C14 7.67157 14.6716 7 15.5 7C16.3284 7 17 7.67157 17 8.5C17 9.32843 16.3284 10 15.5 10Z"></path>
                    </svg>
                </div>
                <div class="card-body">
                    <div class="review-info">
                        <div class="customer-rating">
                            <div class="customer-avatar-wrapper">
                                <div class="customer-avatar">
                                    <div class="text-avatar">
                                        A
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11.0026 16L18.0737 8.92893L16.6595 7.51472L11.0026 13.1716L8.17421 10.3431L6.75999 11.7574L11.0026 16Z"></path>
                                    </svg>
                                </div>
                                <div class="aurthor-block">
                                    <div class="aurthor-name"><!--A***--><?php echo $comment_author; ?></div>
                                    <div class="aurthor-country-flag"></div>
                                </div>
                            </div>
                            <div class="start-ratings">
                                <?php
                                for ($i = 1; $i <= $rating; $i++) {
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"></path></svg>';
                                }
                                ?>
                            </div>
                            <div class="date-months">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 1V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9ZM20 11H4V19H20V11ZM8 13V15H6V13H8ZM13 13V15H11V13H13ZM18 13V15H16V13H18ZM7 5H4V9H20V5H17V7H15V5H9V7H7V5Z"></path>
                                </svg>
                                <span class="month"><?php echo esc_html(human_time_diff(strtotime($comment_data->comment_date_gmt), current_time('timestamp'))) . ' ago'; ?></span>
                            </div>
                        </div>
                        <div class="para-content">
                            <p><?php echo esc_html($comment_data->comment_content); ?></p>
                        </div>
                        <div class="review-footer">
                            <div class="like">
                                <span class="like-btn">
                                    <svg width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="" d="M128 447.1V223.1c0-17.67-14.33-31.1-32-31.1H32c-17.67 0-32 14.33-32 31.1v223.1c0 17.67 14.33 31.1 32 31.1h64C113.7 479.1 128 465.6 128 447.1zM512 224.1c0-26.5-21.48-47.98-48-47.98h-146.5c22.77-37.91 34.52-80.88 34.52-96.02C352 56.52 333.5 32 302.5 32c-63.13 0-26.36 76.15-108.2 141.6L178 186.6C166.2 196.1 160.2 210 160.1 224c-.0234 .0234 0 0 0 0L160 384c0 15.1 7.113 29.33 19.2 38.39l34.14 25.59C241 468.8 274.7 480 309.3 480H368c26.52 0 48-21.47 48-47.98c0-3.635-.4805-7.143-1.246-10.55C434 415.2 448 397.4 448 376c0-9.148-2.697-17.61-7.139-24.88C463.1 347 480 327.5 480 304.1c0-12.5-4.893-23.78-12.72-32.32C492.2 270.1 512 249.5 512 224.1z"></path>
                                    </svg>
                                    <span class="count">
                                        Like &nbsp;(1)
                                    </span>
                                </span>
                            </div>
                            <div class="reply">
                                <span class="like-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 16px;">
                                        <path fill="" d="M256 32C114.6 32 .0272 125.1 .0272 240c0 49.63 21.35 94.98 56.97 130.7c-12.5 50.37-54.27 95.27-54.77 95.77c-2.25 2.25-2.875 5.734-1.5 8.734C1.979 478.2 4.75 480 8 480c66.25 0 115.1-31.76 140.6-51.39C181.2 440.9 217.6 448 256 448c141.4 0 255.1-93.13 255.1-208S397.4 32 256 32z"></path>
                                    </svg>
                                    <span class="count">
                                        Reply &nbsp;(1)
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    <?php
        }
    }

    die(); 
}

add_action('wp_ajax_load_more_reviews', 'load_more_reviews');
add_action('wp_ajax_nopriv_load_more_reviews', 'load_more_reviews');



add_action('wp_ajax_get_comment_data', 'get_comment_data_ajax_handler');
add_action('wp_ajax_nopriv_get_comment_data', 'get_comment_data_ajax_handler');

function get_comment_data_ajax_handler() {
    $comment_id = isset($_POST['comment_id']) ? intval($_POST['comment_id']) : 0;

    $comment_data = get_comment($comment_id);

    ?>
    
    <?php

    wp_die();
}
