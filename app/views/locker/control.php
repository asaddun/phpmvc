<h4>Control Locker</h4>

<div class="d-flex flex-row gap-2 mb-2">
    <button id="prevBtn" class="btn btn-secondary"><i class="fa-solid fa-chevron-left"></i></button>
    <button id="nextBtn" class="btn btn-secondary"><i class="fa-solid fa-chevron-right"></i></button>
</div>

<table id="locker-table" class="table">
    <thead>
        <tr>
            <th>Locker</th>
            <th>Status</th>
            <th>Set Active</th>
            <th>Location</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    let currentPage = 1;
    document.addEventListener('DOMContentLoaded', async function() {
        await fetchLockers(currentPage);
    });

    // Tambahkan event listener ke tiap tombol
    document.addEventListener('click', async function(e) {
        const button = e.target.closest('.save-button');
        if (!button) return;
        const row = button.closest('tr'); // Ambil baris tempat tombol diklik
        const lockerId = button.dataset.id; // Ambil ID dari data-id
        const isactive = row.querySelector('.isactive').value;
        const location = row.querySelector('.location').value;

        const data = {
            lkr_locker_id: lockerId,
            isactive,
            location,
        };

        try {
            // Kirim data ke server
            const response = await fetch(`${BASEURL}/locker/control-update`, {
                method: 'POST',
                body: JSON.stringify(data),
            });

            const result = await response.json();
            const status = result.status;

            if (status === 'success') {
                alert(result.message);
                fetchLockers(currentPage);
            } else {
                alert(result.message);
            }

        } catch (error) {
            console.error('Gagal koneksi ke server:', error);
            alert('Terjadi kesalahan jaringan');
        }
    });

    async function fetchLockers(range) {
        const tbody = document.querySelector('#locker-table tbody');
        tbody.innerHTML = '';
        let lockerLocations = [];

        await fetch(`${BASEURL}/locker/location`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response error');
                }
                return response.json();
            })
            .then(data => {
                lockerLocations = data;
            })
            .catch(error => {
                console.error('Gagal fetch data:', error);
            });

        fetch(`${BASEURL}/locker/range/${range}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response error');
                }
                return response.json();
            })
            .then(data => {
                data.forEach(item => {
                    const row = document.createElement('tr');
                    const status = item.isavailable === 'Y' ? 'Free' : 'Booked';
                    const locationName = lockerLocations.find(loc => loc.lkr_location_id === item.lkr_location_id)?.location || '-';;
                    const locationOptions = lockerLocations.map(loc => {
                        const selected = loc.lkr_location_id === item.lkr_location_id ? 'selected' : '';
                        return `<option value="${loc.lkr_location_id}" ${selected}>${loc.location}</option>`;
                    }).join('');

                    row.innerHTML = `
                        <td>${item.locker_name}</td>
                        <td>${status}</td>
                    `;

                    if (status === 'Booked') {
                        row.innerHTML += `
                            <td>Active</td>
                            <td>${locationName}</td>
                            <td>
                                <button class="btn btn-success save-button" data-id="${item.lkr_locker_id}" disabled>
                                    Save
                                </button>
                            </td>
                        `;
                    } else {
                        row.innerHTML += `
                            <td>
                                <select class="isactive form-select">
                                    <option value="Y" ${item.isactive === 'Y' ? 'selected' : ''}>Active</option>
                                    <option value="N" ${item.isactive === 'N' ? 'selected' : ''}>Not Active</option>
                                </select>
                            </td>
                            <td>
                                <select class="location form-select">
                                    ${locationOptions}
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-success save-button" data-id="${item.lkr_locker_id}">
                                    Save
                                </button>
                            </td>
                        `;
                    }
                    tbody.appendChild(row);

                });
            })
            .catch(error => {
                console.error('Gagal fetch data:', error);
            });
    }

    document.getElementById("prevBtn").addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            fetchLockers(currentPage);
        }
    });

    document.getElementById("nextBtn").addEventListener("click", () => {
        currentPage++;
        fetchLockers(currentPage);
    });





    // document.querySelectorAll('form').forEach(form => {
    //     form.addEventListener('submit', async function(e) {
    //         e.preventDefault(); // mencegah form reload halaman

    //         const formData = new FormData(form);

    //         try {
    //             const response = await fetch(`${BASEURL}/locker/control-update`, {
    //                 method: 'POST',
    //                 body: formData,
    //             });

    //             const result = await response.json();

    //             if (result.success) {
    //                 alert('Update berhasil!');
    //             } else {
    //                 alert('Gagal update: ' + result.message);
    //             }
    //         } catch (err) {
    //             console.error('Error saat update:', err);
    //             alert('Terjadi kesalahan saat update');
    //         }
    //     });
    // });
</script>