<style>
    .antrian-option {
        border: 2px solid transparent;
        border-radius: 15px;
        padding: 40px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .antrian-option:hover {
        border-color: #0d6efd;
        background-color: #e7f1ff;
    }

    .antrian-option.selected {
        border-color: #0d6efd;
        background-color: #d0e7ff;
    }
</style>
<div class="container flex-grow-1 d-flex flex-column">
    <form action="<?= BASEURL ?>/queue/add" method="POST" class="flex-grow-1 d-flex flex-column">
        <div class="row justify-content-center mb-4">
            <div class="col-md-4">
                <div class="antrian-option" onclick="selectAntrian('A')" id="option-A">
                    <div class="fs-2 fw-bold text-primary">Peserta</div>
                    <div class="fs-1 fw-bold text-primary">Asuransi A</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="antrian-option" onclick="selectAntrian('B')" id="option-B">
                    <div class="fs-2 fw-bold text-primary">Peserta</div>
                    <div class="fs-1 fw-bold text-primary">Asuransi B</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="antrian-option" onclick="selectAntrian('C')" id="option-C">
                    <div class="fs-2 fw-bold text-primary">Peserta</div>
                    <div class="fs-1 fw-bold text-primary">Mandiri</div>
                </div>
            </div>
        </div>
        <input type="hidden" name="choice" id="choice">

        <div class="text-center flex-grow-1 d-flex flex-column justify-content-end align-items-center">
            <button type="submit" class="btn btn-primary">Antri</button>
        </div>
    </form>
</div>

<script>
    function clearSelectedOptions() {
        document.querySelectorAll('.antrian-option').forEach(opt => {
            opt.classList.remove('selected');
        });
    }

    function selectAntrian(jenis) {
        clearSelectedOptions();
        document.getElementById('option-' + jenis).classList.add('selected');
        document.getElementById('choice').value = jenis;
    }

    document.addEventListener('click', function(event) {
        const clickInsideCol = event.target.closest('.col-md-4');
        const isSubmitButton = event.target.closest('button[type="submit"]');
        if (!clickInsideCol && !isSubmitButton) {
            clearSelectedOptions();
            document.getElementById('choice').value = '';
        }
    });
</script>