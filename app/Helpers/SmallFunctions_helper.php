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

function changeFormat($date) {
    return date("d/m/Y", strtotime($date) );
}


function getPanelArrayData($rows) {
                   // echo '<pre>';
                // print_r($rows);
                // echo '</pre>';


                $arrayData = [];
                $rowData = [];
                $rowWeekData = [];
                $tableIndex = null;

                for ($index=0; $index < count($rows); $index++) {  

                    $m = findPreviouMonDate($rows[$index]['created_at']);
                    $s = findNextSunDate($rows[$index]['created_at']);
                    $currentDate = substr($rows[$index]['created_at'], 0, 10);
                    $currentDay = findCurrentDay($rows[$index]['created_at']);
                        
                    if($index == 0) {
                        // create row
                        // run for loop 
                        // next index

                        $tableIndex = 0;
                        array_push($rowData, $m ,$s );
                        
                        $n = $rows[$index]['satta_number'];
                        for ($i=0; $i <= 6 ; $i++) { 
    
                            if($i == 0 && $currentDay == 'Mon' ){
                                array_push($rowWeekData, $n);
                                continue;
                            }
    
                            if($i == 1 && $currentDay == 'Tue') {
                                array_push($rowWeekData, $n);
                                continue;
                            }
    
                            if($i == 2 && $currentDay == 'Wed') {
                                array_push($rowWeekData, $n);
                                continue;
                            }
    
                            if($i == 3 && $currentDay == 'Thu') {
                                array_push($rowWeekData, $n);
                                continue;
                            }
    
                            if($i == 4 && $currentDay == 'Fri') {
                                array_push($rowWeekData, $n);
                                continue;
                            }
    
                            if($i == 5 && $currentDay == 'Sat') {
                                array_push($rowWeekData, $n);
                                continue;
                            }
    
                            if($i == 6 && $currentDay == 'Sun') {
                                array_push($rowWeekData, $n);
                                continue;
                            }
    
                            else {
                                array_push($rowWeekData, '********');
                            }
                        }

                        array_push($rowData, $rowWeekData);
                        array_push($arrayData, $rowData);

                        $rowData = [];
                        $rowWeekData = [];
                        continue;
                    }
                                   
                    else {
                        $prevSun =  findNextSunDate($rows[$index - 1]['created_at']);
                        
                        if($currentDate > $prevSun) {
                            // create row
                            // run for loop 
                            // next index  

                            $tableIndex++;
                            array_push($rowData, $m ,$s );
                        
                            $n = $rows[$index]['satta_number'];
                            for ($i=0; $i <= 6 ; $i++) { 
        
                                if($i == 0 && $currentDay == 'Mon' ){
                                    array_push($rowWeekData, $n);
                                    continue;
                                }
        
                                if($i == 1 && $currentDay == 'Tue') {
                                    array_push($rowWeekData, $n);
                                    continue;
                                }
        
                                if($i == 2 && $currentDay == 'Wed') {
                                    array_push($rowWeekData, $n);
                                    continue;
                                }
        
                                if($i == 3 && $currentDay == 'Thu') {
                                    array_push($rowWeekData, $n);
                                    continue;
                                }
        
                                if($i == 4 && $currentDay == 'Fri') {
                                    array_push($rowWeekData, $n);
                                    continue;
                                }
        
                                if($i == 5 && $currentDay == 'Sat') {
                                    array_push($rowWeekData, $n);
                                    continue;
                                }
        
                                if($i == 6 && $currentDay == 'Sun') {
                                    array_push($rowWeekData, $n);
                                    continue;
                                }
        
                                else {
                                    array_push($rowWeekData, '********');
                                }
                            }
    
                            array_push($rowData, $rowWeekData);
                            array_push($arrayData, $rowData);
    
                            $rowData = [];
                            $rowWeekData = [];
                            continue;                                                                                                                                                                                                                         

                        }

                        else {
                            // issi row me continue
                            $getPrevrowData = $arrayData[$tableIndex][2];
                            $n = $rows[$index]['satta_number'];
                            for ($i=0; $i <= 6 ; $i++) { 
    
                                if($i == 0 && $currentDay == 'Mon' ){
                                   if($getPrevrowData[$i] == '********') {
                                       $getPrevrowData[$i] = $n;
                                }
                                    continue;
                                }
        
                                if($i == 1 && $currentDay == 'Tue') {
                                    if($getPrevrowData[$i] == '********') {
                                        $getPrevrowData[$i] = $n;
                                    }                                   
                                    continue;
                                }
        
                                if($i == 2 && $currentDay == 'Wed') {
                                    if($getPrevrowData[$i] == '********') {
                                        $getPrevrowData[$i] = $n;
                                    }
                                    continue;
                                }
        
                                if($i == 3 && $currentDay == 'Thu') {
                                    if($getPrevrowData[$i] == '********') {
                                        $getPrevrowData[$i] = $n;
                                    }
                                    continue;
                                }
        
                                if($i == 4 && $currentDay == 'Fri') {
                                    if($getPrevrowData[$i] == '********') {
                                        $getPrevrowData[$i] = $n;
                                    }
                                    continue;
                                }
        
                                if($i == 5 && $currentDay == 'Sat') {
                                    if($getPrevrowData[$i] == '********') {
                                        $getPrevrowData[$i] = $n;
                                    }
                                    continue;
                                }
        
                                if($i == 6 && $currentDay == 'Sun') {
                                    if($getPrevrowData[$i] == '********') {
                                        $getPrevrowData[$i] = $n;
                                    }
                                    continue;
                                }
        
                                else {
                                    // we do nothing as no need
                                }
                            }

                            // we just replace the array
                            $arrayData[$tableIndex][2] = $getPrevrowData;

                            continue;                         
                        }
                    }
                }

                // print_r($arrayData);
                return $arrayData;
}


function encryptionConfig() {
    $config = new \Config\Encryption();
    $config->key    = 'praisetheLORD';
    $config->driver = 'OpenSSL';

    return $config;
}