@extends('layouts.base')

@section('title', 'IDLe 2026 — Kompetisi ' . $kategori->nama_kategori)

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/idle-design-system.css') }}">
<style>
    /* =========================================================
       Scoped Styling for CTF Page — IDLE 2026 Retro Arcade Theme
       ========================================================= */
    body {
        background-color: var(--color-bg-base, #F8F5FF);
        font-family: var(--font-body, 'Inter', sans-serif);
        color: var(--color-text-primary, #0F0A1E);
    }

    .ctf-page-wrapper {
        background-color: var(--color-bg-base, #F8F5FF);
        min-height: 100vh;
    }

    /* Hero Section */
    .ctf-hero {
        padding: 130px 0 60px;
        background: var(--gradient-hero-overlay, linear-gradient(180deg, #F8F5FF 0%, #EDE8FF 60%, #F8F5FF 100%));
        position: relative;
        overflow: hidden;
    }

    .ctf-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(0, 200, 221, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 200, 221, 0.05) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
    }

    .ctf-title {
        font-family: var(--font-display, 'Space Grotesk', sans-serif);
        font-weight: 700;
        font-size: clamp(2rem, 3.8vw, 3rem);
        line-height: 1.18;
        color: var(--color-text-primary, #0F0A1E);
        margin-bottom: 16px;
    }

    .ctf-subtitle {
        font-family: var(--font-body, 'Inter', sans-serif);
        font-size: 1.05rem;
        color: var(--color-text-secondary, #4A3F6B);
        max-width: 650px;
        line-height: 1.65;
        margin-bottom: 24px;
    }

    .ctf-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
    }

    /* Poster Frame */
    .ctf-poster-box {
        position: relative;
        border-radius: var(--radius-md, 12px);
        overflow: hidden;
        border: 2px solid var(--color-border, #DDD5F0);
        box-shadow: var(--shadow-sm, 0 2px 8px rgba(15, 10, 30, 0.08));
        background: #FFFFFF;
        transition: transform 0.25s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.25s cubic-bezier(0.2, 0.8, 0.2, 1), border-color 0.25s ease;
        will-change: transform;
        transform: translateZ(0);
    }

    .ctf-poster-box:hover {
        transform: translate3d(0, -3px, 0);
        box-shadow: 0 8px 20px rgba(15, 10, 30, 0.1), 0 2px 8px rgba(0, 200, 221, 0.15);
        border-color: var(--color-cyan-500, #00C8DD);
    }

    .ctf-poster-img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    /* About Card */
    .card-kompetisi {
        background: #FFFFFF !important;
        transition: transform 0.25s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.25s cubic-bezier(0.2, 0.8, 0.2, 1), border-color 0.25s ease !important;
        will-change: transform;
        transform: translateZ(0);
    }

    .card-kompetisi:hover {
        transform: translate3d(0, -3px, 0);
        background: #FFFFFF !important;
        border-color: var(--color-cyan-500, #00C8DD) !important;
        box-shadow: 0 8px 20px rgba(15, 10, 30, 0.08), 0 2px 8px rgba(0, 200, 221, 0.1) !important;
    }

    /* Form Container & Member Cards */
    .ctf-form-container {
        width: 100%;
        background: #FFFFFF;
        border: 2px solid var(--color-border, #DDD5F0);
        border-radius: var(--radius-md, 12px);
        box-shadow: var(--shadow-sm, 0 2px 8px rgba(15, 10, 30, 0.08));
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .ctf-form-container:hover {
        border-color: #D2C6EC;
        box-shadow: 0 4px 16px rgba(15, 10, 30, 0.08);
    }

    .ctf-member-card {
        background: #FAF9FF;
        border: 1px solid #ECE7FA;
        border-radius: var(--radius-md, 12px);
        padding: 20px 22px;
        margin-bottom: 20px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    }

    .ctf-member-card:hover,
    .ctf-member-card:focus-within {
        background: #FFFFFF;
        border-color: rgba(0, 200, 221, 0.45);
        box-shadow: 0 3px 12px rgba(15, 10, 30, 0.05);
    }

    .ctf-member-card-secondary {
        border-style: dashed;
        background: #FCFBFF;
    }

    .ctf-member-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #EBE5F7;
    }

    .ctf-member-title {
        font-family: var(--font-display, 'Space Grotesk', sans-serif);
        font-size: 0.98rem;
        font-weight: 700;
        color: var(--color-text-primary, #0F0A1E);
        margin: 0;
    }

    .ctf-member-subtitle {
        display: block;
        font-size: 0.78rem;
        color: var(--color-text-muted, #8A7DA8);
        font-weight: 400;
        margin-top: 2px;
    }

    .ctf-add-member-trigger {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 20px;
        border: 1.5px dashed var(--color-border, #DDD5F0);
        border-radius: var(--radius-md, 12px);
        background: #FAF9FF;
        cursor: pointer;
        margin-bottom: 22px;
        transition: border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    }

    .ctf-add-member-trigger:hover {
        border-color: var(--color-cyan-500, #00C8DD);
        background: #FFFFFF;
        box-shadow: 0 3px 12px rgba(0, 200, 221, 0.12);
        transform: translateY(-1px);
    }

    .ctf-add-member-icon {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(0, 200, 221, 0.12);
        color: var(--color-cyan-600, #00A8BB);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .ctf-add-member-trigger:hover .ctf-add-member-icon {
        background: var(--color-cyan-500, #00C8DD);
        color: #0A0714;
    }

    .ctf-add-member-info {
        flex: 1;
        text-align: left;
    }

    .ctf-add-member-title {
        font-family: var(--font-display, 'Space Grotesk', sans-serif);
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--color-text-primary, #0F0A1E);
    }

    .ctf-add-member-sub {
        font-size: 0.8rem;
        color: var(--color-text-muted, #8A7DA8);
        margin-top: 2px;
    }

    .ctf-btn-slot-action {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--color-cyan-600, #00A8BB);
        padding: 6px 14px;
        border-radius: var(--radius-pill, 9999px);
        background: rgba(0, 200, 221, 0.1);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .ctf-add-member-trigger:hover .ctf-btn-slot-action {
        background: var(--color-cyan-500, #00C8DD);
        color: #0A0714;
    }

    .ctf-btn-remove-slot {
        background: transparent;
        border: none;
        color: var(--color-text-muted, #8A7DA8);
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: color 0.2s ease, background-color 0.2s ease;
    }

    .ctf-btn-remove-slot:hover {
        color: #DC3545;
        background: rgba(220, 53, 69, 0.08);
    }

    .ctf-field {
        margin-bottom: 14px;
    }

    .ctf-field label {
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--color-text-secondary, #4A3F6B);
        margin-bottom: 5px;
        transition: color 0.2s ease;
    }

    .ctf-field:focus-within label {
        color: var(--color-cyan-600, #00A8BB);
    }

    .ctf-field input {
        background: #FFFFFF;
        border: 1.5px solid var(--color-border, #DDD5F0);
        border-radius: var(--radius-sm, 8px);
        padding: 9px 13px;
        font-size: 0.92rem;
        color: var(--color-text-primary, #0F0A1E);
        width: 100%;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .ctf-field input:focus {
        outline: none;
        border-color: var(--color-cyan-500, #00C8DD);
        box-shadow: 0 0 0 3px rgba(0, 200, 221, 0.15);
    }

    .text-neon-cyan {
        color: var(--color-cyan-600) !important;
        text-shadow: 0 1px 6px rgba(0, 200, 221, 0.2) !important;
    }

    /* Simple & Silky Smooth Entrance Animations */
    @keyframes ctfSimpleFadeUp {
        from { opacity: 0; transform: translate3d(0, 20px, 0); }
        to { opacity: 1; transform: translate3d(0, 0, 0); }
    }

    .ctf-animate-hero-left {
        animation: ctfSimpleFadeUp 0.85s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        will-change: opacity, transform;
    }

    .ctf-animate-hero-right {
        animation: ctfSimpleFadeUp 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.15s forwards;
        opacity: 0;
        will-change: opacity, transform;
    }

    [data-aos] {
        transition-timing-function: cubic-bezier(0.16, 1, 0.3, 1) !important;
        backface-visibility: hidden;
        transform: translateZ(0);
    }

    @media (max-width: 768px) {
        .ctf-hero { padding: 95px 0 40px; }
        .ctf-form-container { padding: 24px 16px; }
        .ctf-member-card { padding: 14px 12px; }
    }
</style>
@endsection

@section('content')
<div class="ctf-page-wrapper">
    <section class="ctf-hero">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-7 ctf-animate-hero-left">
                    <h1 class="ctf-title">
                        Kompetisi <span class="text-neon-cyan">Capture The Flag</span> (CTF)
                    </h1>

                    <p class="ctf-subtitle">
                        Uji kemampuan analisis keamanan siber, reverse engineering, eksploitasi web, hingga kriptografi dalam kompetisi berbasis skenario peretasan dan pertahanan (Attack & Defense) berstandar nasional.
                    </p>

                    <div class="ctf-actions">
                        <a href="#form-pendaftaran" class="btn-idle-primary pulse">
                            <i class="fa fa-flag" style="margin-right: 8px;"></i> Daftar Sekarang
                        </a>
                        <!-- Link Rulebook dipertahankan dari versi lama -->
                        <a href="{{ asset('assets/rulebook/ctf.pdf') }}" target="_blank" class="btn-idle-secondary">
                            <i class="fa fa-file-pdf-o" style="margin-right: 8px;"></i> Unduh Rule Book
                        </a>
                        <a href="{{ route('kompetisi.peserta', ['kategori' => $kategori->kategori]) }}" class="btn-idle-outline" title="Klik untuk melihat daftar tim">
                            <i class="fa fa-users" style="margin-right: 8px;"></i> {{ $kategori->tims()->count() }} Tim Terdaftar
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 mt-4 mt-lg-0 text-center ctf-animate-hero-right">
                    <div class="ctf-poster-box mx-auto" style="max-width: 460px;">
                        <img class="ctf-poster-img" src="{{ asset('assets/img/kategori/'.$kategori->kategori.'.jpg') }}" alt="Poster {{ $kategori->nama_kategori }}">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 50px 0 30px;">
        <div class="container">
            <div class="card-kompetisi corner-active p-4 p-md-5 mb-5" data-aos="fade-up" data-aos-duration="850" data-aos-once="true" data-aos-offset="40">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h2 class="font-display font-weight-bold mb-3" style="color: var(--color-text-primary); font-size: 1.75rem;">
                            Tentang Capture The Flag
                        </h2>

                        <p style="color: var(--color-text-secondary); line-height: 1.75; font-size: 0.95rem; text-align: justify;">
                            <strong>Capture the Flag (CTF)</strong> adalah kompetisi keamanan informasi yang mengharuskan peserta untuk mengeksploitasi kerentanan sistem demi mengambil sebuah file atau string tersembunyi yang disebut "Flag". Peserta diperbolehkan menggunakan perangkat mandiri dan mempersiapkan skrip eksploitasi mereka sebelum pertandingan dimulai.
                        </p>

                        <p style="color: var(--color-text-secondary); line-height: 1.75; font-size: 0.95rem; text-align: justify;">
                            Terdapat dua format utama dalam kompetisi ini: <strong>Jeopardy</strong> (penyelesaian tantangan dari server terpusat seperti Web Exploitation, Reverse Engineering, Forensics, dan Kriptografi) serta <strong>Attack and Defense</strong> (di mana setiap tim mempertahankan server virtual mereka sendiri sekaligus mencoba meretas server tim lawan untuk mencuri flag atau memaksimalkan waktu *downtime* lawan).
                        </p>
                    </div>
                </div>
            </div>

            <div id="form-pendaftaran" class="ctf-form-container p-4 p-md-5 mb-5" data-aos="fade-up" data-aos-duration="850" data-aos-once="true" data-aos-offset="40">
                <div class="text-center mb-4">
                    <h2 class="font-display font-weight-bold" style="font-size: 1.65rem; color: var(--color-text-primary); margin-bottom: 6px;">
                        Formulir Registrasi Tim
                    </h2>
                    <p style="color: var(--color-text-secondary); font-size: 0.88rem; margin: 0;">
                        Setiap tim terdiri dari maksimal 3 anggota. Kolom bertanda <span class="text-danger">*</span> wajib diisi.
                    </p>
                </div>

                <form method="POST" action="{{ route('kompetisi.store', ['kategori' => $kategori->id]) }}">
                    @csrf
                    <input type="hidden" value="{{ $kategori->id }}" name="kategori">

                    <!-- IDENTITAS TIM -->
                    <div class="ctf-field mb-4">
                        <label>Nama Tim <span class="text-danger">*</span></label>
                        <input type="text" name="nama_tim" value="{{ old('nama_tim') }}" required placeholder="Masukkan nama tim">
                    </div>

                    <!-- KETUA TIM -->
                    <div class="ctf-member-card">
                        <div class="ctf-member-header">
                            <div>
                                <h3 class="ctf-member-title">Data Ketua Tim</h3>
                                <span class="ctf-member-subtitle">Penanggung jawab utama tim (Wajib)</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 ctf-field">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama[]" value="{{ old('nama.0') }}" required placeholder="Nama lengkap">
                            </div>
                            <div class="col-md-6 ctf-field">
                                <label>NIM <span class="text-danger">*</span></label>
                                <input class="font-mono" type="number" name="nim[]" value="{{ old('nim.0') }}" required placeholder="NIM Universitas">
                            </div>
                            <div class="col-md-6 ctf-field mb-md-0">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="font-mono" type="email" name="email[]" value="{{ old('email.0') }}" required placeholder="Alamat email aktif">
                            </div>
                            <div class="col-md-6 ctf-field mb-0">
                                <label>No. WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp[]" value="{{ old('no_hp.0') }}" required placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                    </div>

                    <!-- ANGGOTA 1 -->
                    <div class="ctf-member-card">
                        <div class="ctf-member-header">
                            <div>
                                <h3 class="ctf-member-title">Data Anggota 1</h3>
                                <span class="ctf-member-subtitle">Anggota tim pertama (Opsional)</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 ctf-field">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama[]" value="{{ old('nama.1') }}" placeholder="Nama lengkap">
                            </div>
                            <div class="col-md-6 ctf-field">
                                <label>NIM</label>
                                <input class="font-mono" type="number" name="nim[]" value="{{ old('nim.1') }}" placeholder="NIM Universitas">
                            </div>
                            <div class="col-md-6 ctf-field mb-md-0">
                                <label>Email</label>
                                <input class="font-mono" type="email" name="email[]" value="{{ old('email.1') }}" placeholder="Alamat email aktif">
                            </div>
                            <div class="col-md-6 ctf-field mb-0">
                                <label>No. WhatsApp</label>
                                <input type="text" name="no_hp[]" value="{{ old('no_hp.1') }}" placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                    </div>

                    @php
                        $hasAnggota3 = old('nama.2') || old('nim.2') || old('email.2') || old('no_hp.2');
                    @endphp

                    <!-- ANGGOTA 2 (SLOT ANGGOTA KETIGA) -->
                    <div id="wrapper-anggota-3" style="{{ $hasAnggota3 ? '' : 'display: none;' }}">
                        <div class="ctf-member-card ctf-member-card-secondary">
                            <div class="ctf-member-header">
                                <div>
                                    <h3 class="ctf-member-title">Data Anggota 2</h3>
                                    <span class="ctf-member-subtitle">Anggota tim tambahan (Opsional)</span>
                                </div>
                                <button type="button" class="ctf-btn-remove-slot" id="btn-remove-member" title="Batalkan penambahan anggota">
                                    <i class="fa fa-times-circle"></i> Batal / Hapus
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ctf-field">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama[]" value="{{ old('nama.2') }}" placeholder="Nama lengkap anggota 2">
                                </div>
                                <div class="col-md-6 ctf-field">
                                    <label>NIM</label>
                                    <input class="font-mono" type="number" name="nim[]" value="{{ old('nim.2') }}" placeholder="NIM Universitas">
                                </div>
                                <div class="col-md-6 ctf-field mb-md-0">
                                    <label>Email</label>
                                    <input class="font-mono" type="email" name="email[]" value="{{ old('email.2') }}" placeholder="Alamat email aktif">
                                </div>
                                <div class="col-md-6 ctf-field mb-0">
                                    <label>No. WhatsApp</label>
                                    <input type="text" name="no_hp[]" value="{{ old('no_hp.2') }}" placeholder="08xxxxxxxxxx">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TRIGGER TAMBAH ANGGOTA KETIGA -->
                    <div id="btn-add-member" class="ctf-add-member-trigger" style="{{ $hasAnggota3 ? 'display: none;' : '' }}">
                        <div class="ctf-add-member-icon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="ctf-add-member-info">
                            <div class="ctf-add-member-title">Punya Anggota Tambahan?</div>
                            <div class="ctf-add-member-sub">Klik di sini jika tim Anda memiliki 3 peserta untuk mengisi data anggota terakhir.</div>
                        </div>
                        <div class="ctf-btn-slot-action">
                            <i class="fa fa-plus"></i> Tambah Anggota
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="text-center pt-3">
                        <button class="btn-idle-primary pulse" type="submit" style="min-width: 220px; padding: 12px 32px; font-size: 0.95rem;">
                            <i class="fa fa-paper-plane" style="margin-right: 8px;"></i> Kirim Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#btn-add-member').on('click', function() {
            $(this).slideUp(180, function() {
                $('#wrapper-anggota-3').slideDown(250);
                $('#wrapper-anggota-3 input').first().focus();
            });
        });

        $('#btn-remove-member').on('click', function() {
            $('#wrapper-anggota-3').slideUp(200, function() {
                $('#wrapper-anggota-3 input').val('');
                $('#btn-add-member').slideDown(200);
            });
        });
    });
</script>
@endsection