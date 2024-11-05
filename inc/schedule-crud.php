<?php

function add_schedule($day, $start_time, $end_time) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'schedule';

    $wpdb->insert(
        $table_name,
        [
            'day' => $day,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ],
        [
            '%s', '%s', '%s'
        ]
    );

    return $wpdb->insert_id;
}

function get_schedules() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'schedule';

    return $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
}

function update_schedule($id, $day, $start_time, $end_time) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'schedule';

    return $wpdb->update(
        $table_name,
        [
            'day' => $day,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ],
        [ 'id' => $id ],
        [ '%s', '%s', '%s' ],
        [ '%d' ]
    );
}

function delete_schedule($id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'schedule';

    return $wpdb->delete($table_name, [ 'id' => $id ], [ '%d' ]);
}
