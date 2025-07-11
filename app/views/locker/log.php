<style>
    .custom-outline {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        /* bootstrap secondary color */
        color: #6c757d;
        background-color: transparent;
        border: 1px solid #6c757d;
        border-radius: 0.375rem;
        user-select: none;
    }
</style>

<div class="mb-4">
    <a href="/locker/book" class="btn btn-outline-secondary">Book</a>
    <a href="/locker/control" class="btn btn-outline-secondary">Control</a>
    <a href="/locker/access" class="btn btn-outline-secondary">Access</a>
</div>

<h4>Loker Terpakai</h4>

<div class="mb-2 d-none">
    <button id="refreshActiveBtn" class="btn btn-secondary"><i class="fa-solid fa-refresh"></i></button>
</div>

<table id="logActive-table" class="table">
    <thead>
        <tr>
            <th>Waktu Booking</th>
            <th>Nama</th>
            <th>Loker</th>
            <th>Durasi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<h4 class="mt-4">Riwayat Loker</h4>

<div class="d-flex flex-row gap-2 mb-2">
    <select name="select-locker" id="select-locker" class="form-select w-25">
        <option value="all">Semua Loker</option>
        <?php foreach ($data['lockers'] as $locker): ?>
            <option value="<?= $locker['lkr_locker_id'] ?>"><?= $locker['locker_name'] ?></option>
        <?php endforeach; ?>
    </select>
    <button class="btn btn-success ms-1" id="submit-locker">Sumbit</button>
    <button id="prevBtn" class="btn btn-secondary"><i class="fa-solid fa-chevron-left"></i></button>
    <span id="pageNumber" class="custom-outline"></span>
    <button id="nextBtn" class="btn btn-secondary"><i class="fa-solid fa-chevron-right"></i></button>
    <button id="refreshBtn" class="btn btn-secondary"><i class="fa-solid fa-refresh"></i></button>
</div>

<table id="log-table" class="table">
    <thead>
        <tr>
            <th>Waktu Booking</th>
            <th>Nama</th>
            <th>Loker</th>
            <th>Durasi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentPage = 1;
        let lockerId = 'all';
        let counterElements = []; // Simpan elemen counter untuk update tiap detik

        function fetchLogActive() {
            const tbody = document.querySelector('#logActive-table tbody');
            counterElements = [];
            fetch(`${BASEURL}/locker/active-log`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response error');
                    }
                    return response.json();
                })
                .then(data => {
                    tbody.innerHTML = '';
                    data.forEach(item => {
                        const row = document.createElement('tr');

                        // Buat elemen <td> terpisah agar bisa di-update kemudian
                        const counterTd = document.createElement("td");
                        counterTd.textContent = "-"; // Placeholder awal
                        counterElements.push({
                            element: counterTd,
                            booked_at: item.booked_at
                        });

                        row.innerHTML = `
                        <td>${item.booked_at}</td>
                        <td>${item.nama_karyawan}</td>
                        <td>${item.locker_name}</td>
                        `;
                        row.appendChild(counterTd);
                        tbody.appendChild(row);
                        updateCounters();

                    });
                })
                .catch(error => {
                    console.error('Gagal fetch data:', error);
                });

            console.log(counterElements);
        }

        function fetchLog(range, locker) {
            document.getElementById("pageNumber").textContent = range;
            const tbody = document.querySelector('#log-table tbody');
            tbody.innerHTML = '';
            fetch(`${BASEURL}/locker/range-log/${range}/${locker}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response error');
                    }
                    return response.json();
                })
                .then(data => {
                    data.forEach(item => {
                        const row = document.createElement('tr');
                        const start = item.start_time;
                        const end = item.end_time;
                        const duration = new Date(end) - new Date(start);
                        const durationInMinutes = Math.floor(duration / 60000);
                        const hours = Math.floor(durationInMinutes / 60);
                        const minutes = durationInMinutes % 60;
                        const formattedDuration = `${hours} jam ${minutes} menit`;
                        row.innerHTML = `
                        <td>${item.start_time}</td>
                        <td>${item.employee}</td>
                        <td>${item.locker_name}</td>
                        <td>${formattedDuration}</td>
                        `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Gagal fetch data:', error);
                });
        }

        function updateCounters() {
            const now = new Date();

            counterElements.forEach(({
                element,
                booked_at
            }) => {
                const bookedTime = new Date(booked_at);
                const diffMs = now - bookedTime;

                if (diffMs < 0) {
                    element.textContent = "Belum dimulai";
                    return;
                }

                const diffSec = Math.floor(diffMs / 1000);
                const hours = Math.floor(diffSec / 3600);
                const minutes = Math.floor((diffSec % 3600) / 60);
                const seconds = diffSec % 60;

                element.textContent = `${hours} jam ${minutes} menit`;
            });
        }

        // setInterval(updateCounters, 1000);

        // Lalu update setiap 1/2 menit
        setInterval(() => {
            fetchLogActive();
            // fetchLog(currentPage, lockerId);
        }, 30000);

        document.getElementById('submit-locker').addEventListener('click', function() {
            lockerId = document.getElementById('select-locker').value;
            currentPage = 1;
            if (lockerId) {
                fetchLog(currentPage, lockerId);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Mohon pilih loker.'
                });
            }
        })

        document.getElementById("prevBtn").addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                fetchLog(currentPage, lockerId);
            }
        });

        document.getElementById("nextBtn").addEventListener("click", () => {
            currentPage++;
            fetchLog(currentPage, lockerId);
        });

        document.getElementById("refreshBtn").addEventListener("click", () => {
            fetchLog(currentPage, lockerId);
        });

        document.getElementById("refreshActiveBtn").addEventListener("click", () => {
            fetchLogActive();
        });

        fetchLog(currentPage, lockerId);
        fetchLogActive();
    })
</script>