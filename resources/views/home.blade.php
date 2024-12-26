<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LintasLoka Travel</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="LintasLoka Logo">
                <span>LINTASLOKA</span>
            </div>
            <nav>
                <ul>
                    <li><a href="#">OUTLET</a></li>
                    <li><a href="#">CARA BAYAR</a></li>
                    <li><a href="#">CEK TIKET</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <a href="{{ route('register') }}" class="auth-btn">Daftar</a>
                <a href="{{ route('login') }}" class="auth-btn1">Masuk</a>
            </div>
        </div>
    </header>
    <main>
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
                <img src="{{ asset('images/bus.jpg') }}" alt="Bus and suitcase">
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
                    <p>2. Meukung perjalanan yang ramah lingkungan melalui teknologi dan inisiatif hijau.</p>
                </div>
                <img src="{{ asset('images/bus.jpg') }}" alt="Bus and suitcase">
            </div>
        </section>
    </main>
    <script>
        function showContent(section) {
            document.getElementById('about').style.display = section === 'about' ? 'block' : 'none';
            document.getElementById('vision').style.display = section === 'vision' ? 'block' : 'none';

            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            document.querySelector(`.tab[onclick="showContent('${section}')"]`).classList.add('active');
        }
    </script>
</body>
</html>
