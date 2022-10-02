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

        fgetcsv($csvfile); // Skipping header row

        // Read file
        while (($csvData = fgetcsv($csvfile)) !== FALSE) {
            $csvData = array_map("utf8_encode", $csvData);

            // Row column length
            $dataLen = count($csvData);
           
            // Assign value to variables
            $food_id = trim($csvData[0]);
            $sku_formid= trim($csvData[1]);
            $key_list = trim($csvData[2]);
            $food_description = trim($csvData[3]);
            $short_food_description = trim($csvData[4]);
            $common_portion_size_amount = trim($csvData[5]);
            $common_portion_size_unit = trim($csvData[6]);
            $common_portion_size_description = trim($csvData[7]);
            $common_portion_size = trim($csvData[8]);
            $food_type = trim($csvData[9]);
            $ncc_food_group = trim($csvData[10]);
            $ncc_food_group_category = trim($csvData[11]);
            $water = trim($csvData[12]);
            $energy = trim($csvData[13]);
            $total_protein = trim($csvData[14]);
            $total_fat = trim($csvData[15]);
            $total_carbohydrate = trim($csvData[16]);
            $total_dietary_fiber = trim($csvData[17]);
            $insoluble_dietary_fiber = trim($csvData[18]);
            $soluble_dietary_fiber = trim($csvData[19]);
            $calcium = trim($csvData[20]);
            $iron = trim($csvData[21]);
            $magnesium = trim($csvData[22]);
            $phosphorus = trim($csvData[23]);
            $potassium = trim($csvData[24]);
            $sodium = trim($csvData[25]);
            $zinc = trim($csvData[26]);
            $copper = trim($csvData[27]);
            $manganese = trim($csvData[28]);
            $selenium = trim($csvData[29]);
            $vitamin_c_ascorbic_acid = trim($csvData[30]);
            $thiamin_vitamin_b1 = trim($csvData[31]);
            $riboflavin_vitamin_b2 = trim($csvData[32]);
            $pantothenic_acid = trim($csvData[33]);
            $vitamin_b6_pyridoxine = trim($csvData[34]);
            $dietary_folate_quivalents = trim($csvData[35]);
            $vitamin_b12_cobalamin = trim($csvData[36]);
            $vitamin_b_calciferol = trim($csvData[37]);
            $vitamin_e_total_alpha_tocopherol = trim($csvData[38]);
            $vitamin_k_phylloquinone = trim($csvData[39]);
            $choline = trim($csvData[40]);
            $total_saturated_fatty_acids = trim($csvData[41]);
            $total_monounsaturated_fatty_acids = trim($csvData[42]);
            $total_polyunsaturated_fatty_acids = trim($csvData[43]);
            $total_frans_fatty_acids_trans = trim($csvData[44]);
            $cholesterol = trim($csvData[45]);
            $added_sugars_by_total_sugars = trim($csvData[46]);
            $total_sugars = trim($csvData[47]);
            $omega_3_fatty_acids = trim($csvData[48]);
            $total_vitamin_a_activity = trim($csvData[49]);
            $niacin_equivalents = trim($csvData[50]);

            $cntSQL = "SELECT count(*) as count FROM `wp_standard_nutrients_wpcps` where sku_formid='" . $sku_formid . "'";
            $record = $wpdb->get_results($cntSQL, OBJECT);
            if ($record[0]->count == 0) {

                // Insert Record

                $wpdb->insert('wp_standard_nutrients_wpcps', array(
                    'food_id' => $food_id,
                    'sku_formid' => $sku_formid,
                    'key_list' => $key_list,
                    'food_description' => $food_description,
                    'short_food_description' => $short_food_description,
                    'common_portion_size_amount' => $common_portion_size_amount,
                    'common_portion_size_unit' => $common_portion_size_unit,
                    'common_portion_size_description' => $common_portion_size_description,
                    'common_portion_size' => $common_portion_size,
                    'food_type' => $food_type,
                    'ncc_food_group' => $ncc_food_group,
                    'ncc_food_group_category' => $ncc_food_group_category,
                    'water' => $water,
                    'energy' => $energy,
                    'total_protein' => $total_protein,
                    'total_fat' => $total_fat,
                    'total_carbohydrate' => $total_carbohydrate,
                    'total_dietary_fiber' => $total_dietary_fiber,
                    'insoluble_dietary_fiber' => $insoluble_dietary_fiber,
                    'soluble_dietary_fiber' => $soluble_dietary_fiber,
                    'calcium' => $calcium,
                    'iron' => $iron,
                    'magnesium' => $magnesium,
                    'phosphorus' => $phosphorus,
                    'potassium' => $potassium,
                    'sodium' => $potassium,
                    'zinc' => $zinc,
                    'copper' => $copper,
                    'manganese' => $manganese,
                    'selenium' => $selenium,
                    'vitamin_c_ascorbic_acid' => $vitamin_c_ascorbic_acid,
                    'thiamin_vitamin_b1' => $thiamin_vitamin_b1,
                    'riboflavin_vitamin_b2' => $riboflavin_vitamin_b2,
                    'pantothenic_acid' => $pantothenic_acid,
                    'vitamin_b6_pyridoxine' => $vitamin_b6_pyridoxine,
                    'dietary_folate_quivalents' => $dietary_folate_quivalents,
                    'vitamin_b12_cobalamin' => $vitamin_b12_cobalamin,
                    'vitamin_b_calciferol' => $vitamin_b_calciferol,
                    'vitamin_e_total_alpha_tocopherol' => $vitamin_e_total_alpha_tocopherol,
                    'vitamin_k_phylloquinone' => $vitamin_k_phylloquinone,
                    'choline' => $choline,
                    'total_saturated_fatty_acids' => $total_saturated_fatty_acids,
                    'total_monounsaturated_fatty_acids' => $total_monounsaturated_fatty_acids,
                    'total_frans_fatty_acids_trans' => $total_frans_fatty_acids_trans,
                    'cholesterol' => $cholesterol,
                    'added_sugars_by_total_sugars' => $added_sugars_by_total_sugars,
                    'total_sugars' => $total_sugars,
                    'omega_3_fatty_acids' => $omega_3_fatty_acids,
                    'total_vitamin_a_activity' => $total_vitamin_a_activity,
                    'niacin_equivalents' => $niacin_equivalents
                    
                ));
               
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
                <h3 class="panel-title">Standard Nutrients wpcps</h3>
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