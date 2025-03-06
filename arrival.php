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

$arrivalCells = [
    "arr_calltype" => "B5",
    "arr_comp_dcs_voy_number" => "B6",
    "arr_arrival_port" => "B7",
    "arr_eu_uk" => "B8",
    "arr_fwe_date" => "B9",
    "arr_fwe_local_time" => "B10",
    "arr_fwe_time_zone" => "C10",
    "arr_gps_trip" => "B11",
    "arr_speed_log" => "B12",
    "sosp_start_date" => "B18",
    "sosp_local_time" => "B19",
    "sosp_time_zone" => "C19",
    "sosp_gps_trip" => "B20",
    "sosp_speed_log" => "B21",
    "sosp_lsfo" => "B23",
    "sosp_ulsfo" => "B24",
    "sosp_mgo" => "B25",
    "sosp_lng_ctms" => "B26",
    "weath_force" => "F5",
    "weath_sea_state" => "F6",
    "weath_hours_wind" => "F7",
    "fg_boilers" => "F9",
    "fg_dfde1" => "F10",
    "fg_dfde2" => "F11",
    "fg_dfde3" => "F12",
    "fg_dfde4" => "F13",
    "fg_gcu" => "F14",
    "fg_vapour" => "F15",
    "eosp_date" => "F18",
    "oesp_local_time" => "F19",
    "oesp_time_zone" => "G19",
    "oesp_gps_trip" => "F20",
    "oesp_speed_log" => "F21",
    "oesp_lsfo" => "F23",
    "oesp_ulsfo" => "F24",
    "oesp_mgo" => "F25",
    "oesp_lng_ctms" => "F26",
    "fwe_lsfo" => "J5",
    "fwe_ulsfo" => "J6",
    "fwe_mgo" => "J7",
    "fwe_lng_ctms" => "J8",
    "fwe_lo" => "J9",
    "propulsion_stbd" => "J11",
    "propulsion_revo" => "J12",
    "drift_total_distance" => "J14",
    "drift_time_adrift" => "J15",
    "anchor_date" => "J19",
    "anchor_local_time" => "J20",
    "anchor_time_zone" => "K20",
    "anchor_gps_trip" => "J21",
    "anchor_up_date" => "J23",
    "anchor_up_local_time" => "J24",
    "anchor_up_time_zone" => "K24",
    "anchor_up_gps_trip" => "J25",

];

$folder = "./arrival"; // folder path
$files = glob($folder . "/*.xlsm"); // get all file names in the folder
$dataListarrival = []; // array to store all data
$sheetName = "ARRIVAL"; // sheet name

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
    foreach ($arrivalCells as $key => $cell) {
        // echo $key."=>".$cell."<br>";
        $data[$key] = $sheet->getCell($cell)->getValue();
    } // Get the cell value
    $data["arr_fwe_date"] = dateConvert($data["arr_fwe_date"]);
    $data["sosp_start_date"] = dateConvert($data["sosp_start_date"]);
    $data["eosp_date"] = dateConvert($data["eosp_date"]);
    $data["anchor_date"] = dateConvert($data["anchor_date"]);
    $data["anchor_up_date"] = dateConvert($data["anchor_up_date"]);
    $dataListarrival[] = $data;
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

$i = 0;
foreach ($dataListarrival as $arrival){
    $sql = " SELECT * FROM voyages where dcs_number = :dcs_number";
    $stmt = $pdo->prepare($sql);    
    $stmt->execute(["dcs_number" => $arrival["arr_comp_dcs_voy_number"]]);
    $voyage = $stmt->fetch();   
    if (!$voyage){
        echo "voyage not found";
        continue;
    }
    $dataListarrival[$i]["id_trv"] = $voyage["id_trv"];
    echo "<pre>";   
    $sql = "UPDATE voyages set 
                date_arrival = :arr_fwe_date,
                time_arrival = :arr_fwe_local_time,
                time_zone_arrival = :arr_fwe_time_zone 
                where id_trv = :id_trv";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([
    //     "arr_fwe_date" => $arrival["arr_fwe_date"],
    //     "arr_fwe_local_time" => $arrival["arr_fwe_local_time"],
    //     "arr_fwe_time_zone" => $arrival["arr_fwe_time_zone"],
    //     "id_trv" => $voyage["id_trv"]
    // ]);
   

    // $sql = "INSERT INTO reports_arrival (".implode(",", array_keys($dataListarrival[$i])).") VALUES (:".implode(",:", array_keys($dataListarrival[$i])).")";

 
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute($dataListarrival[$i]);
    echo "arrival insterted";
    echo $arrival["arr_comp_dcs_voy_number"];
    print_r($voyage);
    echo "</pre>";  
    $i++;
}



echo "<pre>";
print_r($dataListarrival);
echo "</pre>";
