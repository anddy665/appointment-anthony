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

// Include database and CRUD functions
require_once MY_PLUGIN_DIR . 'inc/DatabaseTables.php'; 
require_once MY_PLUGIN_DIR . 'inc/schedule-crud.php';

if (is_admin()) {
    require_once MY_PLUGIN_DIR . 'admin/admin.php';
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

    public function handle_add_new_schedule() {
        if (isset($_POST['day'], $_POST['start_time'], $_POST['end_time'])) {
            $day = sanitize_text_field($_POST['day']);
            $start_time = sanitize_text_field($_POST['start_time']);
            $end_time = sanitize_text_field($_POST['end_time']);
            
            add_schedule($day, $start_time, $end_time);
            
            wp_redirect(admin_url('admin.php?page=manage-schedules'));
            exit;
        }
    }
}

new AppointmentBookingPlugin();

