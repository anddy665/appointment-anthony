<?php
if (!defined('ABSPATH')) {
    exit;
}

class MyPluginAdmin {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }

    // Add main menu and submenu pages
    public function add_admin_menu() {
        // Main menu page
        add_menu_page(
            'My Appointments Settings',             // Page title
            'Appointments',                      // Menu title
            'manage_options',                 // Capability
            'my-plugin-settings',             // Menu slug
            array($this, 'render_main_page'),  // Function that renders the main page
            'dashicons-calendar-alt',        // Icon
            6                                 // Position in menu
        );

        // Submenu 2: Reports
        add_submenu_page(
            'my-plugin-settings',             // Parent slug (main menu)
            'Scheduling',                        // Page title
            'Scheduling',                        // Submenu title
            'manage_options',                 // Capability
            'my-plugin-reports',              // Submenu slug
            array($this, 'render_reports_page') // Function to render submenu page
        );
    }

    // Load admin assets (CSS/JS)
    public function enqueue_admin_assets() {
        wp_enqueue_style('my-plugin-admin-css', MY_PLUGIN_URL . 'admin/assets/css/admin-style.css');
        wp_enqueue_script('my-plugin-admin-js', MY_PLUGIN_URL . 'admin/assets/js/admin-script.js', array('jquery'), false, true);
    }

    // Render the main menu page content
    public function render_main_page() {
        include_once MY_PLUGIN_DIR . 'admin/templates/admin-page.php';
    }

    // Render the Reports submenu page content
    public function render_reports_page() {
        include_once MY_PLUGIN_DIR . 'admin/templates/reports-page.php';
    }
}

new MyPluginAdmin();
