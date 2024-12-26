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
                <img src="{{ asset('images/bus.png') }}" alt="Bus and suitcase">
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
                <img src="{{ asset('images/bus.png') }}" alt="Bus and suitcase">
            </div>
        </section>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="service-card">
                <img src="{{ asset('images/ticket.png') }}" alt="Cek Tiket" class="img-fluid">
                <h3>Cek Tiket</h3>
                <p>Cek ketersediaan tiket dan pilih perjalanan yang sesuai dengan keinginan Anda.</p>
                <a href="{{ route('user.ticket') }}" class="btn-action">Cek Tiket</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card">
                <img src="{{ asset('images/outlet.png') }}" alt="Outlet" class="img-fluid">
                <h3>Outlet Kami</h3>
                <p>Kunjungi outlet kami untuk informasi lebih lanjut atau membeli tiket langsung.</p>
                <a href="{{ route('user.outlet') }}" class="btn-action">Lihat Outlet</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card">
                <img src="{{ asset('images/customer-service.png') }}" alt="Layanan Pelanggan" class="img-fluid">
                <h3>Layanan Pelanggan</h3>
                <p>Butuh bantuan? Tim layanan pelanggan kami siap membantu Anda.</p>
                <a href="{{ route('user.contact') }}" class="btn-action">Hubungi Kami</a>
            </div>
        </div>
    </div>
</div>
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
