<?php

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

$datamist= $voyage;
$datamist+= $departure;

echo "<pre>";
print_r($datamist);
echo "</pre>";