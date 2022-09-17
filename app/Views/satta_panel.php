<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <link rel="stylesheet" href="<?= base_url();?>/public/asset/css/satta.css">
</head>

<body>

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





                    $startDateStr = $rows[0]['created_at'];
                    $mondayDate = findPreviouMonDate($startDateStr);
                    $sundayDate = findNextSunDate($startDateStr);

                    
                    print_r($rows[0]);

                    for ($index = 0;  $index < count($rows); $index++) {



                        $currentRow = $rows[$index];




                        $mondayDate = findPreviouMonDate($currentRow['created_at'], true);
                        $sundayDate = findNextSunDate($currentRow['created_at'], true);

                        

                        // loop to create table row

                        ?>

                        <tr>
                        <td> <?= $mondayDate ?> <br> to <br>  <?= $sundayDate ?> </td>



                        

         <?php       } ?>

                    <h1><?= count($rows) ?></h1>


                    <tr>
                        <td>18/12/1998 <br> to <br> 18/12/1998 </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                    </tr>

                    <tr>
                        <td>18/12/1998 <br> to <br> 18/12/1998 </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>
                        <td>89</td>
                        <td class="nb">
                            1<br>
                            1<br>
                            1<br>
                        </td>

                    </tr>


                </tbody>
            </table>
        </div>


    </div>

</body>

</html>