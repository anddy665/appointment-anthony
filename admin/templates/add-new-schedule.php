<div class="wrap">
    <h1>New Appointment</h1>
    <form method="post">
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="appointment_title">Appointment Title</label>
                </th>
                <td>
                    <input type="text" name="appointment_title" id="appointment_title" class="regular-text" required>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="appointment_date">Appointment Date</label>
                </th>
                <td>
                    <input type="date" name="appointment_date" id="appointment_date" required>
                </td>
            </tr>
        </table>
        <?php submit_button('Add Appointment', 'primary', 'new_appointment_submit'); ?>
    </form>
</div>
