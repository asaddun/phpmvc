<div class="col-12 col-md-4 d-flex mb-2">
    <input type="text" class="form-control" id="search-name" placeholder="Search Name..">
    <button type="submit" class="btn btn-success ms-3" id="searchButton">Search</button>
</div>

<table id="access-table" class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Location</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    let range = 1;
    let searchName = '';
    document.addEventListener('DOMContentLoaded', function() {
        fetchAccess(range, searchName);
    });

    async function fetchAccess(range, keyword = null) {
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

        const tbody = document.querySelector('#access-table tbody');

        let url = `${BASEURL}/locker/access-data/${range}`;
        if (keyword) {
            url += `/${keyword}`;
        }
        fetch(url)
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
                    const locationOptions = [
                        `<option value="0" ${item.lkr_location_id === 0 ? 'selected' : ''}>---</option>`,
                        ...lockerLocations.map(loc => {
                            const selected = loc.lkr_location_id === item.lkr_location_id ? 'selected' : '';
                            return `<option value="${loc.lkr_location_id}" ${selected}>${loc.location}</option>`;
                        })
                    ].join('');

                    row.innerHTML = `
                        <td>${item.employee}</td>
                            <td>
                                <select class="location form-select">
                                    ${locationOptions}
                                </select>
                            </td>
                            <td><button class="btn btn-success save-button" data-id="${item.lkr_access_id}" data-employee="${item.c_employee_id}">Save</button></td>
                        `;
                    tbody.appendChild(row);

                });
            })
            .catch(error => {
                console.error('Gagal fetch data:', error);
            });

    }

    document.getElementById('searchButton').addEventListener('click', function() {
        const keyword = document.getElementById('search-name').value;
        searchName = keyword;
        fetchAccess(range, searchName);
    });

    // Tambahkan event listener ke tiap tombol
    document.addEventListener('click', async function(e) {
        const button = e.target.closest('.save-button');
        if (!button) return;
        const row = button.closest('tr'); // Ambil baris tempat tombol diklik
        const accessId = button.dataset.id; // Ambil ID dari data-id
        const employeeId = button.dataset.employee; // Ambil ID dari data-employee
        const location = row.querySelector('.location').value;

        const data = {
            lkr_access_id: accessId,
            c_employee_id: employeeId,
            location,
        };

        try {
            // Kirim data ke server
            const response = await fetch(`${BASEURL}/locker/access-update`, {
                method: 'POST',
                body: JSON.stringify(data),
            });

            const result = await response.json();
            const status = result.status;

            if (status === 'success') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Update successfully',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
                fetchAccess(range, searchName);
            } else {
                alert(result.message);
            }

        } catch (error) {
            console.error('Gagal koneksi ke server:', error);
            alert('Terjadi kesalahan jaringan');
        }
    });
</script>