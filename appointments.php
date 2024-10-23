<?php
/*
Plugin Name: Appointment Booking Plugin
Description: A simple appointment booking plugin for WordPress.
Version:     1.0
Author:      Your Name
*/

if (!defined('ABSPATH')) {
    exit;
}

define('MY_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MY_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once MY_PLUGIN_DIR . 'inc/DatabaseTables.php'; 

class Appointment_Booking_Plugin {

    private $dbTables;

    public function __construct() {
        global $wpdb;
        $this->dbTables = new DatabaseTables($wpdb);

        register_activation_hook(__FILE__, array($this, 'install_plugin'));
        register_deactivation_hook(__FILE__, array($this, 'uninstall_plugin'));
    }

    public function install_plugin() {
        $this->dbTables->create_tables();
    }

    public function uninstall_plugin() {
        $this->dbTables->delete_tables(); 
    }
}

new Appointment_Booking_Plugin();
