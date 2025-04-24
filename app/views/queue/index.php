<style>
    .queue-type {
        padding: 6px 12px;
        margin-bottom: 5px;
        width: 100%;
        text-align: center;
    }

    .queue-data {
        padding: 6px 12px;
        margin-bottom: 5px;
        text-align: center;
        border-radius: 6px;
    }
</style>

<div class="container flex-grow-1 d-flex flex-column">
    <div class="row text-center flex-grow-1">
        <div class="col-7 d-flex flex-column">
            <div class="fs-3 fw-semibold mb-2">Waiting List</div>
            <div class="flex-grow-1 bg-white shadow border-top border-bottom border-black">
                <div id="queue-list" class="d-flex flex-row" style="height: 100%;">
                </div>
            </div>
        </div>
        <div class="col-5 d-flex flex-column">
            <div class="flex-grow-1 d-flex flex-column justify-content-between">
                <?php foreach ($data['counter'] as $counter): ?>
                    <div class="bg-white rounded-4 shadow">
                        <div class=" fs-4 text-black"><?= $counter['name'] ?></div>
                        <div class="fs-1 fw-bold text-primary" id="queue-data-<?= $counter['value'] ?>">-</div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function updateWaitingDisplay() {
        fetch(`${BASEURL}/queue/get-waiting-queue`)
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('queue-list');
                container.innerHTML = ''; // Kosongkan dulu

                Object.entries(data).forEach(([type, codes], index) => {
                    const col = document.createElement('div');
                    col.className = 'col-4 d-flex flex-column align-items-center px-0 border-end border-black';

                    // Hanya type B dan C yang tidak punya border-start
                    if (type !== 'A') {
                        col.classList.remove('border-start');
                    } else {
                        col.classList.add('border-start');
                    }

                    // Tambahkan judul tipe
                    const title = document.createElement('div');
                    title.className = 'queue-type fs-3 fw-bold bg-body-secondary';
                    title.textContent = type;
                    col.appendChild(title);

                    // Tambahkan kode antrian atau tanda "-"
                    if (codes.length > 0) {
                        codes.forEach(code => {
                            const codeEl = document.createElement('div');
                            codeEl.className = 'queue-data fs-3 fw-bold';
                            codeEl.textContent = code;
                            col.appendChild(codeEl);
                        });
                    } else {
                        const emptyEl = document.createElement('div');
                        emptyEl.className = 'queue-data text-muted';
                        emptyEl.textContent = '';
                        col.appendChild(emptyEl);
                    }

                    container.appendChild(col);
                });
            })
            .catch(err => {
                console.error('Gagal mengambil data antrian:', err);
            });
    }

    function updateQueueDisplay() {
        fetch(`${BASEURL}/queue/get-counter-data`)
            .then(res => res.json())
            .then(data => {
                data.forEach(item => {
                    const el = document.getElementById(`queue-data-${item.counter}`);
                    if (el) {
                        el.textContent = item.code;

                        const key = item.counter;
                        const storedData = JSON.parse(sessionStorage.getItem('lastCallData') || '{}');
                        if (!storedData[key] || storedData[key] !== item.called_at) {
                            // Panggilan baru
                            playSound(item.code, key);
                            console.log(`calling ${item.code} counter ${key}`);

                            // Simpan kembali
                            storedData[key] = item.called_at;
                            sessionStorage.setItem('lastCallData', JSON.stringify(storedData));
                        }
                    }
                });
                if (data.length === 0) {
                    document.querySelectorAll('[id^="queue-data-"]').forEach(el => {
                        el.textContent = '-';
                    });
                }
            })
            .catch(err => console.error('Fetch error:', err));
    }

    // setInterval(updateQueueDisplay, 2000);
    setInterval(() => {
        updateQueueDisplay();
        updateWaitingDisplay(); // Fungsi lain jika ada
    }, 2000);

    updateQueueDisplay();
    updateWaitingDisplay();

    function playAudioSequence(files) {
        if (!files.length) return;
        const audio = new Audio(BASEURL + '/audio/' + files[0]);
        audio.play();
        audio.onended = function() {
            playAudioSequence(files.slice(1));
        };
    }

    function playSound(kode, counter) {
        const files = ['antrian.mp3'];
        const huruf = kode.charAt(0);
        const angka = kode.slice(1).split('');

        files.push(`${huruf}.mp3`);
        angka.forEach(num => files.push(`${num}.mp3`));
        files.push('menuju.mp3');
        files.push(`${counter}.mp3`);
        console.log(files);

        playAudioSequence(files);
    }
</script>