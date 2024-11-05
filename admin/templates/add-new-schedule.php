 <h1>Add New Schedule</h1>
    <form method="post">
        <input type="hidden" name="action" value="add_new_schedule">
        <label for="date">Date:</label>
        <select name="cars" id="cars" form="carform">
            <option value="Sunday">Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
        </select>
        
        <label for="start_time">Start Time:</label>
        <input type="time" name="start_time" id="start_time" required>
        
        <label for="end_time">End Time:</label>
        <input type="time" name="end_time" id="end_time" required>
        
        <input type="submit" value="Add Schedule">
    </form>
    