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

if (is_admin()) {
    require_once MY_PLUGIN_DIR . 'admin/admin.php';
}

if (!is_admin()) {
    require_once MY_PLUGIN_DIR . 'public/public.php';
}

class AppointmentBookingPlugin {

    private $dbTables;

    public function __construct() {
        global $wpdb;
        $this->dbTables = new DatabaseTables($wpdb);

        register_activation_hook(__FILE__, array($this, 'installPlugin'));
        register_deactivation_hook(__FILE__, array($this, 'uninstallPlugin'));
    }

    public function installPlugin() {
        $this->dbTables->createTables();
    }

    public function uninstallPlugin() {
        $this->dbTables->deleteTables(); 
    }
}

new AppointmentBookingPlugin();

