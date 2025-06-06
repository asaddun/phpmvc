<div class="container">
    <style>
        .table-container {
            overflow-x: auto;
            max-width: 100%;
        }

        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            cursor: pointer;
            min-width: 100px;
        }

        .booked {
            background-color: red;
            border-left: none;
            border-right: none;
            position: relative;
        }

        .booked .booking-name {
            position: absolute;
            top: 50%;
            left: 8px;
            transform: translateY(-50%);
            white-space: nowrap;
            overflow: visible;
            z-index: 1;
            background: red;
            color: white;
            border-radius: 4px;
        }

        .booked .booking-name-short {
            /* Mencegah teks turun ke baris baru */
            white-space: nowrap;
            /* Menyembunyikan bagian teks yang kelebihan */
            overflow: hidden;
            /* Menampilkan "..." jika teks melebihi batas */
            text-overflow: ellipsis;
            /* Pastikan lebar teks tidak melebihi kotak */
            max-width: 80%;
            display: block;
        }

        th {
            background-color: #f4f4f4;
        }

        .sticky-col {
            position: sticky;
            left: 0;
            background-color: #f4f4f4;
            z-index: 2;
            min-width: 150px;
            cursor: default;
            border: 1px solid #ddd;
        }

        .sticky-col::after {
            content: "";
            position: absolute;
            bottom: -1px;
            /* Tutup celah antara row */
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #ddd;
            /* Warna border */
            z-index: 3;
        }
    </style>
    <h2 class="text-center pt-3 mb-4">Jadwal Ruang Meeting</h2>
    <div class="mb-3">
        <label for="datePicker" class="fw-bold">Pilih Tanggal:</label>
        <input type="date" id="datePicker" class="form-date" value="<?= $data['date'] ?>">
    </div>
    <div class="table-container">
        <table>
            <tr>
                <th class="sticky-col">Ruang Meeting</th>
                <?php foreach ($data['timeslots'] as $time) {
                    echo "<th>$time</th>";
                } ?>
            </tr>
            <?php foreach ($data['rooms'] as $room): ?>
                <tr>
                    <td class="sticky-col"><?= $room['nama'] ?></td>
                    <?php foreach ($data['timeslots'] as $slot): ?>
                        <td
                            <?php
                            $slotData = $data['bookedSlots'][$room['nomor']][$slot];
                            ?>
                            class="<?= $slotData['isBooked'] ? 'booked' : '' ?>"
                            style="background-color: <?= $slotData['isBooked'] ? 'red' : '#f4f4f4' ?>;"
                            onclick="<?= $slotData['isBooked'] ?
                                            "editFormModal({$room['nomor']}, '{$slotData['firstTime']}', " . htmlspecialchars(json_encode($slotData['bookingData']), ENT_QUOTES, 'UTF-8') . ")" :
                                            "bookingFormModal({$room['nomor']}, '{$slot}')" ?>">
                            <?php if ($slotData['firstBox']): ?>
                                <?php
                                $start = strtotime($slotData['bookingData']["start_time"]);
                                $end = strtotime($slotData['bookingData']["end_time"]);
                                $duration = ($end - $start) / 60; // Konversi ke menit
                                ?>
                                <div class="booking-name <?= ($duration == 30) ? 'booking-name-short' : '' ?> text-white fw-bold">
                                    <?= $slotData['bookingData']['user'] ?>
                                </div>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <h3 class="text-center mt-4">Booking Meeting</h3>
    <div class="mt-2">
        <form method="POST" action="<?= BASEURL; ?>/meeting/booking">
            <input type="hidden" id="date_modal" name="date" value="<?= $data['date'] ?>">
            <div class="row justify-content-center">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Atas Nama</label>
                    <input type="text" pattern="[A-Za-z ]+" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-3 col-md-6">
                    <label for="room">Pilih Ruangan:</label>
                    <select id="room" name="room" class="form-select">
                        <?php foreach ($data['rooms'] as $room): ?>
                            <option value="<?= $room['nomor'] ?>"><?= $room['nama'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-md-3">
                    <label for="start_time">Waktu Mulai:</label>
                    <select id="start_time" name="start_time" class="form-select">
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="end_time">Waktu Selesai:</label>
                    <select id="end_time" name="end_time" class="form-select">
                    </select>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Booking</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Create Book -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="formModalLabel">Booking Meeting</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formBooking" action="<?= BASEURL; ?>/meeting/booking" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="id_modal" name="id">
                    <input type="hidden" id="room_modal" name="room">
                    <input type="hidden" id="date_modal" name="date" value="<?= $data['date'] ?>">
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Waktu Mulai</label>
                        <div id="startTimeContainer" class="d-flex flex-row justify-content-center gap-3">
                            <button type="button" class="btn btn-outline-secondary" onclick="changeTime(-30)"><i class="fa-solid fa-minus"></i></button>
                            <input type="text" class="form-control" id="start_time_modal" name="start_time" readonly>
                            <button type="button" class="btn btn-outline-secondary" onclick="changeTime(30)"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name_modal" class="form-label">Atas Nama</label>
                        <input type="text" pattern="[A-Za-z ]+" class="form-control" id="name_modal" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="duration_modal" class="form-label">Durasi</label>
                        <div class="d-flex flex-row justify-content-center gap-3">
                            <button type="button" class="btn btn-outline-secondary" onclick="changeDuration(-30)"><i class="fa-solid fa-minus"></i></button>
                            <input type="text" id="duration_modal" name="duration" class="form-control text-center w-25" value="30" readonly>
                            <button type="button" class="btn btn-outline-secondary" onclick="changeDuration(30)"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="deleteButton" type="button" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button id="submitButton" type="submit" class="btn btn-primary">Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function bookingFormModal(room, startTime) {
        document.getElementById('formModalLabel').innerText = "Booking Meeting";
        document.getElementById('id_modal').value = null;
        document.getElementById('room_modal').value = room;
        document.getElementById('start_time_modal').value = startTime;
        document.getElementById('start_time_modal').classList.remove("w-25", "text-center");
        document.getElementById('name_modal').value = "";
        document.getElementById('name_modal').readOnly = false;
        document.getElementById('submitButton').innerText = "Booking";
        document.getElementById('deleteButton').classList.add("d-none");

        let container = document.getElementById("startTimeContainer");
        // Menyembunyikan semua tombol di dalam container
        let buttons = container.querySelectorAll("button");
        buttons.forEach(btn => btn.classList.add("d-none"));

        var bookingForm = document.getElementById('formBooking');
        bookingForm.action = "<?= BASEURL; ?>/meeting/booking";
        var bookingModal = new bootstrap.Modal(document.getElementById('formModal'));
        bookingModal.show();
    }

    function editFormModal(room, startTime, data) {
        document.getElementById('formModalLabel').innerText = "Edit Booking Meeting";
        document.getElementById('id_modal').value = data.id;
        document.getElementById('room_modal').value = room;
        document.getElementById('start_time_modal').value = startTime;
        document.getElementById('start_time_modal').classList.add("w-25", "text-center");
        document.getElementById('name_modal').value = data.user;
        document.getElementById('name_modal').readOnly = true;
        document.getElementById('submitButton').innerText = "Edit";
        document.getElementById('deleteButton').classList.remove("d-none");

        // Konversi string waktu menjadi objek Date
        let start_time = new Date(data.start_time);
        let end_time = new Date(data.end_time);
        // Hitung selisih dalam milidetik
        let differenceMs = end_time - start_time;
        // Konversi ke menit
        let differenceMinutes = differenceMs / (1000 * 60);
        document.getElementById('duration_modal').value = differenceMinutes;

        let container = document.getElementById("startTimeContainer");
        // Menyembunyikan semua tombol di dalam container
        let buttons = container.querySelectorAll("button");
        buttons.forEach(btn => btn.classList.remove("d-none"));

        let dateOnly = data.start_time.split(" ")[0];

        // Set tombol hapus dengan ID dari bookData
        let deleteButton = document.getElementById("deleteButton");
        deleteButton.setAttribute("onclick", `confirmDelete(${data.id}, '${dateOnly}')`);

        var bookingForm = document.getElementById('formBooking');
        bookingForm.action = "<?= BASEURL; ?>/meeting/edit";
        var bookingModal = new bootstrap.Modal(document.getElementById('formModal'));
        bookingModal.show();
    }

    function changeTime(minutes) {
        let input = document.getElementById("start_time_modal");
        let currentTime = input.value.split(":");

        let hours = parseInt(currentTime[0]);
        let mins = parseInt(currentTime[1]);

        // Tambahkan atau kurangi waktu
        let newTime = new Date();
        newTime.setHours(hours);
        newTime.setMinutes(mins + minutes);

        // Format ulang ke HH:MM
        let newHours = newTime.getHours().toString().padStart(2, "0");
        let newMinutes = newTime.getMinutes().toString().padStart(2, "0");

        input.value = `${newHours}:${newMinutes}`;
    }

    function changeDuration(amount) {
        let input = document.getElementById("duration_modal");
        let value = parseInt(input.value) + amount;

        // Batasi nilai antara 30 hingga 300 menit
        if (value < 30) value = 30;
        if (value > 300) value = 300;

        // Update nilai input
        input.value = value;
    }

    function generateTimeOptions() {
        let startTimeSelect = document.getElementById("start_time");
        let endTimeSelect = document.getElementById("end_time");

        for (let hour = 8; hour <= 21; hour++) { // Dari jam 08:00 - 21:00
            for (let min of ["00", "30"]) { // Kelipatan 30 menit
                if (hour === 21 && min === "30") {
                    continue;
                }
                let time = `${hour}:${min}`;
                let optionStart = new Option(time, time);
                let optionEnd = new Option(time, time);

                startTimeSelect.appendChild(optionStart);
                endTimeSelect.appendChild(optionEnd);
            }
        }
        endTimeSelect.value = "21:00";
    }
    generateTimeOptions();

    document.getElementById("start_time").addEventListener("change", validateTime);
    document.getElementById("end_time").addEventListener("change", validateTime);

    function validateTime() {
        let startTimeSelect = document.getElementById("start_time");
        let endTimeSelect = document.getElementById("end_time");

        let startTime = startTimeSelect.value;
        let endTime = endTimeSelect.value;

        // Ambil semua opsi yang tersedia dalam dropdown
        let options = [...startTimeSelect.options].map(opt => opt.value);

        // Dapatkan index dari start dan end
        let startIndex = options.indexOf(startTime);
        let endIndex = options.indexOf(endTime);

        // Cegah validasi jika end_time masih kosong
        if (endTime === "") return;

        if (startIndex >= 0 && endIndex >= 0 && endIndex <= startIndex) {
            Swal.fire({
                title: "Error!",
                text: "Waktu Selesai harus lebih besar dari Waktu Mulai!",
                icon: "error"
            });
            endTimeSelect.value = ""; // Reset pilihan end time
        }
    }

    document.getElementById("datePicker").addEventListener("change", fetchByDate);

    function fetchByDate() {
        window.location.href = `<?= BASEURL; ?>/meeting/${datePicker.value}`;
    }

    function confirmDelete(id, date) {
        Swal.fire({
            title: "Hapus Booking?",
            text: "Apakah Anda yakin ingin menghapus booking ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = BASEURL + "/meeting/delete/" + id + "/" + date;
            }
        });
    }
</script>