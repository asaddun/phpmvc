<?php
// Data Ruang Meeting
$rooms = [
    ["nama" => "Ruang Meeting 1", "nomor" => 1],
    ["nama" => "Ruang Meeting 2", "nomor" => 2],
    ["nama" => "Ruang Meeting 3", "nomor" => 3],
    ["nama" => "Ruang Meeting 4", "nomor" => 4],
    ["nama" => "Ruang Meeting 5", "nomor" => 5],
    ["nama" => "Ruang Meeting 6", "nomor" => 6],
];

// Generate jam dari 08:00 hingga 21:00 dengan rentang 30 menit
$timeslots = [];
for ($h = 8; $h < 21; $h++) {
    foreach (["00", "30"] as $m) {
        $timeslots[] = sprintf("%02d:%s", $h, $m);
    }
}

// Fungsi untuk mengecek apakah waktu ada dalam rentang booking
function isBooked($room, $time, $bookings, $date)
{
    $timeInMinutes = strtotime("$date $time");

    foreach ($bookings as $booking) {
        if ($booking["room"] == $room) {
            $startTime = strtotime($booking["start_time"]);
            $endTime = strtotime($booking["end_time"]);

            if ($timeInMinutes >= $startTime && $timeInMinutes < $endTime) {
                return true;
            }
        }
    }
    return false;
}

function getBookingData($room, $time, $bookings, $date)
{
    foreach ($bookings as $booking) {
        if ($booking["room"] == $room && strtotime("$date $time") >= strtotime($booking["start_time"]) && strtotime("$date $time") < strtotime($booking["end_time"])) {
            return $booking; // Ambil data pemesan
        }
    }
    return NULL; // Jika tidak ditemukan
}
?>

<div class="container">
    <style>
        .table-container {
            overflow-x: auto;
            max-width: 100%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            cursor: pointer;
        }

        th {
            background-color: #f4f4f4;
        }

        .sticky-col {
            border: 1px solid #ddd;
            position: sticky;
            left: 0;
            /* Keeps background color */
            background-color: #f4f4f4;
            /* Ensures it stays above other content */
            z-index: 1;
            min-width: 150px;
        }
    </style>
    <h2 class="text-center mb-4">Jadwal Ruang Meeting</h2>
    <div class="mb-3">
        <label for="datePicker">Pilih Tanggal:</label>
        <input type="date" id="datePicker" class="form-date" value="<?= $data['date'] ?>">
    </div>
    <div class="table-container">
        <table>
            <tr>
                <th class="sticky-col">Ruang Meeting</th>
                <?php foreach ($timeslots as $time) {
                    echo "<th>$time</th>";
                } ?>
            </tr>
            <?php foreach ($rooms as $room): ?>
                <tr>
                    <td class="sticky-col"><?= $room['nama'] ?></td>
                    <?php foreach ($timeslots as $slot): ?>
                        <td
                            <?php
                            $booked =  isBooked($room['nomor'], $slot, $data['books'], $data['date']);
                            $bookData = getBookingData($room['nomor'], $slot, $data['books'], $data['date']);
                            // var_dump($bookData);
                            $firstBox = $bookData ? ($slot == date("H:i", strtotime($bookData["start_time"]))) : false;
                            $firstTime = $bookData ? date("H:i", strtotime($bookData["start_time"])) : NULL;
                            ?>
                            <?php if ($booked): ?>
                            style="background-color: red;"
                            onclick="editFormModal(<?= $room['nomor'] ?>, '<?= $firstTime ?>', <?= htmlspecialchars(json_encode($bookData), ENT_QUOTES, 'UTF-8') ?>)"
                            <?php else: ?>
                            style="background-color: #f4f4f4;"
                            onclick="bookingFormModal(<?= $room['nomor'] ?>, '<?= $slot ?>')"
                            <?php endif; ?>>
                            <?php if ($firstBox): ?>
                                <div class="text-white text-bold">
                                    <?= $bookData['user'] ?>
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
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-3 col-md-6">
                    <label for="room">Pilih Ruangan:</label>
                    <select id="room" name="room" class="form-select">
                        <?php foreach ($rooms as $room): ?>
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
            <div class="text-center pb-5">
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
                        <input type="text" class="form-control" id="name_modal" name="name" required>
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