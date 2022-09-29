<?=$this->extend("head")?>

<?=$this->section("content")?>



        <div class="sattalist">
            <h2 class="pink-head italic">Delete Confirmation</h2>


           <h3 class="confirm-heading">Are you sure, you forgot your password </h3>

           <div class="confirm-div">

           <a class="green-btn" href="<?= base_url() ?>/admin">No. Go Back </a>
           <a class="red-btn" href="<?= base_url() ?>/forgot-admin-password">Yes. Forgot </a>

           </div>

        </div>
    </div>

</body>

</html>

<?=$this->endSection()?>