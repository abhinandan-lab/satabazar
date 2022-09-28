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
                       <?= form_open('admin-getnew-password') ?>
                            <div class="input-text">
                                <label for="">Enter new Password</label>
                                <input required minlength="4" type="text" name="pass" placeholder="new password" value="">
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