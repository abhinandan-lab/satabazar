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

$validation = \Config\Services::validation();
$session = \Config\Services::session();


?>

    <div class="container">
        <h1 class="logo">sata bazar</h1>

        <div class="sattalist">
            <?php

                if( isset($_SESSION['success'])) {
                    echo '<p>'. $_SESSION['success'] .'</p>';
                }
            
            ?>
            <h2>Edit List</h2>


            <div class="action">
            </div>
            <div class="item admin create">


                <div class="info">

                    <?= $validation->listErrors() ?>

                    <?= form_open('satta-edit'); ?>
                    <h3><input type="text" name="name" value="<?= $row['name'] ?>" placeholder="Enter name"></h3>

                    <input type="hidden" name="id" value=" <?= $row['id'] ?>">

                    <div class="number">
                        <div>
                            <input type="text" name="first_three_digit" maxlength="3" value="<?=substr($row['satta_number'], 0, 3)?>"
                                placeholder="***">
                            <p>-</p>
                            <input name="first_one_digit" class="ch1" type="text" maxlength="1"
                                value="<?=substr($row['satta_number'], 3, 1)?>" placeholder="*">
                        </div>
                        <div>
                            <input name="last_one_digit" class="ch1" type="text" maxlength="1"
                                value="<?=substr($row['satta_number'], 4, 1)?>" placeholder="*">
                            <p>-</p>
                            <input name="last_three_digit" type="text" maxlength="3"
                                value="<?=substr($row['satta_number'], 5, 3)?>" placeholder="***">
                        </div>
                    </div>

                    <div class="time">


                        <div class="start">
                            <label for="start_time">start time</label>
                            <input type="time" value="<?= $row['start_time'] ?>" name="start_time" id="start_time">
                        </div>

                        <div class="endt">
                            <label for="end_time">end time </label>
                            <input type="time" value="<?= $row['end_time'] ?>" name="end_time" id="end_time">
                        </div>
                    </div>
                    <div class="controls">

                        <a href="<?= base_url(); ?>/admin">Go Back</a>

                        <input type="submit" value="Save Update">

                    </div>
                    <?= form_close(); ?>
                </div>
            </div>


        </div>




</body>

</html>