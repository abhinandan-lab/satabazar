<?=$this->extend("head")?>

<?=$this->section("content")?>

    <div class="container">
        <h1 class="logo">sata bazar</h1>


        <button type="button"> Goto Bottom</button>

        <div class="panel">
            <h1>Madhuri panel chart</h1>
            <table>
                <thead>
                    <tr>

                        <th colspan="">date</th>
                        <th colspan="3">mon</th>
                        <th colspan="3">tue</th>
                        <th colspan="3">wed</th>
                        <th colspan="3">thu</th>
                        <th colspan="3">fri</th>
                        <th colspan="3">sat</th>
                        <th colspan="3">sun</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>


                    <?php

                // echo '<pre>';
                // print_r($rows);
                // echo '</pre>';



                for ($index=0; $index < count($rows) ; $index++) {
                    // for ($index=0; $index < 1 ; $index++) { 

                    
                    $monday = findPreviouMonDate($rows[$index]['created_at'], true);
                    $sunday = findNextSunDate($rows[$index]['created_at'], true);

                    $currentDay = findCurrentDay($rows[$index]['created_at']);
                    $currentDate = substr($rows[$index]['created_at'], 0, 10);

                    echo '<h1>'. $currentDate . '</h1>';

                    // dates without format change
                    $m = findPreviouMonDate($rows[$index]['created_at']);
                    $s = findNextSunDate($rows[$index]['created_at']);


                    if($index != 0) {
                        $prevSun =  findNextSunDate($rows[$index - 1]['created_at']);  
                        
                        if($currentDate > $prevSun) {
                            // create new row

                            // echo '<h1> create New ROw'. $index . '</h1>';
                            echo "<tr>  <td> $monday <br> to <br> $sunday </td>";
                        }

                    }
                    else {
                        // at index 0
                        echo "<tr>  <td> $monday <br> to <br> $sunday </td>";

                    }



                    // echo 'monday = '.$monday;
                    // echo '<br>';
                    // echo 'sunday = '.$sunday;
                    
                    // echo '<br>';
                    // echo '<br>';
                    // echo '<br>';
                    // // $m = new DateTime($monday);
                    // // echo $m;

                    // $m = findPreviouMonDate('2000-01-22');
                    // $s = findNextSunDate('1999-12-05');

                    // echo 'monday = '.$m;
                    // echo '<br>';
                    // echo 'sunday = '.$s;
                    // echo '<br>';
                    // if ( $m > $s ) {
                    //     echo 'monday is gretaer';
                    // }
                    // else {
                    //     echo 'sunday is greater';
                    // }








                    
                    $n = $rows[$index]['satta_number'];

                    $tdstar = ' <td class="nb" >
                    *<br>
                    *<br>
                    *<br>
                    </td>
                    <td>**</td>
                    <td class="nb">
                        *<br>
                        *<br>
                        *<br>
                    </td> ' ;
    
                    $tdnumber =  ' <td class="nb" >
                    '. substr($n, 0, 1) . ' <br>
                    '. substr($n, 1, 1) . ' <br>
                    '. substr($n, 2, 1) . ' <br>
                    </td>
                    <td> '. substr($n, 3, 2) . '</td>
                    <td class="nb">
                    '. substr($n, 5, 1) . ' <br>
                    '. substr($n, 6, 1) . ' <br>
                    '. substr($n, 7, 1) . ' <br>
                    </td> ' ;
                    
                    // echo '<h1>'. $n . '</h1>';
                    // echo '<h1>'. $currentDay . '</h1>';
                    // echo '<h1>'. $monday . ' to '. $sunday . '</h1>';
                    // echo '<h1>'. $sunday . '</h1>';
                    
                    // echo "<tr>  <td> $monday <br> to <br> $sunday </td>";
                    
 
                    


                    for ($i=0; $i <= 6 ; $i++) { 

                        if($i == 0 && $currentDay == 'Mon' ){
                            echo $tdnumber;
                            continue;
                        }

                        if($i == 1 && $currentDay == 'Tue') {
                            echo $tdnumber;
                            continue;
                        }

                        if($i == 2 && $currentDay == 'Wed') {
                            echo $tdnumber;
                            continue;
                        }


                        if($i == 3 && $currentDay == 'Thu') {
                            echo $tdnumber;
                            continue;
                        }


                        if($i == 4 && $currentDay == 'Fri') {
                            echo $tdnumber;
                            continue;
                        }


                        if($i == 5 && $currentDay == 'Sat') {
                            echo $tdnumber;
                            continue;
                        }


                        if($i == 6 && $currentDay == 'Sun') {
                            echo $tdnumber;
                            continue;
                        }


                        else {

                            echo $tdstar;
                        }

                    }

                    // echo '</tr>';


                }
                
                
                
                ?>


                </tbody>
            </table>
        </div>


    </div>

</body>

</html>


<?=$this->endSection()?>