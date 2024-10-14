<?php
if (!defined('ABSPATH')) {
    exit;
}

class Admin_Functions {
    public function __construct() {
        add_action('admin_menu', array($this, 'create_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }

    // Create admin menu.
    public function create_admin_menu() {
        add_menu_page(
            'Appointments',
            'Appointments',
            'manage_options',
            'appointment-plugin',
            array($this, 'render_admin_page'),
            'dashicons-calendar-alt',
            20
        );
    }

    // Load admin assets (CSS/JS).
    public function enqueue_admin_assets() {
        wp_enqueue_style('admin-styles', APPOINTMENT_PLUGIN_URL . 'admin/assets/css/admin-styles.css');
        wp_enqueue_script('admin-scripts', APPOINTMENT_PLUGIN_URL . 'admin/assets/js/admin-scripts.js', array('jquery'), null, true);
    }

    //Render admin page template.
    public function render_admin_page() {
        include APPOINTMENT_PLUGIN_DIR . 'admin/templates/admin-view.php';
    }
}
