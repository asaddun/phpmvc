<div class="container">
    <div class="text-center">
        <div class="row justify-content-center my-4">
            <?php foreach ($data['counter'] as $index => $counter): ?>
                <?php if ($index % 2 === 0 && $index !== 0): ?>
        </div>
        <div class="row justify-content-center my-4">
        <?php endif; ?>
        <div class="col-md-4 bg-white mx-3 py-3 rounded-4 shadow">
            <div class="fs-4 text-black mb-3"><?= $counter['name'] ?></div>
            <div class="fs-1 fw-bold text-primary" id="antrian-<?= $counter['value'] ?>">-</div>
        </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    // const lastCallData = {};

    function updateQueueDisplay() {
        fetch(`${BASEURL}/queue/get-counter-data`)
            .then(res => res.json())
            .then(data => {
                data.forEach(item => {
                    const el = document.getElementById(`antrian-${item.counter}`);
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
                    document.querySelectorAll('[id^="antrian-"]').forEach(el => {
                        el.textContent = '-';
                    });
                }
            })
            .catch(err => console.error('Fetch error:', err));
    }

    setInterval(updateQueueDisplay, 2000);
    updateQueueDisplay();

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