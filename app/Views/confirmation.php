<?=$this->extend("head")?>

<?=$this->section("content")?>

    <div class="container">
        <h1 class="logo">sata bazar</h1>

        <div class="sattalist">
            <h2>Delete Confirmation</h2>


           <h3 class="confirm-heading">Are you sure want to delete <span><?= $row['name'] ?></span> </h3>

           <div class="confirm-div">

           <a href="<?= base_url() ?>/admin">No. Go Back </a>
           <a href="<?= base_url() ?>/satta-delete/<?= $row['id'] ?>">Yes. Delete </a>

           </div>

        </div>
    </div>

</body>

</html>

<?=$this->endSection()?>