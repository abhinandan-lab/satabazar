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

function findPreviouMonDate($date, $changeFormat = false) {

    $onlydate = substr($date, 0, 10);

    $day = date('D', strtotime(substr($onlydate, 0, 10)));
    
    $lastMonday = date('Y-m-d',strtotime('last monday', strtotime($onlydate)));
    
    
    if($day == 'Mon' && $changeFormat == true) {
        return date("d/m/Y", strtotime($onlydate) );
    }
    
    if($day == 'Mon') {
        return $onlydate;
    }
    

    if($changeFormat) {

        return date("d/m/Y", strtotime($lastMonday) );
    }

    return $lastMonday;
}


function findNextSunDate($date, $changeFormat = false) {

    $onlydate = substr($date, 0, 10);

    $day = date('D', strtotime(substr($onlydate, 0, 10)));

    $lastSunday = date('Y-m-d',strtotime('next sunday', strtotime($onlydate)));


    if($day == 'Sun' && $changeFormat == true) {
        return date("d/m/Y", strtotime($onlydate) );
    }
    
    if($day == 'Sun') {
        return $onlydate;
    }

    if($changeFormat) {

        return date("d/m/Y", strtotime($lastSunday) );
    }

    return $lastSunday;
}

function findCurrentDay($date) {

    $onlydate = strtotime(substr($date, 0, 10));
    $day = date('D', $onlydate);
    return $day;
}