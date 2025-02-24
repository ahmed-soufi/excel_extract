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
    "weath_bfrt" => "F7",
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
$i = 0;
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
    $data = [];
    foreach ($departure as $key => $cell) {
        $data[$key] = $sheet->getCell($cell)->getValue();
    } // Get the cell value
    $datalistdeparture[] = $data;
    $dataListvoyage[$i]["date_departure"] = dateConvert($dataListvoyage[$i]["date_departure"]);
    $datalistdeparture[$i]["depdata_date"] = dateConvert($datalistdeparture[$i]["depdata_date"]);
    $i++;
    // break;
}

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

// creating the new voyage
for ($i = 0; $i < count($dataListvoyage); $i++) {

    //getting departure and arrival ports ids
    //id port depart
    $sql = "select id_port from ports where code_port = :code_port";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["code_port" => $dataListvoyage[$i]["id_port_depart"]]);
    $id_port_depart = $stmt->fetch()["id_port"];
    $dataListvoyage[$i]["id_port_depart"] = $id_port_depart;
    //id port arrival
    $stmt->execute(["code_port" => $dataListvoyage[$i]["id_port_arrival"]]);
    $id_port_arrival = $stmt->fetch()["id_port"];
    $dataListvoyage[$i]["id_port_arrival"] = $id_port_arrival;
    //voyaage insertion
    $sql = "INSERT INTO voyages (dcs_number, date_departure, time_departure, time_zone_departure, id_port_depart, id_port_arrival) VALUES (:dcs_number, :date_departure, :time_departure, :time_zone_departure, :id_port_depart, :id_port_arrival)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($dataListvoyage[$i]);
    //setting id_trv (voyage) in the departure array
    $datalistdeparture[$i]["id_trv"] = $pdo->lastInsertId();
}

//preparing and inserting the departure report
for ($i = 0; $i < count($datalistdeparture); $i++) {
    //setting the call type
    $sql = "SELECT * from type_call where type_tcl_name = :call_type";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["call_type" => $datalistdeparture[$i]["depdata_type"]]);
    $datalistdeparture[$i]["depdata_type"] = $stmt->fetch()["tcl"];

    //setting the eu/uk/mrv
    $sql = "SELECT * from mrv_ports where port_type = :eu_uk_mrv";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["eu_uk_mrv" => $datalistdeparture[$i]["depdata_eu_uk_mrv"]]);
    $datalistdeparture[$i]["depdata_eu_uk_mrv"] = $stmt->fetch()["mp"];

    // seeting cargo type
    $sql = "SELECT * from type_cargo where type_name = :cargo_type";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["cargo_type" => $datalistdeparture[$i]["depdata_type_cargo1"]]);
    $datalistdeparture[$i]["depdata_type_cargo1"] = $stmt->fetch()["tc"];
    if ($datalistdeparture[$i]["depdata_type_cargo2"] != null) {
        $stmt->execute(["cargo_type" => $datalistdeparture[$i]["depdata_type_cargo2"]]);
        $datalistdeparture[$i]["depdata_type_cargo2"] = $stmt->fetch()["tc"];
    } else {
        $datalistdeparture[$i]["depdata_type_cargo2"] = '0';
    }

    echo $datalistdeparture[$i]["depdata_date"] . "<br>";

    //inserting departure report
    $sql = "INSERT  into reports_departure SET     
    depdata_type = :depdata_type,
    depdata_eu_uk_mrv = :depdata_eu_uk_mrv,
    depdata_date = :depdata_date,
    depdata_local_time = :depdata_local_time,
    depdata_time_zone = :depdata_time_zone,
    depdata_gps_trip = :depdata_gps_trip,
    depdata_speed_log_trip = :depdata_speed_log_trip,
    depdata_type_cargo1 = :depdata_type_cargo1,
    depdata_type_cargo2 = :depdata_type_cargo2,
    depdata_total_volume_lng = :depdata_total_volume_lng,
    depdata_total_cargo_onboard = :depdata_total_cargo_onboard,
    weath_wind_force = :weath_wind_force,
    weath_sea_state = :weath_sea_state,
    weath_bfrt = :weath_bfrt,
    fg_toboilers = :fg_to_boilers,
    fg_dfde1 = :fg_to_dfde1, 
    fg_dfde2 = :fg_to_dfde2,
    fg_dfde3 = :fg_to_dfde3, 
    fg_dfde4 = :fg_to_dfde4,
    fg_gcu = :fg_gcu,
    fg_vapour_mast = :fg_vapour_mast,
    lsfo = :lsfo,
    ulsfo = :ulsfo,
    mgo = :mgo,
    lng_ctms = :lng_ctms,
    lo = :lo,
    propulsion_stbd = :propulsion_stbd,
    propulsion_revo = :propulsion_revo,
    voyplan_eta = :voyplan_eta,
    voyplan_distancetogo = :voyplan_distancetogo,
    id_trv = :id_trv";
    echo "<pre>";
    print_r($datalistdeparture[$i]);
    echo "</pre>";
    echo "<br>";
    print_r($sql);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($datalistdeparture[$i]);
}

