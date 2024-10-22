<?php
/*
Plugin Name: Appointment Booking Plugin
Description: A simple appointment booking plugin for WordPress.
Version:     1.0
Author:      Anthony Lopez
*/

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class AppointmentBookingPlugin {
    public function __construct() {
        // Register activation hook (allows you to define a function that will run when the plugin is activated.).
        register_activation_hook(__FILE__, array($this, 'install_plugin'));
    }

    // Function to create the necessary database tables on activation
    public function install_plugin() {
        global $wpdb;

        $appointment_table = $wpdb->prefix . 'appointments';
        $schedule_table = $wpdb->prefix . 'schedule';
        $appointment_schedule_table = $wpdb->prefix . 'appointment_schedule';

        $charset_collate = $wpdb->get_charset_collate();

        // SQL to create appointments table.
        $sql_appointment = "CREATE TABLE $appointment_table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            last_name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            phone_number varchar(20) NOT NULL,
            appointment_date date NOT NULL,
            description TEXT NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // SQL to create schedule table.
        $sql_schedule = "CREATE TABLE $schedule_table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            day varchar(50) NOT NULL,
            start_time time NOT NULL,
            end_time time NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // SQL to create appointment_schedule (junction table).
        $sql_appointment_schedule = "CREATE TABLE $appointment_schedule_table (
            appointment_id mediumint(9) NOT NULL,
            schedule_id mediumint(9) NOT NULL,
            FOREIGN KEY (appointment_id) REFERENCES $appointment_table(id) ON DELETE CASCADE,
            FOREIGN KEY (schedule_id) REFERENCES $schedule_table(id) ON DELETE CASCADE,
            PRIMARY KEY (appointment_id, schedule_id)
        ) $charset_collate;";

        // Ensure the tables are created.
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_appointment);
        dbDelta($sql_schedule);
        dbDelta($sql_appointment_schedule);
    }
}

// Initialize the plugin.
new AppointmentBookingPlugin();
