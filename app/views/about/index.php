<?php
require_once '../app/views/components/header.php';
?>
<div class="text-center">
    <h1>About Websiteku</h1>
    <img src="<?= BASEURL ?>/img/UltramanTiga.png" alt="UltramanTiga" width="200px">
    <h3>Halo, saya <?php echo $data['nama'] ?></h3>
</div>
<?php
require_once '../app/views/components/footer.php';
?>