<?php
if (!defined('ABSPATH')) {
    exit;
}

class Appointment_Functions {
    public function __construct() {
        add_shortcode('appointment_form', array($this, 'render_appointment_form'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_public_assets'));
    }

    // Load public assets (CSS/JS).
    public function enqueue_public_assets() {
        wp_enqueue_style('appointment-styles', APPOINTMENT_PLUGIN_URL . 'appointments/assets/css/appointment-styles.css');
        wp_enqueue_script('appointment-scripts', APPOINTMENT_PLUGIN_URL . 'appointments/assets/js/appointment-scripts.js', array('jquery'), null, true);
    }

    // Render appointment form template.
    public function render_appointment_form() {
        ob_start();
        include APPOINTMENT_PLUGIN_DIR . 'appointments/templates/appointment-form.php';
        return ob_get_clean();
    }
}
