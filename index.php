<?php
/*
 Plugin Name: Import CSV File
 Description: This is a simpal Plugin Import csv file.
 Author: Vishwakarma
 */

add_action('admin_menu', 'data_import_csvFile');

function data_import_csvFile()
{
    add_menu_page(
        'CSV File Import', //page_title.
        'CSV File Import', //menu_title 
        'manage_options', //capability 
        'csv_file_export', //$menu_slug
        'csv_file_export_cbf', //callback 
        'dashicons-media-text', //icon_url  
        3 //position
    );

    add_submenu_page(
        'csv_file_export', //parent_slug
        'CSV Ncc Food Links', //page_title.
        'CSV Ncc Food Links', //menu_title 
        'manage_options', //capability 
        'csv_file_ncc_food_link', //$menu_slug
        'csv_file_ncc_food_link_cf', //callback 
        'dashicons-media-text', //icon_url  
        1 //position
    );

    add_submenu_page(
        'csv_file_export', //parent_slug
        'Food Specific', //page_title.
        'Food Specific', //menu_title 
        'manage_options', //capability 
        'food_specific', //$menu_slug
        'food_specific_cf', //callback 
        'dashicons-media-text', //icon_url  
        2 //positi
    );

    add_submenu_page(
        'csv_file_export', //parent_slug
        'Standard Nutrients Water', //page_title.
        'Standard Nutrients Water', //menu_title 
        'manage_options', //capability 
        'standard_nutrients_water', //$menu_slug
        'standard_nutrients_water_cf', //callback 
        'dashicons-media-text', //icon_url  
        3 //positi
    );

    add_submenu_page(
        'csv_file_export', //parent_slug
        'Standard Nutrients', //page_title.
        'Standard Nutrients', //menu_title 
        'manage_options', //capability 
        'standard_nutrients', //$menu_slug
        'standard_nutrients_wpg_cf', //callback 
        'dashicons-media-text', //icon_url  
        4 //positi
    );
}
// add_action('admin_menu','data_import_csvFile');

function csv_file_export_cbf()
{
    ob_start();
    include_once plugin_dir_path(__FILE__) . 'views/Densities.php';
    $template = ob_get_contents();
    ob_end_clean();
    echo $template;
}

function csv_file_ncc_food_link_cf()
{
    ob_start();
    include_once plugin_dir_path(__FILE__) . 'views/ncc_food_links.php';
    $template = ob_get_contents();
    ob_end_clean();
    echo $template;
}

function food_specific_cf()
{
    ob_start();
    include_once plugin_dir_path(__FILE__) . 'views/food_specific.php';
    $template = ob_get_contents();
    ob_end_clean();
    echo $template;
}

function standard_nutrients_water_cf()
{
    ob_start();
    include_once plugin_dir_path(__FILE__) . 'views/standard_nutrients_wpcps.php';
    $template = ob_get_contents();
    ob_end_clean();
    echo $template;
}

function standard_nutrients_wpg_cf()
{
    ob_start();
    include_once plugin_dir_path(__FILE__) . 'views/standard_nutrients.php';
    $template = ob_get_contents();
    ob_end_clean();
    echo $template;
}


