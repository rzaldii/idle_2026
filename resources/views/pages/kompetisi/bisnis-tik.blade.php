@extends('layouts.base')

@section('title', 'IDLE 2026 — Kompetisi ' . $kategori->nama_kategori)

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/idle-design-system.css') }}">
<style>
    /* =========================================================
       Scoped Styling for Bisnis TIK Page — IDLE 2026 Retro Arcade Theme
       ========================================================= */
    body {
        background-color: var(--color-bg-base, #F8F5FF);
        font-family: var(--font-body, 'Inter', sans-serif);
        color: var(--color-text-primary, #0F0A1E);
    }

    .cpc-page-wrapper {
        background-color: var(--color-bg-base, #F8F5FF);
        min-height: 100vh;
    }

    /* Hero Section */
    .cpc-hero {
        padding: 130px 0 60px;
        background: var(--gradient-hero-overlay, linear-gradient(180deg, #F8F5FF 0%, #EDE8FF 60%, #F8F5FF 100%));
        position: relative;
        overflow: hidden;
    }

    .cpc-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(0, 200, 221, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 200, 221, 0.05) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
    }

    .cpc-title {
        font-family: var(--font-display, 'Space Grotesk', sans-serif);
        font-weight: 700;
        font-size: clamp(2rem, 3.8vw, 3rem);
        line-height: 1.18;
        color: var(--color-text-primary, #0F0A1E);
        margin-bottom: 16px;
    }

    .cpc-subtitle {
        font-family: var(--font-body, 'Inter', sans-serif);
        font-size: 1.05rem;
        color: var(--color-text-secondary, #4A3F6B);
        max-width: 650px;
        line-height: 1.65;
        margin-bottom: 24px;
    }

    .cpc-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
    }

    /* Buttons */
    .btn-idle-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-pill, 9999px);
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0, 200, 221, 0.2) !important;
        transition: transform 0.2s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.2s cubic-bezier(0.2, 0.8, 0.2, 1), background-color 0.2s ease !important;
        will-change: transform;
        transform: translateZ(0);
    }

    .btn-idle-primary:hover {
        transform: translate3d(0, -2px, 0);
        box-shadow: 0 5px 14px rgba(0, 200, 221, 0.32) !important;
        background-color: var(--color-cyan-400, #22DDEE) !important;
    }

    .btn-idle-primary:active {
        transform: translate3d(0, 0, 0);
        box-shadow: 0 2px 6px rgba(0, 200, 221, 0.2) !important;
    }

    .btn-idle-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-pill, 9999px);
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(232, 0, 192, 0.18) !important;
        transition: transform 0.2s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.2s cubic-bezier(0.2, 0.8, 0.2, 1), background-color 0.2s ease !important;
        will-change: transform;
        transform: translateZ(0);
    }

    .btn-idle-secondary:hover {
        transform: translate3d(0, -2px, 0);
        box-shadow: 0 5px 14px rgba(232, 0, 192, 0.28) !important;
        background-color: var(--color-magenta-400, #FF3FD8) !important;
    }

    .btn-idle-secondary:active {
        transform: translate3d(0, 0, 0);
    }

    .btn-idle-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-pill, 9999px);
        font-weight: 600;
        transition: transform 0.2s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.2s cubic-bezier(0.2, 0.8, 0.2, 1), background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease !important;
        will-change: transform;
        transform: translateZ(0);
    }

    .btn-idle-outline:hover {
        transform: translate3d(0, -2px, 0);
        box-shadow: 0 4px 12px rgba(0, 200, 221, 0.2) !important;
    }

    .btn-idle-outline:active {
        transform: translate3d(0, 0, 0);
    }

    .btn-idle-outline-magenta {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-pill, 9999px);
        font-weight: 600;
        border: 2px solid var(--color-magenta-500, #E800C0);
        color: var(--color-magenta-600, #C200A0) !important;
        padding: 10px 24px;
        background: transparent;
        text-decoration: none !important;
        transition: transform 0.2s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.2s cubic-bezier(0.2, 0.8, 0.2, 1), background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease !important;
        will-change: transform;
        transform: translateZ(0);
    }

    .btn-idle-outline-magenta:hover {
        transform: translate3d(0, -2px, 0);
        background: rgba(232, 0, 192, 0.08);
        border-color: var(--color-magenta-400, #FF3FD8);
        color: var(--color-magenta-500, #E800C0) !important;
        box-shadow: 0 4px 12px rgba(232, 0, 192, 0.25) !important;
    }

    .btn-idle-outline-magenta:active {
        transform: translate3d(0, 0, 0);
    }

    /* Poster Frame */
    .cpc-poster-box {
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

    .cpc-poster-box:hover {
        transform: translate3d(0, -3px, 0);
        box-shadow: 0 8px 20px rgba(15, 10, 30, 0.1), 0 2px 8px rgba(0, 200, 221, 0.15);
        border-color: var(--color-cyan-500, #00C8DD);
    }

    .cpc-poster-img {
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

    /* Entrance Animations */
    @keyframes cpcSimpleFadeUp {
        from {
            opacity: 0;
            transform: translate3d(0, 20px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    .cpc-animate-hero-left {
        animation: cpcSimpleFadeUp 0.85s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        will-change: opacity, transform;
    }

    .cpc-animate-hero-right {
        animation: cpcSimpleFadeUp 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.15s forwards;
        opacity: 0;
        will-change: opacity, transform;
    }

    [data-aos] {
        transition-timing-function: cubic-bezier(0.16, 1, 0.3, 1) !important;
        backface-visibility: hidden;
        transform: translateZ(0);
    }

    /* Form Container & Member Cards */
    .cpc-form-container {
        width: 100%;
        background: #FFFFFF;
        border: 2px solid var(--color-border, #DDD5F0);
        border-radius: var(--radius-md, 12px);
        box-shadow: var(--shadow-sm, 0 2px 8px rgba(15, 10, 30, 0.08));
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .cpc-form-container:hover {
        border-color: #D2C6EC;
        box-shadow: 0 4px 16px rgba(15, 10, 30, 0.08);
    }

    .cpc-member-card {
        background: #FAF9FF;
        border: 1px solid #ECE7FA;
        border-radius: var(--radius-md, 12px);
        padding: 20px 22px;
        margin-bottom: 20px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    }

    .cpc-member-card:hover,
    .cpc-member-card:focus-within {
        background: #FFFFFF;
        border-color: rgba(0, 200, 221, 0.45);
        box-shadow: 0 3px 12px rgba(15, 10, 30, 0.05);
    }

    .cpc-member-card-secondary {
        border-style: dashed;
        background: #FCFBFF;
    }

    .cpc-member-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #EBE5F7;
    }

    .cpc-member-title {
        font-family: var(--font-display, 'Space Grotesk', sans-serif);
        font-size: 0.98rem;
        font-weight: 700;
        color: var(--color-text-primary, #0F0A1E);
        margin: 0;
    }

    .cpc-member-subtitle {
        display: block;
        font-size: 0.78rem;
        color: var(--color-text-muted, #8A7DA8);
        font-weight: 400;
        margin-top: 2px;
    }

    /* Add Member Trigger */
    .cpc-add-member-trigger {
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

    .cpc-add-member-trigger:hover {
        border-color: var(--color-cyan-500, #00C8DD);
        background: #FFFFFF;
        box-shadow: 0 3px 12px rgba(0, 200, 221, 0.12);
        transform: translateY(-1px);
    }

    .cpc-add-member-icon {
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

    .cpc-add-member-trigger:hover .cpc-add-member-icon {
        background: var(--color-cyan-500, #00C8DD);
        color: #0A0714;
    }

    .cpc-add-member-info {
        flex: 1;
        text-align: left;
    }

    .cpc-add-member-title {
        font-family: var(--font-display, 'Space Grotesk', sans-serif);
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--color-text-primary, #0F0A1E);
    }

    .cpc-add-member-sub {
        font-size: 0.8rem;
        color: var(--color-text-muted, #8A7DA8);
        margin-top: 2px;
    }

    .cpc-btn-slot-action {
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

    .cpc-add-member-trigger:hover .cpc-btn-slot-action {
        background: var(--color-cyan-500, #00C8DD);
        color: #0A0714;
    }

    .cpc-btn-remove-slot {
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

    .cpc-btn-remove-slot:hover {
        color: #DC3545;
        background: rgba(220, 53, 69, 0.08);
    }

    .cpc-field {
        margin-bottom: 14px;
    }

    .cpc-field label {
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--color-text-secondary, #4A3F6B);
        margin-bottom: 5px;
        transition: color 0.2s ease;
    }

    .cpc-field:focus-within label {
        color: var(--color-cyan-600, #00A8BB);
    }

    .cpc-field input {
        background: #FFFFFF;
        border: 1.5px solid var(--color-border, #DDD5F0);
        border-radius: var(--radius-sm, 8px);
        padding: 9px 13px;
        font-size: 0.92rem;
        color: var(--color-text-primary, #0F0A1E);
        width: 100%;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .cpc-field input:hover {
        border-color: #BDB2DF;
    }

    .cpc-field input:focus {
        outline: none;
        border-color: var(--color-cyan-500, #00C8DD);
        box-shadow: 0 0 0 3px rgba(0, 200, 221, 0.15);
    }

    .text-neon-cyan {
        color: var(--color-cyan-600) !important;
        text-shadow: 0 1px 6px rgba(0, 200, 221, 0.2) !important;
    }

    @media (max-width: 768px) {
        .cpc-hero {
            padding: 95px 0 40px;
        }
        .cpc-form-container {
            padding: 24px 16px;
        }
        .cpc-member-card {
            padding: 14px 12px;
        }
    }
</style>
@endsection

@section('content')
<div class="cpc-page-wrapper">
    <section class="cpc-hero">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-7 cpc-animate-hero-left">
                    <h1 class="cpc-title">
                        Kompetisi <span class="text-neon-cyan">Bisnis TIK</span>
                    </h1>

                    <p class="cpc-subtitle">
                        Kompetisi pengembangan model bisnis berbasis produk TIK dengan penerapan metodologi Lean Startup dan semangat social entrepreneurship yang berdampak nyata.
                    </p>

                    <div class="cpc-actions">
                        <a href="#form-pendaftaran" class="btn-idle-primary">
                            <i class="fa fa-edit" style="margin-right: 8px;"></i> Daftar Sekarang
                        </a>
                        <a href="https://drive.google.com/drive/folders/1Uccvclh1r9GvRnvk897CZS-0ARA48sMs?usp=drive_link" target="_blank" rel="noopener noreferrer" class="btn-idle-secondary">
                            <i class="fa fa-file-pdf-o" style="margin-right: 8px;"></i> Unduh Rule Book
                        </a>
                        <a href="https://docs.google.com/document/d/1xLMcZkWU5kEWPy-LzQX0yJVPq8Sg4AJz3dTgwzhpim8/edit?usp=sharing" target="_blank" rel="noopener noreferrer" class="btn-idle-outline-magenta">
                            <i class="fa fa-file-word-o" style="margin-right: 8px;"></i> Unduh Template
                        </a>
                        <a href="{{ route('kompetisi.peserta', ['kategori' => $kategori->kategori]) }}" class="btn-idle-outline" title="Klik untuk melihat daftar tim">
                            <i class="fa fa-users" style="margin-right: 8px;"></i> {{ $kategori->tims()->count() }} Tim Terdaftar
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 mt-4 mt-lg-0 text-center cpc-animate-hero-right">
                    <div class="cpc-poster-box mx-auto" style="max-width: 460px;">
                        <img class="cpc-poster-img" src="{{ asset('assets/img/kategori/'.$kategori->kategori.'.jpg') }}" alt="Poster {{ $kategori->nama_kategori }}">
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
                            Tentang Bisnis TIK
                        </h2>

                        <p style="color: var(--color-text-secondary); line-height: 1.75; font-size: 0.95rem; text-align: justify;">
                            <strong>Kompetisi Bisnis TIK IDLE 2026</strong> merupakan kompetisi pengembangan model bisnis berbasis produk TIK. Lomba ini akan menyeleksi ide pengembangan bisnis dalam bentuk Pitchdeck dan tahapan implementasi awal. Melalui penerapan metodologi Lean startup mulai dari Problem-solution fit hingga Product-market fit (desirable, viable, feasible), peserta diberikan kesempatan untuk mengembangkan ide bisnis startup maupun usaha rintisan berbasis TIK.
                        </p>

                        <p style="color: var(--color-text-secondary); line-height: 1.75; font-size: 0.95rem; text-align: justify; margin-bottom: 0;">
                            Kompetisi ini menekankan pada sejauh mana ide tersebut memberikan dampak nyata terhadap stakeholder serta menghadirkan solusi inovatif yang relevan dengan kebutuhan masyarakat. Arah pengembangan bisnis juga berfokus pada semangat social entrepreneurship yang mengedepankan value proposition of the community, sehingga mahasiswa dapat mengasah kreativitas dan keterampilan bisnis dalam menciptakan solusi inovatif berkelanjutan yang mendukung kemandirian bangsa.
                        </p>
                    </div>
                </div>
            </div>

            <div id="form-pendaftaran" class="cpc-form-container p-4 p-md-5 mb-5" data-aos="fade-up" data-aos-duration="850" data-aos-once="true" data-aos-offset="40">
                <div class="text-center mb-4">
                    <h2 class="font-display font-weight-bold" style="font-size: 1.65rem; color: var(--color-text-primary); margin-bottom: 6px;">
                        Formulir Registrasi Tim
                    </h2>
                    <p style="color: var(--color-text-secondary); font-size: 0.88rem; margin: 0;">
                        Setiap tim terdiri dari 2 hingga 3 mahasiswa aktif UNEJ. Kolom bertanda <span class="text-danger">*</span> wajib diisi.
                    </p>
                </div>

                <form method="POST" action="{{ route('kompetisi.store', ['kategori' => $kategori->id]) }}">
                    @csrf
                    <input type="hidden" value="{{ $kategori->id }}" name="kategori">

                    <!-- IDENTITAS TIM -->
                    <div class="cpc-field mb-4">
                        <label>Nama Tim <span class="text-danger">*</span></label>
                        <input type="text" id="nama_tim" name="nama_tim" value="{{ old('nama_tim') }}" required placeholder="Masukkan nama tim">
                    </div>

                    <!-- KETUA TIM -->
                    <div class="cpc-member-card">
                        <div class="cpc-member-header">
                            <div>
                                <h3 class="cpc-member-title">Data Ketua Tim</h3>
                                <span class="cpc-member-subtitle">Penanggung jawab utama dan kontak tim</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 cpc-field">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama[]" value="{{ old('nama.0') }}" required placeholder="Nama lengkap ketua">
                            </div>
                            <div class="col-md-6 cpc-field">
                                <label>NIM <span class="text-danger">*</span></label>
                                <input class="font-mono" type="number" name="nim[]" value="{{ old('nim.0') }}" required placeholder="NIM UNEJ">
                            </div>
                            <div class="col-md-6 cpc-field mb-md-0">
                                <label>Email UNEJ <span class="text-danger">*</span></label>
                                <input class="font-mono" type="email" name="email[]" value="{{ old('email.0') }}" required placeholder="nim@mail.unej.ac.id">
                            </div>
                            <div class="col-md-6 cpc-field mb-0">
                                <label>No. WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp[]" value="{{ old('no_hp.0') }}" required placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                    </div>

                    <!-- ANGGOTA 1 -->
                    <div class="cpc-member-card">
                        <div class="cpc-member-header">
                            <div>
                                <h3 class="cpc-member-title">Data Anggota 1</h3>
                                <span class="cpc-member-subtitle">Anggota tim inti</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 cpc-field">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama[]" value="{{ old('nama.1') }}" required placeholder="Nama lengkap anggota 1">
                            </div>
                            <div class="col-md-6 cpc-field">
                                <label>NIM <span class="text-danger">*</span></label>
                                <input class="font-mono" type="number" name="nim[]" value="{{ old('nim.1') }}" required placeholder="NIM UNEJ">
                            </div>
                            <div class="col-md-6 cpc-field mb-md-0">
                                <label>Email UNEJ <span class="text-danger">*</span></label>
                                <input class="font-mono" type="email" name="email[]" value="{{ old('email.1') }}" required placeholder="nim@mail.unej.ac.id">
                            </div>
                            <div class="col-md-6 cpc-field mb-0">
                                <label>No. WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp[]" value="{{ old('no_hp.1') }}" required placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                    </div>

                    @php
                        $hasAnggota3 = old('nama.2') || old('nim.2') || old('email.2') || old('no_hp.2');
                    @endphp

                    <!-- ANGGOTA 2 (SLOT ANGGOTA KETIGA) -->
                    <div id="wrapper-anggota-3" style="{{ $hasAnggota3 ? '' : 'display: none;' }}">
                        <div class="cpc-member-card cpc-member-card-secondary">
                            <div class="cpc-member-header">
                                <div>
                                    <h3 class="cpc-member-title">Data Anggota 2</h3>
                                    <span class="cpc-member-subtitle">Anggota tambahan untuk tim yang beranggotakan 3 orang</span>
                                </div>
                                <button type="button" class="cpc-btn-remove-slot" id="btn-remove-member" title="Batalkan penambahan anggota ketiga">
                                    <i class="fa fa-times-circle"></i> Batal / Hapus
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-6 cpc-field">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama[]" value="{{ old('nama.2') }}" placeholder="Nama lengkap anggota 2">
                                </div>
                                <div class="col-md-6 cpc-field">
                                    <label>NIM</label>
                                    <input class="font-mono" type="number" name="nim[]" value="{{ old('nim.2') }}" placeholder="NIM UNEJ">
                                </div>
                                <div class="col-md-6 cpc-field mb-md-0">
                                    <label>Email UNEJ</label>
                                    <input class="font-mono" type="email" name="email[]" value="{{ old('email.2') }}" placeholder="nim@mail.unej.ac.id">
                                </div>
                                <div class="col-md-6 cpc-field mb-0">
                                    <label>No. WhatsApp</label>
                                    <input type="text" name="no_hp[]" value="{{ old('no_hp.2') }}" placeholder="08xxxxxxxxxx">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TRIGGER TAMBAH ANGGOTA KETIGA -->
                    <div id="btn-add-member" class="cpc-add-member-trigger" style="{{ $hasAnggota3 ? 'display: none;' : '' }}">
                        <div class="cpc-add-member-icon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="cpc-add-member-info">
                            <div class="cpc-add-member-title">Punya Anggota ke-3?</div>
                            <div class="cpc-add-member-sub">Klik di sini jika tim Anda memiliki 3 peserta untuk mengisi data anggota tambahan.</div>
                        </div>
                        <div class="cpc-btn-slot-action">
                            <i class="fa fa-plus"></i> Tambah Anggota
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="text-center pt-3">
                        <button class="btn-idle-primary" type="submit" style="min-width: 220px; padding: 12px 32px; font-size: 0.95rem;">
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
