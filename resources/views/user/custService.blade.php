@extends('layouts.user')

@section('title', 'Layanan Pelanggan')

@section('content')
<div class="container py-4">
    <h1 class="mb-3 text-center text-primary">Layanan Pelanggan</h1> 

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h3 class="font-weight-bold">Kontak Kami</h3> 
            <p class="lead mb-3">Jika Anda memiliki pertanyaan, keluhan, atau membutuhkan bantuan lebih lanjut, silakan hubungi kami melalui salah satu saluran berikut:</p>

            <div class="mb-3">
                <h5 class="font-weight-bold">Email Support:</h5>
                <p><a href="mailto:info@lintaslokatravel.com" class="text-decoration-none text-primary">info@lintaslokatravel.com</a></p>
            </div>

            <div class="mb-3">
                <h5 class="font-weight-bold">Nomor Telepon:</h5>
                <p>+62 812-3456-7890 (Sasha)</p>
                <p><span class="font-italic">Senin - Jumat: 09:00 - 17:00 WIB</span></p>
            </div>

            <div class="mt-4">
                <h5 class="font-weight-bold">Jam Operasional</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-clock"></i> <strong>Senin - Jumat:</strong> 09:00 - 17:00 WIB</li>
                    <li><i class="bi bi-clock"></i> <strong>Sabtu:</strong> 09:00 - 12:00 WIB</li>
                    <li><i class="bi bi-clock"></i> <strong>Minggu:</strong> Tutup</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
