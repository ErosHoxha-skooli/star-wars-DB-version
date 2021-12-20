<?php

/**
 * Plugin Name: Star Wars Plugin
 */
if (!defined('ABSPATH')) {
    exit;
}
function register_starwars()
{
    register_widget('Star_Wars_Widget');
}
require_once(plugin_dir_path(__FILE__) . './includes/star-wars-scripts.php');
require_once(plugin_dir_path(__FILE__) . './includes/star-wars-class.php');
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
function get_ships()
{
    $ships = array();
    for ($i = 1; $i < 5; $i++) {
        $url = "https://swapi.py4e.com/api/starships/?page=$i";
        $request = wp_remote_get($url);
        if (is_wp_error($request)) {
            return false;
        }
        $body = wp_remote_retrieve_body($request);
        $data = json_decode($body);
        $ships = array_merge($ships, $data->results);
    }
    return $ships;
}

function database_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'starwars';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name(
       id mediumint(9) NOT NULL AUTO_INCREMENT,
       name varchar(255) NOT NULL,
       cost_in_credits varchar(255) NOT NULL,
       length varchar(255) NOT NULL,
       max_atmosphering_speed varchar(255) NOT NULL,
       crew varchar(255) NOT NULL,
       passengers varchar(255)NOT NULL,
       cargo_capacity varchar(255) NOT NULL,
       manufacturer varchar(255) NOT NULL,
       consumables varchar(255) NOT NULL,
       hyperdrive_rating varchar(255) NOT NULL,
       MGLT varchar(255) NOT NULL,
       starship_class varchar(255) NOT NULL,
       nr_of_ships varchar(255),
       PRIMARY KEY  (id)
       ) $charset_collate;";
    dbDelta($sql);
    $ships = get_ships();
    foreach ($ships as $ship) {
        $wpdb->insert(
            $table_name,
            array(
                'name' => $ship->name,
                'manufacturer' => $ship->manufacturer,
                'cost_in_credits' => $ship->cost_in_credits,
                'length' => $ship->length,
                'max_atmosphering_speed' => $ship->max_atmosphering_speed,
                'crew' => $ship->crew,
                'passengers' => $ship->passengers,
                'cargo_capacity' => $ship->cargo_capacity,
                'consumables' => $ship->consumables,
                'hyperdrive_rating' => $ship->hyperdrive_rating,
                'MGLT' => $ship->MGLT,
                'starship_class' => $ship->starship_class,
            )
        );
    }
}
function delete_database_on_deactivation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'starwars';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}
register_activation_hook(__FILE__, 'database_table');
register_deactivation_hook(__FILE__, 'delete_database_on_deactivation');
add_action('widgets_init', 'register_starwars');
