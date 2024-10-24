<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" action="options.php">
        <?php settings_fields('my_plugin_settings_group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">My Plugin Option</th>
                <td><input type="text" name="my_plugin_option" value="<?php echo get_option('my_plugin_option'); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
