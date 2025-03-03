<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


function dateConvert($date)
{
    if($date == null || $date == ""){
        return "";
    }
    if (strlen($date) == 7) {
        // Extract day, month, and year from the date string
        $day = substr($date, 0, 1);
        $month = substr($date, 1, 2);
        $year = substr($date, 3, 4);

        // Format the date as YYYYMMDD
        return $year . $month . str_pad($day, 2, '0', STR_PAD_LEFT);
    } else {
        if (strlen($date) == 8) {
            $day = substr($date, 0, 2);
            $month = substr($date, 2, 2);
            $year = substr($date, 4, 4);
            return $year . $month . $day;
        }
    }
}


$noonCells = [
    "vessel_status" => "B5",
    "voyage_ref" => "B6",
    "dcs_voy_dcs" => "B7",
    "port_destination" => "B8",
    "date_noon" => "B9",
    "local_time" => "B10",
    "time_zone" => "C10",
    "latitude" => "B11",
    "longitude" => "B12",
    "course" => "B13",
    "speed" => "B14",
    "gps_trip" => "B15",
    "distance" => "B16",
    "speed_log" => "B17",
    "sosp_date" => "B20",
    "sosp_local_time" => "B21",
    "sosp_time_zone" => "C21",
    "sosp_gps_trip" => "B22",
    "sosp_speed_log" => "B23",
    "sosp_lsfo" => "B25",
    "sosp_ulsfo" => "B26",
    "sosp_mgo" => "B27",
    "sosp_lng_ctms" => "B28",
    "wind" => "F5",
    "sea_state" => "F6",
    "hours_wind" => "F7",
    "tank1_temp_p" => "F9",
    "tank1_temp_s" => "G9",
    "tank2_temp_p" => "F10",
    "tank2_temp_s" => "G10",
    "tank3_temp_p" => "F11",
    "tank3_temp_s" => "G11",
    "tank4_temp_p" => "F12",
    "tank4_temp_s" => "G12",
    "tank1_pres_p" => "F14",
    "tank1_pres_s" => "G14",
    "tank2_pres_p" => "F15",
    "tank2_pres_s" => "G15",        
    "tank3_pres_p" => "F16",
    "tank3_pres_s" => "G16",
    "tank4_pres_p" => "F17",
    "tank4_pres_s" => "G17",
    "eosp_date" => "F20",
    "eosp_local_time" => "F21",
    "oesp_time_zone" => "G21",
    "oesp_gps_trip" => "F22",
    "oesp_speed_log" => "F23",
    "oesp_lsfo" => "F25",
    "oesp_ulsfo" => "F26",  
    "oesp_mgo" => "F27",
    "oesp_lng_ctms" => "F28",
    "noon_lsfo" => "J5",
    "noon_ulsfo" => "J6",   
    "noon_mgo" => "J7",
    "noon_lng_ctms" => "J8",
    "noon_lo" => "J9",
    "propdata_rpm_at_noon" => "J11",
    "propdata_prc_stbd" => "J12",
    "propdata_prc_port" => "J13",
    "eta_date" => "J16",
    "eta_local_time" => "J17",
    "eta_time_zone" => "K17",
    "dad_port" => "J20",
    "dad_da_date" => "J21",
    "dad_local_time" => "J22",
    "dad_time_zone" => "K22",
    "dad_gps_trip" => "J23",
    "aud_date" => "J25",
    "aud_local_time" => "J26",
    "aud_time_zone" => "K26",
    "aud_gps_trip" => "J27",
];


$folder = "./noon"; // folder path
$files = glob($folder . "/*.xlsm"); // get all file names in the folder
$dataListarrival = []; // array to store all data
$sheetName = "NOON"; // sheet name

$reader = new Xlsx();
$i = 0;

foreach ($files as $file){
    // Skip temporary or hidden files
    if (strpos(basename($file), '~$') === 0) {
        continue;
    }
    $spreadsheet = $reader->load($file); // Load the excel file
    $sheet = $spreadsheet->getSheetByName($sheetName); // Get the sheet by name
    $data = [];
    echo basename($file) . "<br>";
    foreach ($noonCells as $key => $cell) {
        $data[$key] = $sheet->getCell($cell)->getValue();
    } // Get the cell value
    $dataListnoon[] = $data;
    $data = [];
    foreach ($noonCells as $key => $cell) {
        $data[$key] = $sheet->getCell($cell)->getValue();
        echo $key . "=>" . $data[$key] . "<br>";
    } // Get the cell value
    echo "<br> ----------------------- <br>";
    $datalistnoon[] = $data;
    $dataListnoon[$i]["date_noon"] = dateConvert($dataListnoon[$i]["date_noon"]);
    $datalistnoon[$i]["sosp_date"] = dateConvert($datalistnoon[$i]["sosp_date"]);
    $datalistnoon[$i]["eosp_date"] = dateConvert($datalistnoon[$i]["eosp_date"]);
    $datalistnoon[$i]["eta_date"] = dateConvert($datalistnoon[$i]["eta_date"]);
    $datalistnoon[$i]["dad_da_date"] = dateConvert($datalistnoon[$i]["dad_da_date"]);
    $datalistnoon[$i]["aud_date"] = dateConvert($datalistnoon[$i]["aud_date"]);
    $i++;
    // break;
}
echo $i;