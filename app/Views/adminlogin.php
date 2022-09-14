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
            <h2>Admin Login</h2>


            <div class="login">

                <?= $validation->listErrors() ?>

                <?php

                    if( isset($_SESSION['error'])) {
                        echo ' <div class="errors">';
                        echo '<p>'. $_SESSION['error'] .'</p>';
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
                    <input <?= set_value('password') ?> requireds type="password" name="password"
                        placeholder="password">
                </div>

                <div class="form-control submit mb">
                    <input type="submit" value="Login">
                </div>

                <div class="link">

                    <a href="#">forgot password?</a>
                </div>



                <?= form_open(); ?>
            </div>



        </div>
    </div>

</body>

</html>