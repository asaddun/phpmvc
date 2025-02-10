<div class="container">
    <button class="btn btn-info mb-2" onclick="copyTable()"><i class="fa-solid fa-copy"></i> Copy</button>
    <table id="dataTable" class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Mesin</th>
                <th scope="col">Version</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['mesin'] as $mesin): ?>
                <tr>
                    <td><?= $mesin['asset_id'] ?></td>
                    <td><?= $mesin['value'] ?></td>
                    <td><?= $mesin['version'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>