<?php
require_once(plugin_dir_path(__FILE__) . '/../star-wars.php');


class Star_Wars_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'starwars_widget',
            esc_html__('Star Wars', 'stw_domain'),
            array('description' => esc_html__('Widget to display Star Wars Ships', 'stw_domain'),)
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'starwars';
        $db_results = $wpdb->get_results(" SELECT * FROM $table_name ");
        if (isset($_POST['nr_of_ships'])) {
            $nr_of_ships = $_POST['nr_of_ships'];
            $id = $_POST['id'];
            foreach ($db_results as $r) {
                $wpdb->update(
                    $table_name,
                    array(
                        'nr_of_ships' => $nr_of_ships,
                    ),
                    array(
                        'id' => $id,
                    )
                );
            }
        }
        $this->render_ship_selector();
        $this->render_ship_information();
    }

    public function form($instance)
    {
        echo '<p class="no-options-widget">' . __('There are no options for this widget.') . '</p>';
        return 'noform';
    }

    function render_ship_selector()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'starwars';
        $db_results = $wpdb->get_results(" SELECT * FROM $table_name ");
        include('ship-selector-partial.php');
    }

    function render_ship_information()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'starwars';
        $db_results = $wpdb->get_results(" SELECT * FROM $table_name ");
        foreach ($db_results as $r) {
            include('ship-info-partial.php');
        }
    }
}
