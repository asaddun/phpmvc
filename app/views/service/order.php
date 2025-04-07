<div class="container">
    <form id="serviceForm" action="<?= BASEURL; ?>/service/confirm" method="POST">
        <div name="Personal Data">
            <div class="text-center">
                <h4>Data Diri</h4>
            </div>
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="mb-2">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="e.g Yuta Nakamura">
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="mb-2">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="e.g 1234567">
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="mb-2">
                        <label for="vehicle" class="form-label">Kendaraan</label>
                        <input type="text" class="form-control" id="vehicle" name="vehicle" placeholder="e.g ZR350">
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div name="Upgrades" class="mb-4">
            <div class="text-center">
                <h4>Peningkatan</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="engine">Mesin:</label>
                        <select name="services[]" id="engine" class="form-select">
                            <option value="0">No Changes</option>
                            <?php foreach ($data['engine'] as $service): ?>
                                <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="transmisi">Transmisi:</label>
                        <select name="services[]" id="transmisi" class="form-select">
                            <option value="0">No Changes</option>
                            <?php foreach ($data['transmission'] as $service): ?>
                                <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="suspension">Suspensi:</label>
                        <select name="services[]" id="suspension" class="form-select">
                            <option value="0">No Changes</option>
                            <?php foreach ($data['suspension'] as $service): ?>
                                <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="brake">Pengereman:</label>
                        <select name="services[]" id="brake" class="form-select">
                            <option value="0">No Changes</option>
                            <?php foreach ($data['brakes'] as $service): ?>
                                <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="turbo">Turbo:</label>
                        <select name="services[]" id="turbo" class="form-select">
                            <option value="0">No Changes</option>
                            <?php foreach ($data['turbo'] as $service): ?>
                                <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="trunk">Bagasi:</label>
                        <select id="trunk" class="form-select" onchange="handleSelectChange(this)">
                            <option value="0">No Changes</option>
                            <?php foreach ($data['trunk'] as $service): ?>
                                <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-12 col-md-4">
                    <div class="form-group" id="input-container" style="display: none;">
                        <label for="jumlah">Jumlah:</label>
                        <div class="input-group">
                            <input class="form-control" type="number" id="jumlah" min="1" value="1" onchange="generateInputs()" />
                            <span class="input-group-text" id="unit"></span>
                        </div>
                    </div>
                </div>
                <div id="inputs-container"></div>
            </div>
        </div>
        <hr>

        <div name="Modifications" class="mb-4">
            <div class="text-center">
                <h4>Modifikasi</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="bodyworks">Bodyworks:</label>
                        <input type="number" class="form-control" id="bodyworks" name="bodyworks" value="0"
                            min="0">
                        <div class="form-text">(Spoiler, Bumper, Side Skirt, Exhaust, Interior, etc..)</div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="tints">Kaca Film:</label>
                        <select name="services[]" id="tints" class="form-select">
                            <option value="0">No Changes</option>
                            <?php foreach ($data['tint'] as $service): ?>
                                <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Ban:</label><br>
                        <?php foreach ($data['tire'] as $service): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="services[]" value="<?= $service['id'] ?>"
                                    id="<?= $service['name'] ?>">
                                <label class="form-check-label" for="<?= $service['name'] ?>">
                                    <?= $service['name'] ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="horns">Klakson:</label>
                        <select name="services[]" id="horns" class="form-select">
                            <option value="0">No Changes</option>
                            <?php foreach ($data['horn'] as $service): ?>
                                <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div name="Color & Paint" class="mb-4">
            <div class="text-center">
                <h4>Warna & Cat</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="colors">Warna:</label>
                        <?php foreach ($data['color'] as $service): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="services[]" value="<?= $service['id'] ?>"
                                    id="<?= $service['name'] ?>">
                                <label class="form-check-label" for="<?= $service['name'] ?>">
                                    <?= $service['name'] ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="headlights">Lampu:</label>
                        <select name="services[]" id="headlights" class="form-select">
                            <option value="0">No Changes</option>
                            <?php foreach ($data['light'] as $service): ?>
                                <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="neon">Neon:</label>
                        <select name="services[]" id="neon" class="form-select">
                            <option value="0">No Changes</option>
                            <?php foreach ($data['neon'] as $service): ?>
                                <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div name="Miscellaneous" class="mb-4">
            <div class="text-center">
                <h4>Tambahan</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <?php foreach ($data['misc'] as $service): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="services[]" value="<?= $service['id'] ?>"
                                    id="<?= $service['name'] ?>">
                                <label class="form-check-label" for="<?= $service['name'] ?>">
                                    <?= $service['name'] ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mb-3">Booking</button>
        </div>
    </form>
</div>

<script>
    function handleSelectChange(select) {
        const value = select.value;
        const inputContainer = document.getElementById('input-container');
        const jumlahInput = document.getElementById('jumlah');
        const unit = document.getElementById('unit');

        if (value !== "0") {
            inputContainer.style.display = 'block';
            generateInputs();
            if (value === "21") {
                unit.textContent = "Kg";
            } else if (value === "22") {
                unit.textContent = "Slot";
            }
        } else {
            inputContainer.style.display = 'none';
            document.getElementById('inputs-container').innerHTML = '';
        }
    }

    function generateInputs() {
        const jumlah = parseInt(document.getElementById('jumlah').value);
        const selectedValue = document.getElementById('trunk').value;
        const container = document.getElementById('inputs-container');

        container.innerHTML = ''; // bersihkan dulu

        if (selectedValue !== "0" && jumlah > 0) {
            for (let i = 0; i < jumlah; i++) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'services[]';
                input.value = selectedValue;
                container.appendChild(input);
            }
        }
    }
</script>