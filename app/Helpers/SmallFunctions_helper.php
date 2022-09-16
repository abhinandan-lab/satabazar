<?php

// (2022-09-25 22:43:14) default datetime format

function isTodayDate($date) {

    $onlydate = substr($date, 0, 10);


    // date_default_timezone_set("Asia/Calcutta");
    $currentDate = date('Y-m-d', time());

    if($onlydate == $currentDate){
        return 1;
    }
    else {
        return 0;
    }

}