<?php
function get_contributer_role($user_id) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'usermeta'; // Replace 'prefix' with your actual table prefix

    $query = $wpdb->prepare(
        "SELECT meta_value FROM $table_name WHERE user_id = %d AND meta_key = %s",
        $user_id,
        'wp_capabilities'
    );

    $user_role = $wpdb->get_var($query);

    if ($user_role) {
        $capabilities = maybe_unserialize($user_role);
        if (is_array($capabilities)) {
            $roles = array_keys($capabilities);
            return $roles[0]; // Return the primary role
        }
    }

    return '';
}

function display_supervisors_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'students'; // Replace 'prefix' with your actual table prefix

    $role_to_display = 'contributor'; // Change this to the role you want to display

    $query = $wpdb->prepare(
        "SELECT * FROM $table_name
        WHERE user_id IN (SELECT user_id FROM {$wpdb->prefix}usermeta WHERE meta_key = 'wp_capabilities' AND meta_value LIKE %s)",
        '%' . $wpdb->esc_like('"' . $role_to_display . '"') . '%'
    );

    $students = $wpdb->get_results($query);

    if ($students) {
        $output = '<table>';
        $output .= '<tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Registration Date</th>
        <th>Role</th>
        </tr>';

        foreach ($students as $student) {
            $user_role = get_contributer_role($student->user_id);

            $output .= '<tr>';
            $output .= '<td>' . esc_html($student->id) . '</td>';
            $output .= '<td>' . esc_html($student->user_id) . '</td>';
            $output .= '<td>' . esc_html($student->username) . '</td>';
            $output .= '<td>' . esc_html($student->email) . '</td>';
            $output .= '<td>' . esc_html($student->registration_date) . '</td>';
            $output .= '<td>' . esc_html($user_role) . '</td>';
            $output .= '
            <td>
            <a href="' . admin_url('./4delete/delete.php?page=wp_students&action=delete(student)&id=' . $student->id) . '" class="button-delete btn">Delete</a>
            </td>
            ';
            $output .= '</tr>';
        }

        $output .= '</table>';
    } else {
        $output = 'No students found.';
    }

    return $output;
}
add_shortcode('supervisors_table', 'display_supervisors_table');
?>
