<?=$this->extend("head")?>



<?php

$validation = \Config\Services::validation();
$session = \Config\Services::session();


?>


<?=$this->section("content")?>

<div class="settings">
            <h1 class="pink-head italic">Change Password</h1>

            <div class="info">

                <div class="inputs">

                <?= $validation->listErrors() ?>

                    <div class="form-control">
                       <?= form_open('') ?>
                            <div class="input-text">
                                <label for="">Enter new Email</label>
                                <input  type="email" name="newemail" placeholder="new email" > <br>
                                <label for="">Enter your Password</label>
                                <input required type="password" name="pass" placeholder="your password" >
                                <input type="hidden" name="email" value="<?= $email ?>">
                            </div>
                            <input type="submit" value="Save" class="pink-btn">    
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>



</body>

</html>

<?=$this->endSection()?>