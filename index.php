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

$reader = new Xlsx();
 foreach ($files as $file) {
    // Skip temporary or hidden files
    if (strpos(basename($file), '~$') === 0) {
        continue;
    }
    $spreadsheet = $reader->load($file);// Load the excel file
    $sheet = $spreadsheet->getSheetByName($sheetName);// Get the sheet by name
    $data = [];
    foreach ($cells as $key => $cell) {
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