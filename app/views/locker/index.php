<?php
require_once '../app/core/AuthCheck.php';
?>
<style>
    .locker {
        width: 100%;
        height: 100px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .range-buttons {
        overflow-x: auto;
        white-space: nowrap;
        padding-bottom: 10px;
    }

    .range-buttons button {
        margin-right: 10px;
    }

    input.no-spinner::-webkit-inner-spin-button,
    input.no-spinner::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<!-- Tombol Navigasi Range -->
<div class="range-buttons mb-3">
    <button class="btn btn-outline-primary range-btn active" data-range="1">1-20</button>
    <button class="btn btn-outline-primary range-btn" data-range="2">21-40</button>
    <button class="btn btn-outline-primary range-btn" data-range="3">41-60</button>
</div>

<!-- Grid Loker -->
<div id="locker-container"></div>

<!-- Modal Create Pin -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="bookingModalLabel">Booking Locker</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_modal" name="id">
                <input type="hidden" id="io_modal" name="io">
                <input type="hidden" id="ip_modal" name="ip">
                <div class="mb-3">
                    <label for="pin" class="form-label">Pin</label>
                    <input type="number" style="-webkit-text-security: disc;" class="form-control no-spinner" id="pin" name="pin" required>
                </div>
                <div class="mb-3">
                    <label for="pin_confirmation" class="form-label">Pin Konfirmasi</label>
                    <input type="number" style="-webkit-text-security: disc;" class="form-control no-spinner" id="pin_confirmation" name="pin_confirmation" required>
                </div>
            </div>
            <div class="modal-footer">
                <button id="submitButton" type="submit" class="btn btn-primary btn-submit">Booking</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Fungsi untuk mengambil data loker bedasarkan range
        function fetchLockers(range) {
            fetch(`${BASEURL}/locker/range/${range}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response error');
                    }
                    return response.json();
                })
                .then(data => {
                    // Buat Row dan Col untuk grid loker
                    let html = '<div class="row">';
                    data.forEach(locker => {
                        const bg = locker.isavailable === 'Y' ? 'bg-success cursor-pointer' : 'bg-danger';
                        html += `
                            <div class="col-3 p-2">
                                <div class="locker ${bg}" data-ip="${locker.ip_address}" data-io="${locker.io}" data-id="${locker.lkr_locker_id}">
                                    <div class="fs-2 fw-bold">${locker.locker_name}</div>
                                </div>
                            </div>
                        `;
                    });
                    html += '</div>';

                    // Masukkan semua ke locker-container
                    document.getElementById('locker-container').innerHTML = html;

                    // Listen semua locker
                    document.querySelectorAll('.locker.bg-success').forEach(locker => {
                        // Event listener untuk locker yang diklik
                        locker.addEventListener('click', () => {
                            // Ambil data dari data attribut locker
                            document.getElementById('id_modal').value = locker.getAttribute('data-id');
                            document.getElementById('ip_modal').value = locker.getAttribute('data-ip');
                            document.getElementById('io_modal').value = locker.getAttribute('data-io');
                            document.getElementById('pin').value = '';
                            document.getElementById('pin_confirmation').value = '';
                            // Tampilkan modal booking
                            const bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
                            bookingModal.show();
                        });
                    });
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal memuat locker.'
                    });
                });

        }

        // Panggil fungsi saat halaman dimuat pertama
        fetchLockers(1);

        // Listen semua tombol range
        document.querySelectorAll('.range-btn').forEach(button => {
            // Event listener untuk tombol range yang diklik
            button.addEventListener('click', () => {
                // Ambil nilai range dari attribut tombol range
                const range = button.getAttribute('data-range');

                // Hapus class 'active' dari semua tombol
                document.querySelectorAll('.range-btn').forEach(btn => {
                    btn.classList.remove('active');
                });

                // Tambahkan class 'active' ke tombol yang diklik
                button.classList.add('active');

                // Panggil fungsi ambil loker bedasarkan range
                fetchLockers(range);
            });
        });

        // Listen tombol submit di modal booking
        document.querySelector('.btn-submit').addEventListener('click', () => {
            // Ambil nilai dari form di modal
            const pin = document.getElementById('pin').value;
            const pin_confirmation = document.getElementById('pin_confirmation').value;
            const lockerIp = document.getElementById('ip_modal').value;
            const lockerIo = document.getElementById('io_modal').value;

            // Tutup modal
            const bookingModal = bootstrap.Modal.getInstance(document.getElementById('bookingModal'));
            bookingModal.hide();
            // console.log(pin, pin_confirmation, lockerIp, lockerIo);

            Swal.fire({
                title: 'Memproses...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // POST ke API
            fetch(`${BASEURL}/locker/booking`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        pin: pin,
                        pin_confirmation: pin_confirmation,
                        ip: lockerIp,
                        io: lockerIo
                    })
                })
                .then(res => res.json())
                .then(data => {
                    Swal.close();
                    if (data.status === 'success') {
                        Swal.fire('Berhasil', data.message, 'success');
                    } else {
                        Swal.fire('Gagal', data.message, 'error');
                    }
                })
                .catch(err => {
                    Swal.fire('Error', 'Terjadi kesalahan saat booking.', 'error');
                    console.error(err);
                });
        });
    });
</script>