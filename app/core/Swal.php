<?php

class Swal
{
    public static function setSwal($title, $message, $icon, $timer = null)
    {
        $_SESSION['swal'] = [
            'title' => $title,
            'message' => $message,
            'icon' => $icon,
        ];
        if ($timer) {
            $_SESSION['swal']['timer'] = $timer;
        }
    }

    public static function swal()
    {
        if (isset($_SESSION['swal'])) {
            echo
            '<script>
                Swal.fire({
                title: "' . $_SESSION['swal']['title'] . '",
                text: "' . $_SESSION['swal']['message'] . '",
                icon: "' . $_SESSION['swal']['icon'] . '",
                
                ';
            if (isset($_SESSION['swal']['timer'])) {
                echo 'timer: ' . $_SESSION['swal']['timer'] . ',';
            }

            echo
            '   });
            </script>';
            unset($_SESSION['swal']);
        }
    }
}
