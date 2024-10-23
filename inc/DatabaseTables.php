<?php

if (!defined('ABSPATH')) {
    exit;
}

class DatabaseTables {

    private $wpdb;
    private $charset_collate;
    private $appointment_table;
    private $schedule_table;
    private $appointment_schedule_table;

    public function __construct($wpdb) {
        $this->wpdb = $wpdb;
        $this->charset_collate = $wpdb->get_charset_collate();
        $this->appointment_table = $wpdb->prefix . 'appointments';
        $this->schedule_table = $wpdb->prefix . 'schedule';
        $this->appointment_schedule_table = $wpdb->prefix . 'appointment_schedule';
    }

    public function createTables() {
        $sql_appointment = "CREATE TABLE {$this->appointment_table} (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            last_name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            phone_number varchar(20) NOT NULL,
            appointment_date date NOT NULL,
            description TEXT NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY (id)
        ) $this->charset_collate;";

        $sql_schedule = "CREATE TABLE {$this->schedule_table} (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            day varchar(50) NOT NULL,
            start_time time NOT NULL,
            end_time time NOT NULL,
            PRIMARY KEY (id)
        ) $this->charset_collate;";

        $sql_appointment_schedule = "CREATE TABLE {$this->appointment_schedule_table} (
            appointment_id mediumint(9) NOT NULL,
            schedule_id mediumint(9) NOT NULL,
            FOREIGN KEY (appointment_id) REFERENCES {$this->appointment_table}(id) ON DELETE CASCADE,
            FOREIGN KEY (schedule_id) REFERENCES {$this->schedule_table}(id) ON DELETE CASCADE,
            PRIMARY KEY (appointment_id, schedule_id)
        ) $this->charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_appointment);
        dbDelta($sql_schedule);
        dbDelta($sql_appointment_schedule);
    }

    public function deleteTables() {
        $sql = "DROP TABLE IF EXISTS {$this->appointment_schedule_table}, {$this->schedule_table}, {$this->appointment_table};";
        $this->wpdb->query($sql);
    }
}

