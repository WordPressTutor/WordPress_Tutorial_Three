<?php
/*
Plugin Name: custom Post Type
Description: This is a custom post type plugin
Author: WordPress Tutorial
 */

function enqueue_my_script()
{
    // Enqueue the script
    wp_enqueue_script('my-script', get_template_directory_uri() . '/custom-template/post.js', array('jquery'), null, true);

    // Localize the script data
    $script_data = array(
        'ajax_url' => admin_url('admin-ajax.php'), // Example data, you can customize this
        'nonce' => wp_create_nonce('your_nonce_key'), // Example data, you can customize this
    );

    wp_localize_script('my-script', 'custom_post_data', $script_data);
}

add_action('wp_enqueue_scripts', 'enqueue_my_script');


get_header();

function custom_post_post()
{
?>
<div class="container mt-5">
    <div class="row">
        <form action="" id="mypost" method="post">
            <h3 class="alert-warning text-center p-2">Add/update Post</h3>
            <input type="hidden" name="post-id" id="post-id" value="">
            <div>
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>
            <div>
                <label for="content" class="form-label">Content</label>
                <textarea type="text" class="form-control" name="content" id="content" required></textarea>
            </div>
            <div>
                    <label for="category">Category:</label>
                    <select name="category" required id="post-category">
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'category',
                            'hide_empty' => false,
                        ));

                        foreach ($categories as $category) {
                            $selected = '';
                            // Adjust this part based on your actual logic for selected categories
                            // $post_categories = wp_get_post_categories($post_id_to_update);
                            // $selected = in_array($category->term_id, $post_categories) ? 'selected' : '';
                            echo '<option value="' . esc_attr($category->term_id) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            <div>
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" name="author" id="author" required>
            </div>
            <div>
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" name="location" id="location" required>
            </div>
            <div>
                <label for="external-link" class="form-label">External Link</label>
                <input type="text" class="form-control" name="external_link" id="external_link" required>
            </div>
            <div class="mt-5">
                <button type="submit" name="submit" id="submit">Add Post</button>
                <button type="button" id="update" style="display: none;">Update</button>
            </div>
        </form>
        <div class="text-center">
            <h3 class="alert-warning p-2">Show Post Data</h3>
            <table class="table" id="post-table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Category</th>
                        <th scope="col">Author</th>
                        <th scope="col">Location</th>
                        <th scope="col">External Link</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody"></tbody>
            </table>

        </div>
    </div> -->
<?php
}
add_shortcode('custom_post_post', 'custom_post_post');
get_footer();
?>


<?php
function add_post_ajax()

{
    

    if (isset($_POST['post_data']))
        $post_data = $_POST['post_data'];

    $post_title = sanitize_text_field($post_data['title']);
    $post_content = sanitize_textarea_field($post_data['content']);
    $post_category = sanitize_text_field($post_data['category']);
    $post_author = sanitize_text_field($post_data['author']);
    $post_location = sanitize_text_field($post_data['location']);
    $post_link = esc_url($post_data['external_link']);

    $post_id = wp_insert_post(array(
        'post_title' => $post_title,
        'post_content' => $post_content,
        'post_category' => array($post_category),
        'post_status' => 'publish'
    ));

    if ($post_id) {
        update_post_meta($post_id, 'author', $post_author);
        update_post_meta($post_id, 'location', $post_location);
        update_post_meta($post_id, 'external_link', $post_link);
        wp_send_json_success("Post inserted successfully");
    } else {
        wp_send_json_error("Error inserting post");
    }
}

add_action('wp_ajax_add_post_ajax', 'add_post_ajax');
add_action('wp_ajax_nopriv_add_post_ajax', 'add_post_ajax');
// ?>