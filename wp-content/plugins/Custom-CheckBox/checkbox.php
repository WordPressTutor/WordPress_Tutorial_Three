<?php
/*
Plugin Name: Custom CheckBox Field
Description: Custom CheckBox Field
Version: 1.0
Author: WordPress Tutorial
*/

add_action('admin_menu', 'custom_checkBox_Field');

function custom_checkBox_Field()
{
    add_menu_page(
        'Custom checkBox Field',
        'Custom checkBox Field',
        'manage_options',
        'custom_checkBox_Field',
        'custom_checkBox_Field_page',
        'dashicons-saved',
        20
    );
}

function custom_checkBox_Field_page(){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    
</body>
</html>

<?php
}