<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apotek VioletCare | Solusi Kesehatan Modern</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #7b5ee6;
      --primary-light: #b39eff;
      --primary-dark: #4d2dab;
      --bg: #faf8ff;
      --card-bg: #ffffff;
      --text: #33334a;
      --text-light: #6d6d8a;
    }

    body {
      font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
      background-color: var(--bg);
      color: var(--text);
      line-height: 1.6;
    }

    /* Minimalist Header */
    header {
      background: white;
      box-shadow: 0 2px 15px rgba(123, 94, 230, 0.1);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .navbar-brand {
      font-weight: 700;
      color: var(--primary-dark);
      letter-spacing: -0.5px;
    }

    .navbar-brand span {
      color: var(--primary);
    }

    .nav-link {
      color: var(--text);
      font-weight: 500;
      margin: 0 8px;
      position: relative;
    }

    .nav-link:hover {
      color: var(--primary);
    }

    .nav-link.active {
      color: var(--primary);
    }

    .nav-link.active:after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 100%;
      height: 2px;
      background: var(--primary);
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, rgba(123, 94, 230, 0.08) 0%, rgba(255, 255, 255, 1) 100%);
      padding: 100px 0;
    }

    .hero-title {
      font-size: 2.8rem;
      font-weight: 700;
      line-height: 1.2;
      color: var(--primary-dark);
      margin-bottom: 20px;
    }

    .hero-subtitle {
      color: var(--text-light);
      font-size: 1.1rem;
      max-width: 600px;
      margin-bottom: 30px;
    }

    .btn-primary {
      background: var(--primary);
      border: none;
      padding: 12px 28px;
      border-radius: 8px;
      font-weight: 600;
      letter-spacing: 0.5px;
      transition: all 0.3s;
    }

    .btn-primary:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(123, 94, 230, 0.2);
    }

    .hero-img {
      max-width: 100%;
      height: auto;
      border-radius: 12px;
      box-shadow: 0 15px 30px rgba(123, 94, 230, 0.15);
    }

    /* Features */
    .features {
      padding: 80px 0;
    }

    .feature-card {
      background: var(--card-bg);
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
      transition: all 0.3s;
      height: 100%;
      border: 1px solid rgba(123, 94, 230, 0.1);
    }

    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(123, 94, 230, 0.1);
    }

    .feature-icon {
      width: 60px;
      height: 60px;
      background: rgba(123, 94, 230, 0.1);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      color: var(--primary);
    }

    .feature-title {
      font-weight: 600;
      margin-bottom: 15px;
      color: var(--primary-dark);
    }

    /* Footer */
    footer {
      background: var(--primary-dark);
      color: white;
      padding: 50px 0 20px;
    }

    .footer-logo {
      font-weight: 700;
      font-size: 1.5rem;
      margin-bottom: 20px;
      display: inline-block;
    }

    .footer-link {
      color: rgba(255, 255, 255, 0.8);
      display: block;
      margin-bottom: 10px;
      text-decoration: none;
      transition: all 0.3s;
    }

    .footer-link:hover {
      color: white;
      transform: translateX(5px);
    }

    .social-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-right: 10px;
      transition: all 0.3s;
    }

    .social-icon:hover {
      background: var(--primary);
      transform: translateY(-3px);
    }

    /* Utility Classes */
    .rounded-lg {
      border-radius: 12px;
    }
  </style>
</head>

<body>
  <!-- Minimalist Header -->
  <header class="py-3">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
          <i class="fas fa-prescription-bottle-alt me-2"></i>
          <span>Violet</span>Care
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Layanan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Tentang Kami</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Kontak</a>
            </li>
          </ul>
          <a href="../service/login.php" class="btn btn-primary ms-lg-4">Masuk/Daftar</a>
        </div>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h1 class="hero-title">Perawatan Kesehatan dengan Sentuhan Modern</h1>
          <p class="hero-subtitle">
            VioletCare menyediakan solusi kesehatan terkini dengan layanan apotek digital dan konsultasi profesional.
          </p>
          <div class="d-flex gap-3">
            <a href="#" class="btn btn-primary">Belanja Sekarang</a>
            <a href="#" class="btn btn-outline-primary">Konsultasi Online</a>
          </div>
        </div>
        <div class="col-lg-6 mt-5 mt-lg-0">
          <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
               alt="Pharmacy Products" class="hero-img">
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features">
    <div class="container">
      <div class="row text-center mb-5">
        <div class="col-12">
          <h2 class="fw-bold" style="color: var(--primary-dark);">Layanan Unggulan Kami</h2>
          <p class="text-muted">Solusi kesehatan lengkap untuk kebutuhan Anda</p>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-pills fa-lg"></i>
            </div>
            <h4 class="feature-title">Resep Digital</h4>
            <p>Upload resep dokter dan dapatkan obat tanpa antri dengan layanan resep digital kami.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-user-md fa-lg"></i>
            </div>
            <h4 class="feature-title">Konsultasi Apoteker</h4>
            <p>Konsultasi gratis dengan apoteker kami secara online atau offline.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-truck fa-lg"></i>
            </div>
            <h4 class="feature-title">Pengiriman Cepat</h4>
            <p>Pesanan dikirim dalam waktu 2 jam untuk area Jakarta dan sekitarnya.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-5 mb-lg-0">
          <div class="footer-logo">VioletCare</div>
          <p>Solusi kesehatan modern dengan pelayanan terbaik dari apoteker profesional.</p>
          <div class="mt-4">
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
          <h5 class="mb-4">Menu</h5>
          <a href="#" class="footer-link">Beranda</a>
          <a href="#" class="footer-link">Produk</a>
          <a href="#" class="footer-link">Layanan</a>
          <a href="#" class="footer-link">Promo</a>
        </div>
        <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
          <h5 class="mb-4">Bantuan</h5>
          <a href="#" class="footer-link">FAQ</a>
          <a href="#" class="footer-link">Cara Order</a>
          <a href="#" class="footer-link">Pengembalian</a>
          <a href="#" class="footer-link">Kebijakan Privasi</a>
        </div>
        <div class="col-lg-4 col-md-4">
          <h5 class="mb-4">Kontak Kami</h5>
          <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Kesehatan No. 123, Jakarta</p>
          <p><i class="fas fa-phone me-2"></i> (021) 1234-5678</p>
          <p><i class="fas fa-envelope me-2"></i> hello@violetcare.com</p>
        </div>
      </div>
      <hr class="mt-5" style="border-color: rgba(255,255,255,0.1);">
      <div class="text-center pt-3">
        <p class="small">© 2023 VioletCare. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>