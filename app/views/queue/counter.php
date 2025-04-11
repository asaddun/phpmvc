<div class="container">
    <table class="table table-bordered table-sm" style="table-layout: fixed; width: 100%;">
        <thead>
            <tr>
                <th>Counter</th>
                <th>Serving</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="table-counter">
            <?php foreach ($data['counter'] as $counter): ?>
                <tr data-counter="<?= $counter['value'] ?>">
                    <td><?= $counter['name'] ?></td>
                    <td class="code">-</td>
                    <td class="status">
                        <span class="badge bg-success">Done</span>
                    </td>
                    <td>
                        <button id="callButton-<?= $counter['value'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#callModal" data-counter="<?= $counter['value'] ?>" data-counter-name="<?= $counter['name'] ?>"><i class="fa-solid fa-volume-high"></i> Call</button>
                        <button id="finishButton-<?= $counter['value'] ?>" class="btn btn-sm btn-success" onclick="doneQueue(<?= $counter['value'] ?>)" disabled><i class="fa-solid fa-circle-check"></i> Finish</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="callModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="callModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="callModalLabel"></h1>
            </div>
            <div class="modal-body">
                <div class="row text-center mb-3">
                    <span id="call-label" class="fw-bold mb-2">Calling</span>
                    <span class="fs-2 text-primary" id="queue-code">
                        ...
                    </span>
                    <div id="queue-id" class="d-none"></div>
                </div>
                <div class="row text-center mb-3">
                    <label for="type">Select Queue</label>
                    <div id="select-queue">
                        <p class="text-muted">Memuat...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-evenly">
                <button id="cancel-button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="fa-solid fa-x"></i> Cancel
                </button>
                <button id="call-again-button" class="btn btn-warning" disabled>
                    <i class="fa-solid fa-volume-high"></i> Call Again
                </button>
                <button id="process-button" class="btn btn-success" data-bs-dismiss="modal" disabled>
                    <i class="fa-solid fa-user-clock"></i> Process
                </button>
                <button id="next-button" class="btn btn-primary" disabled>
                    <i class="fa-solid fa-forward"></i> Call Next
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('callModal');
    const wrapper = document.getElementById('select-queue');
    const cancelButton = document.getElementById('cancel-button');
    const callAgainButton = document.getElementById('call-again-button');
    const nextButton = document.getElementById('next-button');
    const processButton = document.getElementById('process-button');
    let fetchIntervalId = null;
    let counterLogData = [];
    // const storedCounterLogData = sessionStorage.getItem('counterLogData');
    // if (storedCounterLogData) {
    //     counterLogData = JSON.parse(storedCounterLogData);
    // }

    function updateQueueView() {
        fetch('get-counter-data')
            .then(res => res.json())
            .then(data => {
                // Reset semua dulu
                document.querySelectorAll('#table-counter tr').forEach(row => {
                    row.querySelector('.code').textContent = '-';
                    row.querySelector('.status').innerHTML = '<span class="badge bg-secondary">Idle</span>';
                });

                // Isi dengan data dari DB
                data.forEach(item => {
                    const row = document.querySelector(`#table-counter tr[data-counter="${item.counter}"]`);
                    if (row) {
                        row.querySelector('.code').textContent = item.code;

                        let badge = '';
                        if (item.status == 2) {
                            badge = '<span class="badge bg-warning">Calling</span>';
                        } else if (item.status == 3) {
                            badge = '<span class="badge bg-primary">Process</span>';
                            document.getElementById(`callButton-${item.counter}`).disabled = true;
                            document.getElementById(`finishButton-${item.counter}`).disabled = false;
                        } else if (item.status == 4) {
                            badge = '<span class="badge bg-success">Done</span>';
                            document.getElementById(`finishButton-${item.counter}`).disabled = true;
                        }
                        row.querySelector('.status').innerHTML = badge;

                    }
                });

                counterLogData = data;
                sessionStorage.setItem('counterLogData', JSON.stringify(data));
            });
    }
    window.onload = updateQueueView;
    setInterval(updateQueueView, 5000);

    function fetchActive() {
        fetch(`get-queue`)
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    const select = document.createElement('select');
                    select.id = 'type';
                    select.className = 'form-select form-select-sm w-25 mx-auto';
                    data.forEach(item => {
                        const opt = document.createElement('option');
                        opt.value = item.type;
                        opt.textContent = item.type;
                        select.appendChild(opt);
                    });
                    wrapper.innerHTML = ''; // Kosongkan wrapper, lalu masukkan select
                    wrapper.appendChild(select);
                    nextButton.disabled = false;
                } else {
                    wrapper.innerHTML = '<p class="text-muted">Tidak ada antrian aktif.</p>';
                }
            })
            .catch(err => {
                console.error(err);
                wrapper.innerHTML = '<p class="text-danger">Gagal memuat data.</p>';
            });
    }

    modal.addEventListener('shown.bs.modal', function() {
        const button = event.relatedTarget; // Tombol yang membuka modal
        const counterValue = button.getAttribute('data-counter');
        const counterName = button.getAttribute('data-counter-name');
        processButton.setAttribute('onclick', `processQueue('${counterValue}')`);
        callAgainButton.setAttribute('onclick', `callAgain('${counterValue}')`);
        nextButton.setAttribute('onclick', `call('${counterValue}')`);
        document.getElementById('callModalLabel').innerHTML = counterName;

        // Ambil data antrian dari sessionStorage
        const storedData = JSON.parse(sessionStorage.getItem('counterLogData') || '[]');
        const data = storedData.find(item => item.counter == counterValue && item.status == 2); // Calling
        if (data) {
            // Masukkan ke modal
            document.getElementById('queue-id').innerHTML = data.id;
            document.getElementById('queue-code').innerHTML = data.code;
            cancelButton.disabled = true;
            callAgainButton.disabled = false;
            processButton.disabled = false;
            nextButton.disabled = false;
            console.log('Data loaded ke modal:', data);
        } else {
            // Bisa kosongin modal
            document.getElementById('queue-id').innerHTML = '';
            document.getElementById('queue-code').innerHTML = '...';
            console.log('Belum ada data antrian untuk counter ini');
        }

        fetchActive();
    });
    modal.addEventListener('hidden.bs.modal', function() {
        // clearInterval(fetchIntervalId); // hentikan fetch berkala
        fetchIntervalId = null;
        wrapper.innerHTML = '<p class="text-muted">Memuat...</p>';
        nextButton.disabled = true;
        document.getElementById('queue-code').innerHTML = '...';
        document.getElementById('call-label').innerHTML = 'Calling';
        cancelButton.disabled = false;
        processButton.disabled = true;
    });

    function call(counter) {
        const type = document.getElementById('type').value;
        document.getElementById('queue-id').innerHTML = '';
        cancelButton.disabled = true;

        fetch(`call/${type}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `counter=${counter}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('queue-code').innerHTML = data.code;
                    document.getElementById('queue-id').innerHTML = data.id;
                    processButton.disabled = false;
                    callAgainButton.disabled = false;
                } else {
                    document.getElementById('queue-code').innerHTML = data.code;
                }
            })
            .catch(err => {
                console.error(err);
                alert('Error calling queue');
            });

        fetchActive();
    }

    function callAgain(counter) {
        const id = document.getElementById('queue-id').innerHTML;
        callAgainButton.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"></div>';
        callAgainButton.disabled = true;
        if (id) {
            fetch(`call-again/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `counter=${counter}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        // document.getElementById('queue').innerText =
                        //     `Memanggil ${data.kode_antrian} di ${data.loket}`;
                        document.getElementById('call-label').innerHTML = 'Calling Again';
                    } else {
                        document.getElementById('queue-code').innerHTML = data.code;
                        alert('Error calling again');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Error calling again');
                });
        }
        setTimeout(() => {
            callAgainButton.innerHTML = '<i class="fa-solid fa-volume-high"></i> Call Again';
            callAgainButton.disabled = false;
        }, 3000);
    }

    function processQueue(counter) {
        const id = document.getElementById('queue-id').innerHTML;
        if (id) {
            fetch(`process/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `counter=${counter}`
            })
        }
        updateQueueView();
        document.getElementById('callButton-' + counter).disabled = true;
    }

    function doneQueue(counter) {
        const log = counterLogData.find(item => item.counter == counter && item.status == 3);
        if (log) {
            const id = log.id
            fetch(`done/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            })
        }
        updateQueueView();
        document.getElementById('callButton-' + counter).disabled = false;
    }
</script>