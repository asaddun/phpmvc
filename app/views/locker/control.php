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
    document.addEventListener('DOMContentLoaded', function() {
        let currentPage = 1;

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
                        const locationOptions = lockerLocations.map(loc => {
                            const selected = loc.lkr_location_id === item.lkr_location_id ? 'selected' : '';
                            return `<option value="${loc.lkr_location_id}" ${selected}>${loc.location}</option>`;
                        }).join('');

                        row.innerHTML = `
                        <td>${item.locker_name}</td>
                        <td>${status}</td>
                        <form>
                            <td>
                                <select name="isactive" class="form-select form-select-sm">
                                    <option value="Y" ${item.isactive === 'Y' ? 'selected' : ''}>Active</option>
                                    <option value="N" ${item.isactive === 'N' ? 'selected' : ''}>Not Active</option>
                                </select>
                            </td>
                            <td>
                                <select name="location" class="form-select form-select-sm">
                                    ${locationOptions}
                                </select>
                            </td>
                            <input type="hidden" name="id" value="${item.lkr_locker_id}">
                            <td><button type="submit" class="btn btn-success">Save</button></td>
                        </form>
                        `;
                        tbody.appendChild(row);

                    });
                })
                .catch(error => {
                    console.error('Gagal fetch data:', error);
                });
        }

        fetchLockers(currentPage);

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
    })
</script>