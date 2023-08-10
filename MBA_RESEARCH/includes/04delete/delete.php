<?php
function delete_student($id)
{
    // ____________________________________________________________________________
    // connect to database.
    global $wpdb;
    // check connection
    if (!$wpdb) {
        $wpdb->show_errors();
    }

    // ____________________________________________________________________________
    // Table name
    $table_name = $wpdb->prefix . 'students';
    // SQL query to delete the row with the specified ID
    $wpdb->delete($table_name, array('id' => $id));

}
function delete_supervisor($id)
{
    // ____________________________________________________________________________
    // connect to database.
    global $wpdb;
    // check connection
    if (!$wpdb) {
        $wpdb->show_errors();
    }

    // ____________________________________________________________________________
    // Table name
    $table_name = $wpdb->prefix . 'users';
    // SQL query to delete the row with the specified ID
    $wpdb->delete($table_name, array('id' => $id));

}





// _______________________________
if (isset($_GET['action']) && $_GET['action'] == 'delete(student)' && isset($_GET['id'])) {
    delete_student($_GET['id']);
    // Redirect to the student details page after deletion
    header('location:' . site_url() . '/students_table/');
    exit;
}
if (isset($_GET['action']) && $_GET['action'] == 'delete(supervisor)' && isset($_GET['id'])) {
    delete_supervisor($_GET['id']);
    // Redirect to the student details page after deletion
    header('location:' . site_url() . '/supervisors_table/');
    exit;
}
?>