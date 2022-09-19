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


                $arrayData = getPanelArrayData($rows);


                // ===========================================================================
                ?>



                <?php foreach($arrayData as $tableRow) { ?>
                    <tr>
                    <td> <?= changeFormat($tableRow[0]) ?> <br> to <br><?= changeFormat($tableRow[1]) ?> </td>

                    <?php foreach($tableRow[2] as $cell) { ?>

                        <td class="nb">
                        <?= substr($cell, 0, 1) ?> <br>
                        <?= substr($cell, 1, 1) ?><br>
                        <?= substr($cell, 2, 1) ?><br>
                        </td>
                        <td><?= substr($cell, 3, 2) ?></td>
                        <td class="nb">
                        <?= substr($cell, 5, 1) ?><br>
                        <?= substr($cell, 6, 1) ?><br>
                        <?= substr($cell, 7, 1) ?><br>
                        </td>

                  <?php  } ?>

                    </td>

                <?php } ?>

            </tbody>
        </table>
    </div>


</div>

</body>

</html>


<?=$this->endSection()?>