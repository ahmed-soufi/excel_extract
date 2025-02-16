<?php

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;


$folder ="./departure";

$files = glob($folder."/*.xlsx");

// foreach ($files as $file) printf($file."\n");