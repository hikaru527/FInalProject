<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ar-Rahmah - Platform Donasi Terpercaya</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(to right, rgba(13, 144, 161, 0.527), rgba(13, 71, 161, 0.6)), 
                        url('assets/arrahmah-bg.jpg');
            background-size: cover;
            background-position: center;
            min-height: 500px;
        }
        .category-scroll {
            overflow-x: auto;
            white-space: nowrap;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .category-scroll::-webkit-scrollbar {
            display: none;
        }
        .progress {
            height: 8px;
        }
        .campaign-card {
            transition: all 0.3s ease;
        }
        .campaign-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .campaign-image {
            height: 200px;
            object-fit: cover;
        }
        .badge-verified {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 2;
        }
        .badge-category {
            position: absolute;
            bottom: 10px;
            left: 10px;
            z-index: 2;
        }
        .stats-card {
            background: linear-gradient(135deg, #ccd1e2 0%, #3569ecfd 100%);
        }
        .stats-icon {
            background-color: rgba(13, 71, 161, 0.1);
            padding: 15px;
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a href="index.php" class="navbar-brand fw-bold text-primary fs-4">Yayasan Ar-Rahmah</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex mx-auto position-relative">
                    <input class="form-control form-control-lg rounded-pill pe-5" style="width: 400px;" type="search" placeholder="Cari campaign atau penggalang dana...">
                    <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>
                </form>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="galang-dana.html" class="nav-link">Galang Dana</a>
                        </li>
                        <li class="nav-item">
                            <a href="donasi.html" class="nav-link">Donasi</a>
                        </li>
                        <li class="nav-item">
                            <a href="halaman akun/home.html" class="nav-link">Akun</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="pt-5 mt-5">
        <section class="hero-section d-flex align-items-center mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-white">
                        <h1 class="display-4 fw-bold mb-4">Wujudkan Kebaikan Bersama Ar-Rahmah</h1>
                        <p class="lead mb-4">Platform donasi terpercaya untuk membantu sesama. Mulai dari Rp 10.000, Anda bisa membuat perubahan berarti.</p>
                        <div class="d-flex gap-3">
                            <a href="javascript:void(0);" class="btn btn-light" id="mulaiDonasiBtn">Mulai Donasi</a>
                            <a href="galang-dana.html" class="btn btn-outline-light">Galang Dana</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <!-- Quick Stats -->
            <section class="mb-5">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card stats-card h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="stats-icon text-primary me-3">
                                    <i class="bi bi-heart-fill fs-4"></i>
                                </div>
                                <div>
                                    <h3 class="fw-bold text-primary mb-0">100.000+</h3>
                                    <p class="text-muted mb-0">Total Donasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="stats-icon text-primary me-3">
                                    <i class="bi bi-people-fill fs-4"></i>
                                </div>
                                <div>
                                    <h3 class="fw-bold text-primary mb-0">2+</h3>
                                    <p class="text-muted mb-0">Donatur Aktif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="stats-icon text-primary me-3">
                                    <i class="bi bi-graph-up fs-4"></i>
                                </div>
                                <div>
                                    <h3 class="fw-bold text-primary mb-0">10+</h3>
                                    <p class="text-muted mb-0">Campaign Sukses</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="stats-icon text-primary me-3">
                                    <i class="bi bi-cup-hot-fill fs-4"></i>
                                </div>
                                <div>
                                    <h3 class="fw-bold text-primary mb-0">5+</h3>
                                    <p class="text-muted mb-0">Penggalang Dana</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Categories -->
            <section class="mb-5">
                <div class="category-scroll pb-3">
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">Semua</button>
                        <button class="btn btn-outline-primary">Medis</button>
                        <button class="btn btn-outline-primary">Pendidikan</button>
                        <button class="btn btn-outline-primary">Bencana Alam</button>
                        <button class="btn btn-outline-primary">Kemanusiaan</button>
                        <button class="btn btn-outline-primary">Zakat</button>
                    </div>
                </div>
            </section>

            <!-- Urgent Campaigns -->
            <section class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger rounded-pill" style="width: 4px; height: 32px;"></div>
                            <span class="ms-2">Butuh Bantuan Segera</span>
                        </div>
                    </h2>
                    <a href="#" class="btn btn-link text-primary text-decoration-none">
                        Lihat Semua <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4 campaign-card">
                            <img src="assets/campaign1.jpg" class="card-img-top campaign-image" alt="Campaign 1">
                            <div class="card-body">
                                <h5 class="card-title">Bantuan untuk Keluarga Terdampak Banjir</h5>
                                <p class="card-text">Mari bersama-sama kita bantu saudara-saudara kita yang terdampak bencana alam. Sumbangkan sebagian rezeki Anda.</p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success" style="width: 60%" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted">Rp 5.000.000 dari Rp 8.000.000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p>&copy; 2024 Yayasan Ar-Rahmah. Semua hak cipta dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Script -->
    <script>
        // Function to check if the user is logged in
        function checkLogin() {
            const isLoggedIn = localStorage.getItem('isLoggedIn');
            
            if (isLoggedIn !== 'true') {
                alert('Anda harus login terlebih dahulu untuk melakukan donasi.');
                window.location.href = '../halaman akun/home.html'; // Redirect to login page if not logged in
            } else {
                window.location.href = '../halaman akun/home.html'; // Redirect to home page if logged in
            }
        }

        // Event listener for donation button
        document.addEventListener('DOMContentLoaded', function() {
            const donasiButton = document.querySelector('#mulaiDonasiBtn'); 
            donasiButton.addEventListener('click', function() {
                checkLogin();
            });
        });
    </script>
</body>
</html>
