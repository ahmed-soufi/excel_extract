<?php

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$folder ="./departure"; // folder path

$files = glob($folder."/*.xlsx"); // get all file names in the folder

$dataList = []; // array to store all data

$sheetName = "DEPARTURE"; // sheet name

$cells = [
    "Voyage reference" => "B5",
    "DCS Voyage N°" => "B6",
    "Departure Port" => "B7",
    "Destination Port" => "B8",
    "Type Of Next Call" => "B9",
    "UK/EU Port?" => "B10",
    "Left Berth Date" => "B11",
    "Left Berth Local Time" => "B12",
    "Left Berth  Time-zone  " => "C12",
    "GPS trip counter " => "B13",
    "Speed log trip counter" => "B14",
];


$voyage = [
    "dcs_number" => "B6",
    "date_departure" => "B11",
    "time_departure" => "B12",
    "time_zone_departure" => "C12",
    "id_port_depart" => "B7",
    "id_port_arrival" => "B8",
];



$departure = [
    "depdata_type" => "B9",
    "depdata_eu_uk_mrv" => "B10",
    "depdata_date" => "B11",
    "depdata_local_time" => "B12",
    "depdata_time_zone" => "C12",
    "depdata_gps_trip" => "B13",
    "depdata_speed_log_trip" => "B14",
    "depdata_type_cargo1" => "B15",
    "depdata_type_cargo2" => "C15",
    "depdata_total_volume_lng" => "B16",
    "depdata_total_cargo_onboard" => "B17",
    "weath_wind_force" => "F5",
    "weath_sea_state" => "F6",
    "weat_bfrt" => "F7",
    "fg_to_boilers" => "F9",
    "fg_to_dfde1" => "F10",
    "fg_to_dfde2" => "F11",
    "fg_to_dfde3" => "F12",
    "fg_to_dfde4" => "F13",
    "fg_gcu" => "F14",
    "fg_vapour_mast" => "F15",
    "lsfo" => "J5",
    "ulsfo" => "J6",
    "mgo" => "J7",
    "lng_ctms" => "J8",
    "lo" => "J9",
    "propulsion_stbd" => "J11",
    "propulsion_revo" => "J12",
    "voyplan_eta" => "J14",
    "voyplan_distancetogo"=> "J15",
];



$reader = new Xlsx();
 foreach ($files as $file) {
    // Skip temporary or hidden files
    if (strpos(basename($file), '~$') === 0) {
        continue;
    }
    $spreadsheet = $reader->load($file);// Load the excel file
    $sheet = $spreadsheet->getSheetByName($sheetName);// Get the sheet by name
    $data = [];
    foreach ($voyage as $key => $cell) {
        $data[$key] = $sheet->getCell($cell)->getValue();
    }// Get the cell value
    foreach ($departure as $key => $cell) {
        $data[$key] = $sheet->getCell($cell)->getValue();
    }// Get the cell value
    $dataList[] = $data;
    break;
 }

 foreach ($dataList as $data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    
 }