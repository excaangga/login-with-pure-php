<?php
    session_start();
    date_default_timezone_set("Asia/Jakarta");

    $file = fopen("log.txt", "a");
    fwrite( $file, $_SESSION['username'] . " berhasil logout pada " . date('d-m-Y H:i:s') . "\n");

    unset($_SESSION['username']);
    unset($_SESSION['valid']);
    unset($_SESSION['date']);
    setcookie("nama_lengkap", "", time() - 86400, "/");

    echo "Anda telah membersihkan session dan cookie";
    header('Refresh: 2; URL = index.php');
?>