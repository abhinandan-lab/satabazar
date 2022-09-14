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
                <a href="#">Jodi</a>
          
                <div class="info">
                    <h3><?=  $row['name'] ?></h3>
                    <p><?=substr($row['satta_number'], 0, 3)?>-<?=substr($row['satta_number'], 3, 2)?>-<?=substr($row['satta_number'], 5, 3)?> </p>
                    <p><?= date('h:i A', strtotime($row['start_time'])) ?> &nbsp; &nbsp; <?= date('h:i A', strtotime($row['end_time'])) ?></p>
                </div>
             
                <a href="#">Panel</a>

            </div>


            <?php    } ?>


         
        </div>
    </div>
    
</body>
</html>