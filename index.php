<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$folder = "./departure"; // folder path

$files = glob($folder . "/*.xlsx"); // get all file names in the folder

$dataListvoyage = []; // array to store all data
$datalistdeparture = [];

$sheetName = "DEPARTURE"; // sheet name

function dateConvert($date)
{
    // Extract day, month, and year from the date string
    $day = substr($date, 0, 1);
    $month = substr($date, 1, 2);
    $year = substr($date, 3, 4);

    // Format the date as YYYYMMDD
    return $year . $month . str_pad($day, 2, '0', STR_PAD_LEFT);
}

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
    "voyplan_distancetogo" => "J15",
];



$reader = new Xlsx();
foreach ($files as $file) {
    // Skip temporary or hidden files
    if (strpos(basename($file), '~$') === 0) {
        continue;
    }
    $spreadsheet = $reader->load($file); // Load the excel file
    $sheet = $spreadsheet->getSheetByName($sheetName); // Get the sheet by name
    $data = [];
    foreach ($voyage as $key => $cell) {
        $data[$key] = $sheet->getCell($cell)->getValue();
    } // Get the cell value
    $dataListvoyage[] = $data;
    foreach ($departure as $key => $cell) {
        $data[$key] = $sheet->getCell($cell)->getValue();
    } // Get the cell value
    $datalistdeparture[] = $data;
    break;
}
$dataListvoyage[0]["date_departure"] = dateConvert($dataListvoyage[0]["date_departure"]);



$host = "localhost";
$db = "c2i";
$user = "root";
$pwd = "";
$dsn = "mysql:host=$host;dbname=$db";
$option = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $user, $pwd, $option);
} catch (PDOException $e) {
    echo $e->getMessage();
}


// getting data from external tables to repoport departure and voyages.
// vessel
$vessel = "1";


// userid
$user = "1";

//getting departure and arrival ports ids
//id port depart
$sql = "select id_port from ports where code_port = :code_port";
$stmt = $pdo->prepare($sql);
$stmt->execute(["code_port" => $dataListvoyage[0]["id_port_depart"]]);
$id_port_depart = $stmt->fetch()["id_port"];
$dataListvoyage[0]["id_port_depart"] = $id_port_depart;
//id port arrival
$stmt->execute(["code_port" => $dataListvoyage[0]["id_port_arrival"]]);
$id_port_arrival = $stmt->fetch()["id_port"];
$dataListvoyage[0]["id_port_arrival"] = $id_port_arrival;

// creating the new voyage
foreach ($dataListvoyage as $data) {
    $sql = "INSERT INTO voyages (dcs_number, date_departure, time_departure, time_zone_departure, id_port_depart, id_port_arrival) VALUES (:dcs_number, :date_departure, :time_departure, :time_zone_departure, :id_port_depart, :id_port_arrival)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

print_r($pdo->lastInsertId());

// now getting ids for the departure report

foreach ($datalistdeparture as $data){
    $data["id_trv"] = $pdo->lastInsertId();
}


















foreach ($dataListvoyage as $data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
//  foreach ($datalistdeparture as $data) {
//     echo "<pre>";
//     print_r($data);
//     echo "</pre>";
    
//  }
