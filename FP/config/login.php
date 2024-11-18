<?php
include "service/database.php";
session_start();
$login_message = "";

// Periksa jika ada pesan logout
if (isset($_SESSION['logout_message'])) {
    $login_message = $_SESSION['logout_message'];
    unset($_SESSION['logout_message']); // Hapus pesan setelah ditampilkan
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = hash('sha256', $password);

    // Query login
    $stmt = $db->prepare("SELECT * FROM tbl_user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $hash_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["username"] = $data["username"];
        $_SESSION["role"] = $data["role"];
        $_SESSION["is_login"] = true;

        // Redirect berdasarkan role
        if ($data["role"] == 0) {
            // Redirect ke dashboard user
            header("Location: halaman akun/daftar akun.html");
        } elseif ($data["role"] == 1) {
            // Redirect ke dashboard admin
            header("Location: admin_dashboard.php");
        }
        exit();
    } else {
        $login_message = "Username atau password salah!";
    }
    $stmt->close();
    $db->close();
}
?>