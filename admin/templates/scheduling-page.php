<div class="Scheduling">
    <div class="Scheduling-title">
        <h1>My Schedule</h1>
        <a href="admin.php?page=add-new-schedule" class="button-class">Add New Schedule</a>
    </div>
</div>

<form method="post" action="">
        <h2>Schedule an Appointment</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <input type="submit" name="submit_appointment" value="Submit Appointment">
    </form>

    <h2>Current Appointments</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
