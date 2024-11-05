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
            'My Appointments',             // Page title
            'Appointments',                      // Menu title
            'manage_options',                 // Capability
            'my-appointments',             // Menu slug
            array($this, 'render_main_page'),  // Function that renders the main page
            'dashicons-calendar-alt',        // Icon
            6                                 // Position in menu
        );

        // Submenu 2: Reports
        add_submenu_page(
            'my-appointments',             // Parent slug (main menu)
            'Schedule',                        // Page title
            'Schedule',                        // Submenu title
            'manage_options',                 // Capability
            'my-schedule',              // Submenu slug
            array($this, 'render_schedule_page') // Function to render submenu page
        );

         // Submenu: New Appointment
         add_submenu_page(
            null,                             // No parent menu, so it won't appear in the sidebar
            'Add New Schedule',                // Page title
            'Add New Schedule',                // Menu title (not used since it's hidden)
            'manage_options',                 // Capability
            'add-new-schedule',            // Menu slug
            array($this, 'render_add_new_schedule_page') // Function to render the page
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
    public function render_schedule_page() {
        include_once MY_PLUGIN_DIR . 'admin/templates/scheduling-page.php';
    }

    function render_add_new_schedule_page() {
        if (isset($_POST['new_appointment_submit'])) {
            $appointment_title = sanitize_text_field($_POST['appointment_title']);
            $appointment_date = sanitize_text_field($_POST['appointment_date']);
    
            add_option('appointment_title', $appointment_title);
            add_option('appointment_date', $appointment_date);
    
            echo '<div class="notice notice-success"><p>New appointment added successfully!</p></div>';
        }
    
        include_once MY_PLUGIN_DIR . 'admin/templates/add-new-schedule.php';
    }
 }

new MyPluginAdmin();
