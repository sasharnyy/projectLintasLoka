@extends('layouts.user') 

@section('content') 

<div class="tabs">
    <button class="tab active" onclick="showContent('about')">TENTANG</button>
    <button class="tab" onclick="showContent('vision')">VISI & MISI</button>
</div>

<section class="content" id="about">
    <div class="image-content">
        <div class="text-overlay">
            <h1>TENTANG LINTASLOKA TRAVEL</h1>
            <p>
                LintasLoka hadir untuk menjadi mitra perjalanan terbaik bagi Anda, menghubungkan setiap destinasi dengan layanan yang nyaman, aman, dan terpercaya.
            </p>
            <p>
                Kami percaya bahwa perjalanan bukan hanya tentang mencapai tempat baru, tetapi juga tentang pengalaman dan kenangan yang diciptakan sepanjang jalan.
            </p>
        </div>
        <img src="{{ asset('images/bus.png') }}" alt="Bus and suitcase" class="image-responsive">
    </div>
</section>

<section class="content" id="vision" style="display: none;">
    <div class="image-content">
        <div class="text-overlay">
            <h1>VISI DAN MISI LINTASLOKA TRAVEL</h1>
            <p><strong>Visi Kami</strong></p>
            <p>Mewujudkan perjalanan yang lebih terhubung, nyaman, dan berkelanjutan untuk setiap pelanggan.</p>
            <p><strong>Misi Kami</strong></p>
            <p>1. Menghadirkan layanan travel yang fleksibel, aman, dan terjangkau.</p>
            <p>2. Mendukung perjalanan yang ramah lingkungan melalui teknologi dan inisiatif hijau.</p>
        </div>
        <img src="{{ asset('images/bus.png') }}" alt="Bus and suitcase" class="image-responsive">
    </div>
</section>


<div class="container mt-5">
    <div class="service-card-container">
        <div class="service-card styled-card">
            <div class="icon-container">
                <i class="bi bi-ticket-perforated" style="font-size: 2rem; color: #007bff;"></i>
            </div>
            <h3 class="card-title">Cek Tiket</h3>
            <p class="card-desc">Cek ketersediaan tiket dan pilih perjalanan yang sesuai dengan keinginan Anda.</p>
            <button class="btn-action" onclick="window.location='{{ route('user.ticket') }}'">Cek Tiket</button>
        </div>

        <div class="service-card styled-card">
            <div class="icon-container">
                <i class="bi bi-shop" style="font-size: 2rem; color: #007bff;"></i>
            </div>
            <h3 class="card-title">Outlet Kami</h3>
            <p class="card-desc">Kunjungi outlet kami untuk informasi lebih lanjut atau membeli tiket langsung.</p>
            <button class="btn-action" onclick="window.location='{{ route('user.outlet') }}'">Lihat Outlet</button>
        </div>

        <div class="service-card styled-card">
            <div class="icon-container">
                <i class="bi bi-headset" style="font-size: 2rem; color: #007bff;"></i>
            </div>
            <h3 class="card-title">Layanan Pelanggan</h3>
            <p class="card-desc">Butuh bantuan? Tim layanan pelanggan kami siap membantu Anda.</p>
            <button class="btn-action" onclick="window.location='{{ route('user.cs') }}'">Hubungi Kami</button>
        </div>
    </div>
</div>



<!-- Footer Section -->
<footer class="footer bg-secondary text-white py-3">
    <div class="container">
        <div class="row text-center text-md-left align-items-center">
            <!-- Logo dan Tagline -->
            <div class="col-md-12 mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="LintasLoka Travel Logo" class="footer-logo img-fluid mb-2" style="max-width: 100px;">
                <p class="small fw-bold text-uppercase">Mitra perjalanan Anda yang terpercaya</p>
            </div>
        </div>
        <div class="row text-center">
            <!-- Tentang Kami -->
            <div class="col-md-4 mb-2">
                <h5 class="footer-title">Tentang Kami</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="#" class="text-white">Profil Perusahaan</a></li>
                    <li><a href="#" class="text-white">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="text-white">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <!-- Kontak Kami -->
            <div class="col-md-4 mb-2">
                <h5 class="footer-title">Kontak Kami</h5>
                <p>Email: <a href="mailto:info@lintasloka.com" class="text-white">info@lintasloka.com</a></p>
                <p>Telp: +62 812-3456-7890</p>
            </div>
            <!-- Ikuti Kami -->
            <div class="col-md-4 mb-2">
                <h5 class="footer-title">Ikuti Kami</h5>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <p class="small">&copy; 2024 LintasLoka Travel. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>
@endsection 

@section('styles')
<style>
    .image-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap; 
    }

    .text-overlay {
        flex: 1;
        max-width: 50%; 
        padding: 20px;
    }

    .text-overlay h1 {
        font-size: 32px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .text-overlay p {
        font-size: 18px;
        line-height: 1.6;
        color: #555;
    }

    .image-about {
        width: 100%;
        max-width: 500px;
        height: auto;
        border-radius: 10px;
    }

    .section-divider {
        width: 100%;
        height: 2px;
        background-color: #007bff;
        margin: 40px 0;
    }

    @media (max-width: 768px) {
        .image-content {
            flex-direction: column; 
            align-items: center;
        }
        .text-overlay {
            max-width: 100%;
            text-align: center;
        }
        .image-about {
            max-width: 80%;
        }
    }

    .footer {
        background-color: #6c757d;
        padding: 15px 0;
        color: #fff;
    }

    .footer-logo {
        max-width: 100px;
    }

    .footer-title {
        font-weight: bold;
        margin-bottom: 30px;
        text-transform: uppercase;
    }

    .footer-links a {
        text-decoration: none;
        color: #ccc;
        font-size: 0.9rem;
        transition: color 0.3s;
    }

    .footer-links a:hover {
        color: #fff;
    }

    .d-flex a {
        font-size: 1.5rem;
        transition: color 0.3s;
    }

    .d-flex a:hover {
        color: #007bff;
    }

    .text-center p {
        font-size: 0.85rem;
    }

    .service-card-container {
    display: flex;
    flex-direction: column; 
    justify-content: center;
    align-items: center;
    width: 150%;
    max-width: 1200px; 
    margin: 0 auto; 
}

.styled-card {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 100%; 
    max-width: 350px; 
    margin-bottom: 20px;
}

.icon-container {
    margin-bottom: 15px;
}

.card-title {
    font-size: 20px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.card-desc {
    font-size: 16px;
    color: #666;
    margin-bottom: 20px;
}

.btn-action {
    display: inline-block;
    color: white;
    background-color: #007bff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-action:hover {
    background-color: #0056b3;
}
</style>
@endsection 

@section('scripts')
<script>
    function showContent(section) {
        document.getElementById('about').style.display = section === 'about' ? 'block' : 'none';
        document.getElementById('vision').style.display = section === 'vision' ? 'block' : 'none';

        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => tab.classList.remove('active'));
        document.querySelector(`.tab[onclick="showContent('${section}')"]`).classList.add('active');
    }
</script>
@endsection
