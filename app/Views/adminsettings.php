<?=$this->extend("head")?>
<?=$this->section("content")?>



<div class="settings">
            <h1 class="pink-head italic">Admin Settings</h1>

            <div class="info">

            <?php

            $session = session();

            if( isset($_SESSION['success'])) {
                echo '<p>'. $_SESSION['success'] .'</p> <br>';
            }

            ?>

                <div class="inputs">

                    <p>Admin's primary email is <span>oldghantabazar@gmail.com</span>. If admins changes email than OTP will be sent to new email </p>

                    <a class="green-btn" href="<?= base_url();?>/admin-change-password">Change password</a> <br>
                    <a class="green-btn" href="<?= base_url();?>/admin-change-email">Change Email</a>
                    <div class="form-control">
                        <?= form_open(); ?>
                            <div class="checkbox">
                                <input type="checkbox" id="otpVerification" name="otpVerification" value="true" <?= $otp_enable ?> >
                                <label for="otpVerification"> Enable OTP verification on login</label>
                            </div>
                            <input type="submit" value="Save" class="pink-btn">    
                            <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>



</body>

</html>

<?=$this->endSection()?>