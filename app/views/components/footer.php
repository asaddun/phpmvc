<?php if (isset($_SESSION['username'])): ?>
    </main>
    </div>
<?php endif; ?>
<div>
    <?php Swal::swal(); ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="<?= BASEURL ?>/js/script.js"></script>

</body>

</html>