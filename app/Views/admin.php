<?=$this->extend("head")?>



<?=$this->section("content")?>

    <div class="container">
        <h1 class="logo">sata bazar</h1>

        <div class="sattalist">
            <h2>LIVE RESULT</h2>

            <?php

            if( isset($_SESSION['success'])) {
                echo '<p>'. $_SESSION['success'] .'</p>';
            }

            ?>


            <div class="action">
                <a href="<?= base_url();?>/create">Create satta</a>
            </div>

            <?php foreach($list as $row) {  ?>

            <div class="item admin">
                <a href="jodi/ <?= $row['id'] ?>" targer="_blank">Jodi</a>
                <div class="info">

                    <h3><?=  $row['name'] ?></h3>
                    <p><?=substr($row['satta_number'], 0, 3)?>-<?=substr($row['satta_number'], 3, 2)?>-<?=substr($row['satta_number'], 5, 3)?>
                    </p>
                    <p><?= date('h:i A', strtotime($row['start_time'])) ?> &nbsp; &nbsp;
                        <?= date('h:i A', strtotime($row['end_time'])) ?></p>

                    <div class="controls">
                        <a href="satta-delete/<?= $row['id'] ?>">Delete</a>
                        <a href="satta-edit/<?= $row['id'] ?>">Edit</a>
                    </div>
                </div>
                <a href="satta-panel/<?= $row['id'] ?>" target="_blank">Panel</a>
            </div>

            <?php } ?>




        </div>




</body>

</html>

<?=$this->endSection()?>