<?=$this->extend("head")?>



<?=$this->section("content")?>



        <div class="sattalist">
            <h2 class="pink-head">LIVE RESULT</h2>

            <?php

            $session = session();

            if( isset($_SESSION['success'])) {
                echo '<p>'. $_SESSION['success'] .'</p>';
            }

            ?>


            <div class="action">
                <a class="pink-btn" href="<?= base_url();?>/create">Create satta</a> &nbsp;
                <a class="pink-btn" href="<?= base_url();?>/adminsettings">Settings</a> &nbsp; &nbsp;
                <a class="red-btn" href="<?= base_url();?>/adminlogout"> &nbsp;Log out &nbsp;</a> 
            </div>

            <?php foreach($list as $row) {  ?>

            <div class="item admin">
                <a class="blue-btn" href="<?=base_url();?>/satta-jodi/<?= $row['id']?>" target="_blank">Jodi</a>
                <div class="info">

                    <h3><?=  $row['name'] ?></h3>
                    <p><?=substr($row['satta_number'], 0, 3)?>-<?=substr($row['satta_number'], 3, 2)?>-<?=substr($row['satta_number'], 5, 3)?>
                    </p>
                    <p><?= date('h:i A', strtotime($row['start_time'])) ?> &nbsp; &nbsp;
                        <?= date('h:i A', strtotime($row['end_time'])) ?></p>

                    <div class="controls">
                        <a class="red-btn" href="confirm-delete/<?= $row['id'] ?>">Delete</a>
                        <a class="green-btn" href="satta-edit/<?= $row['id'] ?>">Edit</a>
                    </div>
                </div>
                <a class="blue-btn" href="satta-panel/<?= $row['id'] ?>" target="_blank">Panel</a>
            </div>

            <?php } ?>




        </div>




</body>

</html>

<?=$this->endSection()?>