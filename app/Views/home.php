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

        <div class="sattalist">
            <h2>LIVE RESULT</h2>

            <?php



            ?>

  
          

            <div class="item">
                <a href="#">Jodi</a>
                <button type="button">Jodi</button>
                <div class="info">
                    <h3>Madhuri night</h3>
                    <p>143-44-567</p>
                    <p>11:15 pm &nbsp; &nbsp; 12:12 am</p>
                </div>
                <button type="button">Panel</button>
                <a href="#">Panel</a>

            </div>


            <?php foreach($list as $row) { ?>

                <div class="item">
                <a href="#">Jodi</a>
                <button type="button">Jodi</button>
                <div class="info">
                    <h3>Madhuri night <?=  $row['name'] ?></h3>
                    <p>143-44-567 <?=  $row['satta_number'] ?></p>
                    <p>11:15 pm &nbsp; &nbsp; 12:12 am</p>
                </div>
                <button type="button">Panel</button>
                <a href="#">Panel</a>

            </div>


            <?php    } ?>


         
        </div>
    </div>
    
</body>
</html>