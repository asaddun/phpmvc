<?php

class Swal
{
    public static function setSwal($title, $message, $icon)
    {
        $_SESSION['swal'] = [
            'title' => $title,
            'message' => $message,
            'icon' => $icon
        ];
    }

    public static function swal()
    {
        if (isset($_SESSION['swal'])) {
            echo
            '<script>
                Swal.fire({
                title: "' . $_SESSION['swal']['title'] . '",
                text: "' . $_SESSION['swal']['message'] . '",
                icon: "' . $_SESSION['swal']['icon'] . '"
                });
            </script>';
            unset($_SESSION['swal']);
        }
    }
}
