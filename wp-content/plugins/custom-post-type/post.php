<?php
/*
Plugin Name: My Custom Post Shortcode 
Description: Custom Post type for post types
Version: 1.0
Author: WordPress Tutorial 
*/

function my_post_shortcode() {
    ob_start(); // Start output buffering
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <header>
            <!-- Your header content goes here -->
            <h1>My Custom Header</h1>
        </header>
        <main>
            <h3>Hello</h3>
            <!-- Your shortcode content goes here -->
        </main>
        <footer>
            <!-- Your footer content goes here -->
            <p>&copy; <?php echo date('Y'); ?> My Custom Post Shortcode</p>
        </footer>
    </body>
    </html>
    <?php
    return ob_get_clean(); // Return the buffered content
}

add_shortcode('my_post', 'my_post_shortcode');
?>
