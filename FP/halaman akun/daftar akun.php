<?php
include "../config/database.php";
session_start();
$register_message = "";

if (isset($_POST['register'])) {
    // Ambil dan sanitasi input
    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap'], ENT_QUOTES, 'UTF-8');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); // Validasi email
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    
    // Validasi input
    if (empty($nama_lengkap) || empty($email) || empty($password)) {
        $register_message = "Semua field harus diisi!";
    } elseif (strlen($password) < 8) {
        $register_message = "Password harus minimal 8 karakter!";
    } else {
        try {
            // Cek email duplikat
            $check_stmt = $db->prepare("SELECT email FROM users WHERE email = ?");
            if (!$check_stmt) {
                throw new Exception($db->error);
            }
            
            $check_stmt->bind_param("s", $email);
            $check_stmt->execute();
            $result = $check_stmt->get_result();
            
            if ($result->num_rows > 0) {
                $register_message = "Email sudah terdaftar!";
            } else {
                // Generate salt
                $salt = bin2hex(random_bytes(32));
                $password_hash = hash('sha512', $password . $salt);
                $created_at = date('Y-m-d H:i:s');
                $updated_at = $created_at;
                $is_active = 1; // Status aktif

                // Prepared statement untuk insert
                $insert_stmt = $db->prepare(
                    "INSERT INTO users (nama_lengkap, email, password_hash, password_salt, created_at, updated_at, is_active) 
                     VALUES (?, ?, ?, ?, ?, ?, ?)"
                );
                
                if (!$insert_stmt) {
                    throw new Exception($db->error);
                }

                $insert_stmt->bind_param(
                    "ssssssi",
                    $nama_lengkap,
                    $email,
                    $password_hash,
                    $salt,
                    $created_at,
                    $updated_at,
                    $is_active
                );

                if ($insert_stmt->execute()) {
                    $user_id = $insert_stmt->insert_id;
                    
                    // Simpan agreement jika checkbox terms dicentang
                    if (isset($_POST['terms'])) {
                        $agreement_stmt = $db->prepare(
                            "INSERT INTO user_agreements (user_id, agreement_type, agreed_at) 
                             VALUES (?, 'terms', ?)"
                        );
                        $agreement_stmt->bind_param("is", $user_id, $created_at);
                        $agreement_stmt->execute();
                        $agreement_stmt->close();
                    }

                    // Set session untuk auto login setelah register
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['nama_lengkap'] = $nama_lengkap;
                    $_SESSION['is_logged_in'] = true;
                    
                    // Redirect langsung ke beranda
                    header("Location: home.html");
                    exit();
                } else {
                    throw new Exception($insert_stmt->error);
                }
                $insert_stmt->close();
            }
            $check_stmt->close();
            
        } catch (Exception $e) {
            $register_message = "Terjadi kesalahan: " . $e->getMessage();
            error_log("Registration error: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style/css/register.css">
</head>
<body>
    <div class="container">
        <div class="auth-card">
            <h4 class="auth-title">Perjalanan Kebaikanmu Dimulai di Sini</h4>
            
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="form-group password-group">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <span class="password-toggle" onclick="togglePassword()">
                        <i class="far fa-eye"></i>
                    </span>
                    <div class="password-hint">
                        Minimal 8 karakter, gabungan huruf, angka, dan simbol.
                    </div>
                </div>

                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">Saya menyetujui <a href="#">Syarat & Ketentuan</a></label>
                </div>

                <button type="submit" name="register" class="btn btn-primary">Daftar</button>

                <div class="login-link">
                    Sudah punya akun? <a href="login.html">Masuk</a>
                </div>

                <?php if (!empty($register_message)): ?>
                    <div class="alert <?php echo strpos($register_message, 'berhasil') !== false ? 'alert-success' : 'alert-danger'; ?>">
                        <?php echo $register_message; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
<script src="../style/js/register.js"></script>
</html>
