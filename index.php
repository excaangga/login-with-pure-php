<!DOCTYPE html>

<?php
// speedrun result, no commentary at all
session_start();
$cookie_id = "nama_lengkap";
setcookie($cookie_id, "Angga Exca Pradipta Syaifuddin", time() + 86400, "/");
?>

<html>

<head>
    <title>Praktikum 10</title>
</head>

<body>
    <?php
    $authInfo = array();

    class regisAuth
    {
        public $username;
        public $password;
        function __construct($username, $password)
        {
            $this->username = $username;
            $this->password = $password;
        }
        function getUsername()
        {
            return $this->username;
        }
        function getPassword()
        {
            return $this->password;
        }
    }
    $tempAcc = new regisAuth("fiki", "naki");
    array_push($authInfo, [
        $tempAcc->getUsername() => $tempAcc->getPassword()
    ]);

    if (isset($_POST['login']) && !empty($_POST['username'] && !empty($_POST['password']))) {
        $file = fopen("log.txt", "a");
        date_default_timezone_set("Asia/Jakarta");
        foreach ($authInfo as $key => $value) {
            foreach ($value as $info => $valInfo) {
                if ($_POST['username'] == $info && $_POST['password'] == $valInfo) {
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = time();
                    $_SESSION['username'] = $info;
                    $_SESSION['date'] = date('d-m-Y H:i:s');

                    echo "Cookie dengan id " . $cookie_id . " dipasang untuk 1 hari kedepan <br>";
                    echo "Isi cookie = " . $_COOKIE[$cookie_id] . "<br>";
                    echo "Berhasil login pada " . $_SESSION['date'] . "<br>";
                    echo "<a href=\"logout.php\" title=\"logout\">Bersihkan session dan cookie</a>";

                    fwrite( $file, $info . " berhasil login pada " . date('d-m-Y H:i:s') . "\n");
                } else {
                    echo "Username atau password Anda salah <br>";
                    fwrite( $file, $_POST['username'] . " gagal login pada " . date('d-m-Y H:i:s') . "\n");
                    header('Refresh: 2; URL = index.php');
                }
            }
        }
    } else {
    ?>
        <strong>Login Page</strong>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Masukkan username">
            <br>
            <input type="password" name="password" placeholder="Masukkan password">
            <br>
            <button type="submit" name="login">login</button>
        </form>
    <?php
    }
    ?>
</body>

</html>