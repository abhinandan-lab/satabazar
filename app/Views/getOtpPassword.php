<?=$this->extend("head")?>

<?=$this->section("content")?>


<div class="settings">
    <h1 class="pink-head italic">Change Password</h1>

    <div class="info">

        <?php

        $validation = \Config\Services::validation();
        $session = \Config\Services::session();

        if( isset($_SESSION['success'])) {
            echo '<p>'. $_SESSION['success'] .'</p>';
        }

        ?>

        <div class="inputs">

            <?= $validation->listErrors() ?>

            <p>OTP has been sent to your email account <span><?= $email ?></span>. Enter OTP to change
                password </p>

            <div class="form-control">
                <?= form_open(); ?>
                <div class="input-text">
                    <input type="text" name="otp" placeholder="Enter OTP here">
                    <input type="hidden" name="email" value="<?= $email ?>">
                </div>
                <input type="submit" value="Submit" class="pink-btn">
                <?= form_close(); ?>
            </div>
        </div>



    </div>
</div>



</body>

</html>

<?=$this->endSection()?>