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
<div class="container">
    <form action="<?= BASEURL ?>/queue/add" method="POST">
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

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Antri</button>
        </div>
    </form>
</div>

<script>
    function selectAntrian(jenis) {
        let selected = jenis;
        document.getElementById('choice').value = jenis;

        document.getElementById('option-A').classList.remove('selected');
        document.getElementById('option-B').classList.remove('selected');
        document.getElementById('option-C').classList.remove('selected');
        document.getElementById('option-' + jenis).classList.add('selected');
    }
</script>