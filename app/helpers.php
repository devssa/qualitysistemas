<?php

if (! function_exists('generateDateOfBirth')) {

    function generateDateOfBirth()
    {
        $current_year = date('Y');
        $year  = rand($current_year-18,$current_year-90);
        $month = rand(01,12);
        $day   = rand(01,30);
        return $year .'-'. str_pad($month, 2, '0', STR_PAD_LEFT) .'-'. str_pad($day, 2, '0', STR_PAD_LEFT);
    }
}

if (! function_exists('dateToBR')) {
    function dateToBR($date) {
        return date("d/m/Y", strtotime($date));
    }
}

if (! function_exists('dateToUS')) {
    function dateToUS($date) {
        $date = str_replace('/', '-', $date);
        return date('Y-m-d', strtotime($date));
    }
}

if (! function_exists('validateURL')) {
    function validateURL($str) {
        if(preg_match( '/^(http|https)/i' ,$str)){
            return $str;
        }
        else{
            return false;
        }
    }
}
