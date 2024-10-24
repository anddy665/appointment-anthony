<?php
if (!defined('ABSPATH')) {
    exit;
}

// Register settings
function my_plugin_register_settings() {
    register_setting('my_plugin_general_settings_group', 'my_plugin_some_setting');
}
add_action('admin_init', 'my_plugin_register_settings');
