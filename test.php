<?php

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
            return $year.$month.$day;
        }
    }
}

$date = "19022025";
echo dateConvert($date);
