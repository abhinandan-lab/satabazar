<?=$this->extend("head")?>

<?=$this->section("content")?>

    <?php 

    // $date = '19:24'; 
    // echo date('h:i A', strtotime($date));

    ?>

    <div class="container">
        <h1 class="logo">sata bazar</h1>

        <div class="sattalist">
            <h2>LIVE RESULT</h2>

            <?php foreach($list as $row) { ?>

                <div class="item">
                <a href="satta-jodi/<?= $row['id'] ?>" target="_blank">Jodi</a>
          
                <div class="info">
                    <h3><?=  $row['name'] ?></h3>
                    <p><?=substr($row['satta_number'], 0, 3)?>-<?=substr($row['satta_number'], 3, 2)?>-<?=substr($row['satta_number'], 5, 3)?> </p>
                    <p><?= date('h:i A', strtotime($row['start_time'])) ?> &nbsp; &nbsp; <?= date('h:i A', strtotime($row['end_time'])) ?></p>
                </div>
             
                <a href="satta-panel/<?= $row['id'] ?>" target="_blank">Panel</a>

            </div>


            <?php    } ?>


         
        </div>
    </div>
    
</body>
</html>

<?=$this->endSection()?>