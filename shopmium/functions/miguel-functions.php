<?php

function shopnium_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('iconsshopnium', get_template_directory_uri() . '/library/js/all.js', array('jquery'), '1.0.0',true);
        wp_enqueue_script('iconsshopnium');



    }
}




add_action('init', 'shopnium_scripts'); // Add Custom Scripts to wp_head


?>
