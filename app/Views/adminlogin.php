<?=$this->extend("head")?>

<?=$this->section("content")?>

    <?php

$validation = \Config\Services::validation();
$session = \Config\Services::session();


?>



        <div class="sattalist">
            <h2 class="pink-head italic">Admin Login</h2>


            <div class="login">

                <?= $validation->listErrors() ?>

                <?php

                    if( isset($_SESSION['error'])) {
                        echo ' <div class="errors">';
                        echo '<p>'. $_SESSION['error'] .'</p>';
                        echo ' </div>';
                    }

                    if( isset($_SESSION['success'])) {
                        echo ' <div class="">';
                        echo '<p>'. $_SESSION['success'] .'</p>';
                        echo ' </div>';
                    }

                    ?>

                <?= form_open(); ?>
                <div class="form-control mb">

                    <label for="email">Enter email</label> <br>
                    <input value="<?= set_value('email') ?>" required type="email" name="email"
                        placeholder="email address">
                </div>

                <div class="form-control mb">

                    <label for="password">Enter Password</label> <br>
                    <input <?= set_value('password') ?> required type="password" name="password"
                        placeholder="password">
                </div>

                <div class="form-control submit mb">
                    <input type="submit" value="Login">
                </div>

                <div class="link">

                    <a href="<?= base_url()?>/forgot-password-confirm">forgot password?</a>
                </div>



                <?= form_open(); ?>
            </div>



        </div>
    </div>

</body>

</html>

<?=$this->endSection()?>