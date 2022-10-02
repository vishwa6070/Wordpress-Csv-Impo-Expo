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
            $food_type = trim($csvData[5]);
            $ncc_food_group = trim($csvData[6]);
            $ncc_food_group_category = trim($csvData[7]);
            $water = trim($csvData[8]);
            $energy = trim($csvData[9]);
            $total_protein = trim($csvData[10]);
            $total_fat = trim($csvData[11]);
            $total_carbohydrate = trim($csvData[12]);
            $total_dietary_fiber = trim($csvData[13]);
            $insoluble_dietary_fiber = trim($csvData[14]);
            $soluble_dietary_fiber = trim($csvData[15]);
            $calcium = trim($csvData[16]);
            $iron = trim($csvData[17]);
            $magnesium = trim($csvData[18]);
            $phosphorus = trim($csvData[19]);
            $potassium = trim($csvData[20]);
            $sodium = trim($csvData[21]);
            $zinc = trim($csvData[22]);
            $copper = trim($csvData[23]);
            $manganese_mg = trim($csvData[24]);
            $selenium_mcg = trim($csvData[25]);
            $vitamin_c_ascorbic_acid_mg = trim($csvData[26]);
            $thiamin_vitamin_b1_mg = trim($csvData[27]);
            $riboflavin_vitamin_b2_mg = trim($csvData[28]);
            $pantothenic_acid_mg = trim($csvData[29]);
            $vitamin_b6_ppp = trim($csvData[30]);
            $dietary_folate_quivalents_mcg = trim($csvData[31]);
            $vitamin_b12_cobalamin_mcg = trim($csvData[32]);
            $vitamin_b_calciferol_mcg = trim($csvData[33]);
            $vitamin_e_total_alpha_tocopherol_mg = trim($csvData[34]);
            $vitamin_k_phylloquinone_mcg = trim($csvData[35]);
            $choline_mg = trim($csvData[36]);
            $total_saturated_fatty_acids_sfa_g = trim($csvData[37]);
            $total_monounsaturated_fatty_acids_mufa_g = trim($csvData[38]);
            $total_polyunsaturated_fatty_acids_pufa_g = trim($csvData[39]);
            $total_frans_fatty_acids_trans_g = trim($csvData[40]);
            $cholesterol_mg = trim($csvData[41]);
            $added_sugars_by_total_sugars_g = trim($csvData[42]);
            $total_sugars_g = trim($csvData[43]);
            $omega_3_fatty_acids_g = trim($csvData[44]);
            $total_vitamin_a_activity_retinol_activity_equivalents_mcg = trim($csvData[45]);
            $niacin_equivalents_mg = trim($csvData[46]);

            $cntSQL = "SELECT count(*) as count FROM `wp_standard_nutrients_wpg` where sku_formid='" . $sku_formid . "'";
            $record = $wpdb->get_results($cntSQL, OBJECT);
            if ($record[0]->count == 0) {

                // Insert Record

                $wpdb->insert('wp_standard_nutrients_wpg', array(
                    'food_id' => $food_id,
                    'sku_formid' => $sku_formid,
                    'key_list' => $key_list,
                    'food_description' => $food_description,
                    'short_food_description' => $short_food_description,
                    'food_type' => $food_type,
                    'ncc_food_group' => $ncc_food_group,
                    'ncc_food_group_category' => $ncc_food_group_category,
                    'water' => $water,
                    'energy' => $energy,
                    'total_protein' => $total_protein,
                    'total_fat' => $total_fat,
                    'total_carbohydrate' => $total_carbohydrate,
                    'total_dietary_fiber' => $total_dietary_fiber,
                    'insoluble_dietary_fiber' => $insoluble_dietary_fiber   ,
                    'soluble_dietary_fiber' => $soluble_dietary_fiber,
                    'calcium' => $calcium,
                    'iron' => $iron,
                    'magnesium' => $magnesium,
                    'phosphorus' => $phosphorus,
                    'potassium' => $potassium,
                    'sodium' => $potassium,
                    'zinc' => $zinc,
                    'copper' => $copper,
                    'manganese_mg' => $manganese_mg,
                    'selenium_mcg' => $selenium_mcg,
                    'vitamin_c_ascorbic_acid_mg' => $vitamin_c_ascorbic_acid_mg,
                    'thiamin_vitamin_b1_mg' => $thiamin_vitamin_b1_mg,
                    'riboflavin_vitamin_b2_mg' => $riboflavin_vitamin_b2_mg,
                    'pantothenic_acid_mg' => $pantothenic_acid_mg,
                    'vitamin_b6_ppp' => $vitamin_b6_ppp,
                    'dietary_folate_quivalents_mcg' => $dietary_folate_quivalents_mcg,
                    'vitamin_b12_cobalamin_mcg' => $vitamin_b12_cobalamin_mcg,
                    'vitamin_b_calciferol_mcg' => $vitamin_b_calciferol_mcg,
                    'vitamin_e_total_alpha_tocopherol_mg' => $vitamin_e_total_alpha_tocopherol_mg,
                    'vitamin_k_phylloquinone_mcg' => $vitamin_k_phylloquinone_mcg,
                    'choline_mg' => $choline_mg,
                    'total_saturated_fatty_acids_sfa_g' => $total_saturated_fatty_acids_sfa_g,
                    'total_monounsaturated_fatty_acids_mufa_g' => $total_monounsaturated_fatty_acids_mufa_g,
                    'total_polyunsaturated_fatty_acids_pufa_g' => $total_polyunsaturated_fatty_acids_pufa_g,
                    'total_frans_fatty_acids_trans_g' => $total_frans_fatty_acids_trans_g,
                    'cholesterol_mg' => $cholesterol_mg,
                    'added_sugars_by_total_sugars_g' => $added_sugars_by_total_sugars_g,
                    'total_sugars_g' => $total_sugars_g,
                    'omega_3_fatty_acids_g' => $omega_3_fatty_acids_g,
                    'total_vitamin_a_activity_retinol_activity_equivalents_mcg' => $total_vitamin_a_activity_retinol_activity_equivalents_mcg,
                    'niacin_equivalents_mg' => $niacin_equivalents_mg
                    
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
                <h3 class="panel-title">Standard Nutrients wpg</h3>
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