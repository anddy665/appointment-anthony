<?php

// Render New Appointment Page
function aa_render_new_appointment_page() {
    if (isset($_POST['new_appointment_submit'])) {
        $appointment_title = sanitize_text_field($_POST['appointment_title']);
        $appointment_date = sanitize_text_field($_POST['appointment_date']);

        add_option('appointment_title', $appointment_title);
        add_option('appointment_date', $appointment_date);

        echo '<div class="notice notice-success"><p>New appointment added successfully!</p></div>';
    }

    include_once MY_PLUGIN_DIR . 'admin/templates/add-new-schedule.php';
}
