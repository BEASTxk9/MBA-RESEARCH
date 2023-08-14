<?php
// create function
function add_topic()
{
    // ____________________________________________________________________________    
    // connect to database.
    global $wpdb;
    // check connection
    if (is_null($wpdb)) {
        $wpdb->show_errors();
    }

    // ____________________________________________________________________________    
    // Set table name that is being called
    $table_name = $wpdb->prefix . 'topics';

    // if content is added/submitted/posted take the data and do the msql add query
    if (isset($_POST['submit'])) {
        // id is automatically set
        $research_field = $_POST['research_field'];
        $sub_topics = $_POST['sub_topics'];
        $mini_topics = $_POST['mini_topics'];
 
        // mysql add query
        $sql = "INSERT INTO $table_name (research_field, sub_topics, mini_topics) 
        values('$research_field', '$sub_topics', '$mini_topics')";

        $result = $wpdb->query($sql);
        
        // if successful redirect
        if ($result) {
            $redirect_url = site_url('/topics_table/');
            ?>
            <script>
                window.location.href = "<?php echo $redirect_url; ?>";
            </script>
            <?php
            exit;
        } else {
            wp_die($wpdb->last_error);
        }
    }

    // ____________________________________________________________________________
    // HTML DISPLAY

    // external links
    $output = '
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>';

    $output .= '
    <div class="container">
    <div class="row">
        <div class="col-sm-12">

            <form method="POST" action="">
                <!-- research_field -->
                <label for="research_field">research_field</label><br>
                <select name="research_field" id="research_field" required>
                <option value="Accounting and Managerial
                Accounting
                ">Accounting and Managerial
                Accounting
                </option>
                <option value="Agriculture Sector and Wine">Producers</option>
                <option value="Brands and Branding ">Brands and Branding </option>
                <option value="Business Intelligence">Business Intelligence</option>
                <option value="Conflict Management ">Conflict Management </option>
                <option value="Corporate Wellness">Corporate Wellness</option>
                <option value="Disability, Diversity, Equity and">Inclusion</option>
                <option value="Digital Enterprise Management">Digital Enterprise Management</option>
                <option value="Economics and Development">Economics</option>
                <option value="Entrepreneurship and innovation ">Entrepreneurship and innovation </option>
                <option value="Education ">Education </option>
                <option value="Health-Care Leadership">Health-Care Leadership</option>
                <option value="Human Capital Management">Human Capital Management</option>
                <option value="Innovation Management">Innovation Management</option>
                <option value="Leadership ">Leadership </option>
                <option value="Marketing ">Marketing </option>
                <option value="Reputation Management and
Communication Stakeholder
Strategy">Reputation Management and
Communication Stakeholder
Strategy</option>
                <option value="Operations Management">Operations Management</option>
                <option value="Project Management">Project Management</option>
                <option value="Reflection and meaning">Reflection and meaning</option>
                <option value="Strategic Management">Strategic Management</option>
                <option value="Sustainability">Sustainability</option>
                </select>
    
                <!-- sub_topics -->
                <label for="sub_topics">sub_topics</label><br>
                <input type="text" id="sub_topics" name="sub_topics" required><br>
                <!-- mini_topics -->
                <label for="mini_topics">mini_topics</label><br>
                <input type="text" id="mini_topics" name="mini_topics"><br>
                <!-- submit -->
                <input class="submit-btn px-5 my-2" type="submit" name="submit" value="Add Details">
            </form>

        </div>
    </div>
</div>
    ';


    // Return the create item form in html
    return $output;
}
// register shortcode
add_shortcode('add_topic', 'add_topic');
?>