<div class="d-flex flex-row gap-2 mb-2">
    <input type="text" class="form-control w-25" name="search-name" placeholder="Search Name..">
    <button class="btn btn-success ms-1" id="searchButton">Search</button>
</div>

<table id="access-table" class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Area</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    fetchAccess(1);

    async function fetchAccess(range) {
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
        fetch(`${BASEURL}/locker/access-data/${range}`)
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
                    const locationOptions = lockerLocations.map(loc => {
                        const selected = loc.lkr_location_id === item.lkr_location_id ? 'selected' : '';
                        return `<option value="${loc.lkr_location_id}" ${selected}>${loc.location}</option>`;
                    }).join('');

                    row.innerHTML = `
                        <td>${item.employee}</td>
                        <form>
                            <td>
                                <select name="location" class="form-select form-select-sm">
                                    ${locationOptions}
                                </select>
                            </td>
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
</script>