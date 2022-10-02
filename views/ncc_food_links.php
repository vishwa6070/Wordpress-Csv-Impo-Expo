<?php
require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');

// Import CSV file
if (isset($_POST['import'])) {

    global $wpdb;

    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    if (!empty($_FILES['file']['name'] && $extension == 'csv')) {

        $totalInserted = 0;

        // Open file in read mode
        $csvfile = fopen($_FILES['file']['tmp_name'], 'r');

        // echo'<pre>';
        // print_r($_FILES['file']['name']);
        // die;

        fgetcsv($csvfile); // Skipping header row

        // Read file
        while (($csvData = fgetcsv($csvfile)) !== FALSE) {
            $csvData = array_map("utf8_encode", $csvData);

            // echo'<pre>';
            // print_r($csvData);
            // die;

            // Row column length
            $dataLen = count($csvData);

            // Assign value to variables
            $food_id = trim($csvData[0]);
            $sku_formid = trim($csvData[1]);
            $key_list = trim($csvData[2]);
            $food_description = trim($csvData[3]);
            $food_type = trim($csvData[4]);
            $food_type_reference = trim($csvData[5]);
            $food_type_reference_description = trim($csvData[6]);

            $cntSQL = "SELECT count(*) as count FROM `wp_ncc_food_links` where sku_formid='" . $sku_formid . "'";
            $record = $wpdb->get_results($cntSQL, OBJECT);

            // echo '<pre>';
            // print_r($record);
            // die();

            if ($record[0]->count == 0) {

                // Insert Record

                $wpdb->insert('wp_ncc_food_links', array(
                    'food_id' => $food_id,
                    'sku_formid' => $sku_formid,
                    'key_list' => $key_list,
                    'food_description' => $food_description,
                    'food_type' => $food_type,
                    'food_type_reference' => $food_type_reference,
                    'food_type_reference_description' => $food_type_reference_description
                ));

                // echo '<pre>';
                // print_r($wpdb);
                //die();

            }
            $totalInserted++;
        }
        // if ($wpdb->insert_id > 0) {
        //     $totalInserted++;
        echo "<h3 style='color: green;'>Total record Inserted : " . $totalInserted . "</h3>";
        // }
    } else {
        echo "<h3 style='color: red;'>Invalid Extension</h3>";
    }
}

?>

<body>

    <div class="container">
        <h1 align="center">Import CSV File Data </h1>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Import CSV NCC Food Links</h3>
            </div>
            <div class="panel-body">
                <!-- <span id="message"></span> -->
                <form id="sample_form" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Select CSV File</label>
                        <input type="file" name="file" id="file" />
                    </div>
                    <div class="form-group" align="center">
                        <input type="hidden" name="hidden_field" value="1" />
                        <input type="submit" name="import" id="import" class="btn btn-primary" value="Import" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<br>