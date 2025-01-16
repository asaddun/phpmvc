<?php
function ticket_status($num)
{
    switch ($num) {
        case 1:
            return "Draft"; // baru bikin, masih bisa edit/hapus, belum masuk antrian
        case 2:
            return "In Queue"; // dalam antrian, hanya bisa cancel
        case 3:
            return "On Process"; // sedang dikerjakan, tidak bisa diubah user
        case 4:
            return "On Hold"; // ditunda, hanya bisa cancel
        case 5:
            return "Closed"; // selesai
        case 6:
            return "Canceled"; // dibatalkan
        case 7:
            return "Deleted"; // user menghapus, batal membuat tiket
    }
}
