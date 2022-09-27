<?=$this->extend("head")?>

<?=$this->section("content")?>



        <button type="button" class="blue-btn my1"> Goto Bottom</button>


        <div class="jodi">
            <h1 class="pink-head uppercase"> <?= $satta['name'] ?>  </h1>
            <table >
                <thead>
                    <tr>

                        <th >mon</th>
                        <th >tue</th>
                        <th >wed</th>
                        <th >thu</th>
                        <th >fri</th>
                        <th >sat</th>
                        <th >sun</th>
                    </tr>                  
                </thead>
                <tbody>

                 <tr>

                 <?php 

                 $datas = getPanelArrayData($rows);

                 foreach ($datas as $data) { ?>

                 <tr>

                    <?php foreach($data[2] as $cell) { ?>

                        <td><?= substr($cell, 3, 2) ?></td>

                    <?php } ?>

                    </tr>


                 <?php } ?>
                 
                 </tr>

                
                </tbody>
            </table>
        </div>

      
    </div>

</body>

</html>


<?=$this->endSection()?>