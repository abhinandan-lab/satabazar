<?=$this->extend("head")?>

<?=$this->section("content")?>

<div class="container">
        <h1 class="logo">sata bazar</h1>


        <button type="button"> Goto Bottom</button>

        <div class="panel">
            <h1>Madhuri Jodi chart</h1>
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