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
            $test = $_POST['nr_of_ships'];
            $idtest = $_POST['id'];
            foreach ($db_results as $r) {
                $wpdb->update(
                    $table_name,
                    array(
                        'nr_of_ships' => $test,
                    ),
                    array(
                        'id' => $idtest,
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
        echo '<div>';
        echo '<select>';
        echo '<option>Choose Ship</option>';
        foreach ($db_results as $r) {
            echo  "<option value='ship-{$r->id}' >$r->name</option>";
        }
        echo '</select>';
        echo '</div>';
    }

    function render_ship_information()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'starwars';
        $db_results = $wpdb->get_results(" SELECT * FROM $table_name ");
        foreach ($db_results as $r) {
            echo "<form method='POST'>";
            echo "<div class='ship-{$r->id} box' >" . PHP_EOL;
            echo "<div class='id'>ID: $r->id</div>" . PHP_EOL;
            echo "<input type='text' name='id' value='$r->id'>";
            echo "<div class='manufacturer'>Manufacturer: $r->manufacturer</div>" . PHP_EOL;
            echo "<div class='cost_in_credits'>Cost in credits: $r->cost_in_credits</div>" . PHP_EOL;
            echo "<div class='length'>Length: $r->length</div>" . PHP_EOL;
            echo "<div class='max_atmosphering_speed'>Max atmosphering speed: $r->max_atmosphering_speed</div>" . PHP_EOL;
            echo "<div class='crew'>Crew: $r->crew</div>" . PHP_EOL;
            echo "<div class='passengers'>Passengers: $r->passengers</div>" . PHP_EOL;
            echo "<div class='cargo_capacity'>Cargo capacity: $r->cargo_capacity</div>" . PHP_EOL;
            echo "<div class='consumables'>Consumables: $r->consumables</div>" . PHP_EOL;
            echo "<div class='hyperdrive_rating'>Hyperdrive rating: $r->hyperdrive_rating</div>" . PHP_EOL;
            echo "<div class='MGLT'>MGLT: $r->MGLT</div>" . PHP_EOL;
            echo "<div class='starship_class'>Starship class: $r->starship_class</div>" . PHP_EOL;
            echo '<label>' . "Number of ships: " . '</label>' . '<br>' . "<input type='text' name='nr_of_ships'>" . '<br>' . '<br>';
            echo "<input type='submit' value='Submit the form'/>";
            echo '</form>';
            echo '</div>';
        }
    }
}
