<?php
// Add Scripts

function stw_add_scripts(){

    // ADD MAIN JS
    wp_enqueue_script('stw-main-script', plugins_url(). '/star-wars/js/main.js', array('jquery'), true);

}   

add_action('wp_enqueue_scripts', 'stw_add_scripts');