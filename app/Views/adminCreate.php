<?=$this->extend("head")?>

<?=$this->section("content")?>

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
            <h2 class="pink-head italic">Create New List</h2>


            <div class="action">
            </div>
            <div class="item admin create">


                <div class="info">

                    <?= $validation->listErrors() ?>


                    <?= form_open(); ?>
                    <h3><input type="text" name="name" value="<?= set_value('name') ?>" placeholder="Enter name"></h3>


                    <div class="number">
                        <div>
                            <input type="text" name="first_three_digit" maxlength="3" value="<?= set_value('first_three_digit') ?>" placeholder="***">
                            <p>-</p>
                            <input name="first_one_digit" class="ch1" type="text" maxlength="1" value="<?= set_value('first_one_digit') ?>" placeholder="*">
                        </div>
                        <div>
                            <input name="last_one_digit" class="ch1" type="text" maxlength="1" value="<?= set_value('last_one_digit') ?>" placeholder="*">
                            <p>-</p>
                            <input name="last_three_digit" type="text" maxlength="3" value="<?= set_value('last_three_digit') ?>" placeholder="***">
                        </div>
                    </div>

                    <div class="time">


                        <div class="start">
                            <label for="start_time">start time</label>
                            <input type="time" value="<?= set_value('start_time') ?>" name="start_time" id="start_time">
                        </div>

                        <div class="endt">
                            <label for="end_time">end time </label>
                            <input type="time" value="<?= set_value('end_time') ?>" name="end_time" id="end_time">
                        </div>
                    </div>
                    <div class="controls">

                        <a class="green-btn" href="<?= base_url(); ?>/admin">Go Back</a>

                        <input class="pink-btn" type="submit" value="Create">

                    </div>
                    <?= form_close(); ?>
                </div>
            </div>


        </div>




</body>

</html>

<?=$this->endSection()?>