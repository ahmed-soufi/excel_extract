<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


$folder = "./departure"; // folder path
$files = glob($folder . "/*.xlsm"); // get all file names in the folder
$dataListarrival = []; // array to store all data
$sheetName = "DEPARTURE"; // sheet name

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


$reader = new Xlsx();
echo"1";
$ports = [];
$i=0;
foreach ($files as $file) {
    // Skip temporary or hidden files
    if (strpos(basename($file), '~$') === 0) {
        continue;
    }
    $spreadsheet = $reader->load($file); // Load the excel file
    $sheet = $spreadsheet->getSheetByName($sheetName); // Get the sheet by name
    $cellValue = $sheet->getCell('B7')->getValue(); // Get the value of cell J23
    echo $cellValue."<br>";
}