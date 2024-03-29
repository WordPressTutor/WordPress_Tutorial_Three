<?php
/*
Plugin Name: Custom Test
Description: This is a test plugin
Version: 1.0
Author: WordPress Tutorial
*/

// Enqueue scripts and styles
function custom_test_enqueue_scripts() {
    wp_enqueue_script('custom-test-script', plugin_dir_url(__FILE__) . 'custom-test.js', array('jquery'), '1.0', true);
    wp_enqueue_style('custom-test-styles', plugin_dir_url(__FILE__) . 'custom-test.css');

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
    );

    $query = new WP_Query($args);
    $total_posts = $query->found_posts;
    $posts_per_page = 5;
    $max_pages = ceil($total_posts / $posts_per_page);

    wp_localize_script('custom-test-script', 'custom_test_vars', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
        'max_pages' => $max_pages
    ));
}
add_action('wp_enqueue_scripts', 'custom_test_enqueue_scripts');

// Shortcode function to display posts
function custom_test_shortcode() {
    $orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'date';
    $order = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : 'DESC';

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'orderby' => $orderby,
        'order' => $order
    );

    $query = new WP_Query($args);

    // Dropdowns for Order By and Direction
    $output = '<div class="filter-dropdowns">';
    $output .= '<label for="orderby">Order By:</label>';
    $output .= '<select name="orderby" id="orderby">';
    $output .= '<option value="date" ' . selected($orderby, 'date', false) . '>Date</option>';
    $output .= '<option value="title" ' . selected($orderby, 'title', false) . '>Title</option>';
    $output .= '</select>';

    $output .= '<label for="order">Direction:</label>';
    $output .= '<select name="order" id="order">';
    $output .= '<option value="DESC" ' . selected($order, 'DESC', false) . '>Descending</option>';
    $output .= '<option value="ASC" ' . selected($order, 'ASC', false) . '>Ascending</option>';
    $output .= '</select>';
    $output .= '<button onclick="applyFilters()">Apply Filters</button>';
    $output .= '</div>';

    $output .= '<div class="projcard-container">';
    $output .= "Number of posts found: " . $query->found_posts;
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Generate HTML for each post
            echo '<div class="projcard projcard-blue">';
            echo '<div class="projcard-innerbox">';
            echo '<img class="projcard-img" src="' . get_the_post_thumbnail_url() . '" />';
            echo '<div class="projcard-textbox">';
            echo '<div class="projcard-title">' . get_the_title() . '</div>';
            echo '<div class="projcard-subtitle">' . get_the_excerpt() . '</div>';
            echo '<div class="projcard-bar"></div>';
            echo '<div class="projcard-description">' . get_the_content() . '</div>'; 
            echo '</div></div></div>';
        }
        wp_reset_postdata();
    } else {
        $output .= '<p>No posts found</p>';
    }
    $output .= '</div>';
    $output .= '<button id="see-more-btn">See More</button>';
    return $output;
}
add_shortcode('custom_test', 'custom_test_shortcode');
function load_more_posts() {
    $paged = $_POST['page'];
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'paged'          => $paged
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Generate HTML for each post
            echo '<div class="projcard projcard-blue">';
            echo '<div class="projcard-innerbox">';
            echo '<img class="projcard-img" src="' . get_the_post_thumbnail_url() . '" />';
            echo '<div class="projcard-textbox">';
            echo '<div class="projcard-title">' . get_the_title() . '</div>';
            echo '<div class="projcard-subtitle">' . get_the_excerpt() . '</div>';
            echo '<div class="projcard-bar"></div>';
            echo '<div class="projcard-description">' . get_the_content() . '</div>'; 
            echo '</div></div></div>';
        }
        wp_reset_postdata(); 
    }
    die();
}
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');
?>
