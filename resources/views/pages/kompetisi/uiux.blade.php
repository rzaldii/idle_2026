@extends('layouts.base')

@section('title', 'IDLe 2026 — Kompetisi UI/UX Design')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/idle-design-system.css') }}">
<style>
    /* =========================================================
       Scoped Styling for UI/UX Page — IDLE 2026 Retro Arcade Theme
       ========================================================= */
    body {
        background-color: var(--color-bg-base, #F8F5FF);
        font-family: var(--font-body, 'Inter', sans-serif);
        color: var(--color-text-primary, #0F0A1E);
    }

    .kompetisi-page-wrapper {
        background-color: var(--color-bg-base, #F8F5FF);
        min-height: 100vh;
    }

    /* Hero Section */
    .kompetisi-hero {
        padding: 130px 0 60px;
        background: var(--gradient-hero-overlay, linear-gradient(180deg, #F8F5FF 0%, #EDE8FF 60%, #F8F5FF 100%));
        position: relative;
        overflow: hidden;
    }

    .kompetisi-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(0, 200, 221, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 200, 221, 0.05) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
    }

    .kompetisi-title {
        font-family: var(--font-display, 'Space Grotesk', sans-serif);
        font-weight: 700;
        font-size: clamp(2rem, 3.8vw, 3rem);
        line-height: 1.18;
        color: var(--color-text-primary, #0F0A1E);
        margin-bottom: 16px;
    }

    .kompetisi-subtitle {
        font-family: var(--font-body, 'Inter', sans-serif);
        font-size: 1.05rem;
        color: var(--color-text-secondary, #4A3F6B);
        max-width: 650px;
        line-height: 1.65;
        margin-bottom: 24px;
    }

    .kompetisi-actions {
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

    /* Poster Frame */
    .kompetisi-poster-box {
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

    .kompetisi-poster-box:hover {
        transform: translate3d(0, -3px, 0);
        box-shadow: 0 8px 20px rgba(15, 10, 30, 0.1), 0 2px 8px rgba(0, 200, 221, 0.15);
        border-color: var(--color-cyan-500, #00C8DD);
    }

    .kompetisi-poster-img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    /* Card Box */
    .card-kompetisi-info {
        background: #FFFFFF;
        border: 2px solid var(--color-border, #DDD5F0);
        border-radius: var(--radius-md, 12px);
        box-shadow: var(--shadow-sm, 0 2px 8px rgba(15, 10, 30, 0.08));
        transition: transform 0.25s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.25s cubic-bezier(0.2, 0.8, 0.2, 1), border-color 0.25s ease;
        will-change: transform;
        transform: translateZ(0);
    }

    .card-kompetisi-info:hover {
        transform: translate3d(0, -3px, 0);
        border-color: var(--color-cyan-500, #00C8DD);
        box-shadow: 0 8px 20px rgba(15, 10, 30, 0.08), 0 2px 8px rgba(0, 200, 221, 0.1);
    }

    /* Form Container & Member Cards */
    .kompetisi-form-container {
        width: 100%;
        background: #FFFFFF;
        border: 2px solid var(--color-border, #DDD5F0);
        border-radius: var(--radius-md, 12px);
        box-shadow: var(--shadow-sm, 0 2px 8px rgba(15, 10, 30, 0.08));
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .kompetisi-form-container:hover {
        border-color: #D2C6EC;
        box-shadow: 0 4px 16px rgba(15, 10, 30, 0.08);
    }

    .kompetisi-member-card {
        background: #FAF9FF;
        border: 1px solid #ECE7FA;
        border-radius: var(--radius-md, 12px);
        padding: 20px 22px;
        margin-bottom: 20px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    }

    .kompetisi-member-card:hover,
    .kompetisi-member-card:focus-within {
        background: #FFFFFF;
        border-color: rgba(0, 200, 221, 0.45);
        box-shadow: 0 3px 12px rgba(15, 10, 30, 0.05);
    }

    .kompetisi-member-card-secondary {
        border-style: dashed;
        background: #FCFBFF;
    }

    .kompetisi-member-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #EBE5F7;
    }

    .kompetisi-member-title {
        font-family: var(--font-display, 'Space Grotesk', sans-serif);
        font-size: 0.98rem;
        font-weight: 700;
        color: var(--color-text-primary, #0F0A1E);
        margin: 0;
    }

    .kompetisi-member-subtitle {
        display: block;
        font-size: 0.78rem;
        color: var(--color-text-muted, #8A7DA8);
        font-weight: 400;
        margin-top: 2px;
    }

    /* Add Member Trigger */
    .kompetisi-add-member-trigger {
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

    .kompetisi-add-member-trigger:hover {
        border-color: var(--color-cyan-500, #00C8DD);
        background: #FFFFFF;
        box-shadow: 0 3px 12px rgba(0, 200, 221, 0.12);
        transform: translateY(-1px);
    }

    .kompetisi-add-member-icon {
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

    .kompetisi-add-member-trigger:hover .kompetisi-add-member-icon {
        background: var(--color-cyan-500, #00C8DD);
        color: #0A0714;
    }

    .kompetisi-add-member-info {
        flex: 1;
        text-align: left;
    }

    .kompetisi-add-member-title {
        font-family: var(--font-display, 'Space Grotesk', sans-serif);
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--color-text-primary, #0F0A1E);
    }

    .kompetisi-add-member-sub {
        font-size: 0.8rem;
        color: var(--color-text-muted, #8A7DA8);
        margin-top: 2px;
    }

    .kompetisi-btn-slot-action {
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

    .kompetisi-add-member-trigger:hover .kompetisi-btn-slot-action {
        background: var(--color-cyan-500, #00C8DD);
        color: #0A0714;
    }

    .kompetisi-btn-remove-slot {
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

    .kompetisi-btn-remove-slot:hover {
        color: #DC3545;
        background: rgba(220, 53, 69, 0.08);
    }

    .kompetisi-field {
        margin-bottom: 14px;
    }

    .kompetisi-field label {
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--color-text-secondary, #4A3F6B);
        margin-bottom: 5px;
        transition: color 0.2s ease;
    }

    .kompetisi-field:focus-within label {
        color: var(--color-cyan-600, #00A8BB);
    }

    .kompetisi-field input {
        background: #FFFFFF;
        border: 1.5px solid var(--color-border, #DDD5F0);
        border-radius: var(--radius-sm, 8px);
        padding: 9px 13px;
        font-size: 0.92rem;
        color: var(--color-text-primary, #0F0A1E);
        width: 100%;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .kompetisi-field input:hover {
        border-color: #BDB2DF;
    }

    .kompetisi-field input:focus {
        outline: none;
        border-color: var(--color-cyan-500, #00C8DD);
        box-shadow: 0 0 0 3px rgba(0, 200, 221, 0.15);
    }

    .text-neon-cyan {
        color: var(--color-cyan-600) !important;
        text-shadow: 0 1px 6px rgba(0, 200, 221, 0.2) !important;
    }

    @media (max-width: 768px) {
        .kompetisi-hero {
            padding: 95px 0 40px;
        }
        .kompetisi-form-container {
            padding: 24px 16px;
        }
        .kompetisi-member-card {
            padding: 14px 12px;
        }
    }
</style>
@endsection

@section('content')
<div class="kompetisi-page-wrapper">
    <!-- =========================================================
         HERO SECTION
         ========================================================= -->
    <section class="kompetisi-hero">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="kompetisi-title">
                        Kompetisi <span class="text-neon-cyan">UI/UX Design</span> (ITeC 2026)
                    </h1>

                    <p class="kompetisi-subtitle">
                        Rancang antarmuka dan pengalaman pengguna produk digital yang intuitif, estetis, dan berdampak nyata untuk menciptakan solusi inovasi teknologi berkelanjutan dan inklusif.
                    </p>

                    <div class="kompetisi-actions">
                        <a href="#form-pendaftaran" class="btn-idle-primary">
                            <i class="fa fa-edit" style="margin-right: 8px;"></i> Daftar Sekarang
                        </a>
                        <a href="https://drive.google.com/drive/folders/13rCnJi1wkMmMkJaWuY4a1f2HDB1fvvcw" target="_blank" class="btn-idle-secondary">
                            <i class="fa fa-file-pdf-o" style="margin-right: 8px;"></i> Unduh Guidebook
                        </a>
                        <a href="https://docs.google.com/document/d/1qN2XB65UuZixGU1VAJzbVbzug77nGEEIcnKEvO1fI-c/edit?usp=sharing" target="_blank" class="btn-idle-outline">
                            <i class="fa fa-file-text-o" style="margin-right: 8px;"></i> Template Proposal
                        </a>
                        <a href="{{ route('kompetisi.peserta', ['kategori' => $kategori->kategori]) }}" class="btn-idle-outline" title="Klik untuk melihat daftar tim">
                            <i class="fa fa-users" style="margin-right: 8px;"></i> {{ $kategori->tims()->count() }} Tim Terdaftar
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 mt-4 mt-lg-0 text-center">
                    <div class="kompetisi-poster-box mx-auto" style="max-width: 460px;">
                        <img class="kompetisi-poster-img" 
                             src="{{ asset('assets/img/kategori/'.$kategori->kategori.'.jpg') }}" 
                             alt="Poster {{ $kategori->nama_kategori }}"
                             onerror="this.onerror=null; this.src='{{ asset('assets/img/kategori/uiux.jpg') }}'">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================
         DETAIL & REGISTRATION SECTION
         ========================================================= -->
    <section style="padding: 50px 0 30px;">
        <div class="container">
            <!-- About Section -->
            <div class="card-kompetisi-info p-4 p-md-5 mb-5">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h2 class="font-display font-weight-bold mb-3" style="color: var(--color-text-primary); font-size: 1.75rem;">
                            Tentang UI/UX Design ITeC 2026
                        </h2>

                        <p style="color: var(--color-text-secondary); line-height: 1.75; font-size: 0.95rem; text-align: justify;">
                            User Interface & User Experience (UI/UX) Design ITeC 2026 merupakan cabang kompetisi perancangan solusi digital yang berfokus pada kebutuhan pengguna, kemudahan penggunaan, serta pengalaman interaksi yang inklusif. Kompetisi ini mendorong peserta untuk menghadirkan solusi digital yang relevan dengan permasalahan masyarakat dan mendukung pencapaian Sustainable Development Goals (SDGs), sejalan dengan tema utama “Digital Innovation for Smart Society: Empowering Sustainable, Inclusive, and Impactful Technology”.
                        </p>

                        <p style="color: var(--color-text-secondary); line-height: 1.75; font-size: 0.95rem; text-align: justify; margin-bottom: 0;">
                            Peserta ditantang untuk menggali permasalahan dan kebutuhan pengguna serta menerjemahkannya menjadi rancangan solusi digital yang inovatif dan berdampak. Karya yang dikembangkan akan dipresentasikan pada babak final untuk menjelaskan permasalahan, proses perancangan, solusi yang ditawarkan, serta keterkaitannya dengan isu SDGs.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Registration Form -->
            <div id="form-pendaftaran" class="kompetisi-form-container p-4 p-md-5 mb-5">
                <div class="text-center mb-4">
                    <h2 class="font-display font-weight-bold" style="font-size: 1.65rem; color: var(--color-text-primary); margin-bottom: 6px;">
                        Formulir Registrasi Tim
                    </h2>
                    <p style="color: var(--color-text-secondary); font-size: 0.88rem; margin: 0;">
                        Setiap tim terdiri dari maksimal 3 mahasiswa aktif Fakultas Ilmu Komputer UNEJ. Kolom bertanda <span class="text-danger">*</span> wajib diisi.
                    </p>
                </div>

                <form method="POST" action="{{ route('kompetisi.store', ['kategori' => $kategori->id]) }}">
                    @csrf
                    <input type="hidden" value="{{ $kategori->id }}" name="kategori">

                    <!-- IDENTITAS TIM -->
                    <div class="kompetisi-field mb-4">
                        <label>Nama Tim <span class="text-danger">*</span></label>
                        <input type="text" id="nama_tim" name="nama_tim" value="{{ old('nama_tim') }}" required placeholder="Masukkan nama tim Anda">
                    </div>

                    <!-- KETUA TIM -->
                    <div class="kompetisi-member-card">
                        <div class="kompetisi-member-header">
                            <div>
                                <h3 class="kompetisi-member-title">Data Ketua Tim</h3>
                                <span class="kompetisi-member-subtitle">Penanggung jawab utama dan kontak tim</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 kompetisi-field">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama[]" value="{{ old('nama.0') }}" required placeholder="Nama lengkap ketua">
                            </div>
                            <div class="col-md-6 kompetisi-field">
                                <label>NIM <span class="text-danger">*</span></label>
                                <input class="font-mono" type="number" name="nim[]" value="{{ old('nim.0') }}" required placeholder="NIM UNEJ">
                            </div>
                            <div class="col-md-6 kompetisi-field mb-md-0">
                                <label>Email UNEJ <span class="text-danger">*</span></label>
                                <input class="font-mono" type="email" name="email[]" value="{{ old('email.0') }}" required placeholder="nim@mail.unej.ac.id">
                            </div>
                            <div class="col-md-6 kompetisi-field mb-0">
                                <label>No. WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp[]" value="{{ old('no_hp.0') }}" required placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                    </div>

                    <!-- ANGGOTA 1 -->
                    <div class="kompetisi-member-card">
                        <div class="kompetisi-member-header">
                            <div>
                                <h3 class="kompetisi-member-title">Data Anggota 1</h3>
                                <span class="kompetisi-member-subtitle">Anggota tim inti</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 kompetisi-field">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama[]" value="{{ old('nama.1') }}" required placeholder="Nama lengkap anggota 1">
                            </div>
                            <div class="col-md-6 kompetisi-field">
                                <label>NIM <span class="text-danger">*</span></label>
                                <input class="font-mono" type="number" name="nim[]" value="{{ old('nim.1') }}" required placeholder="NIM UNEJ">
                            </div>
                            <div class="col-md-6 kompetisi-field mb-md-0">
                                <label>Email UNEJ <span class="text-danger">*</span></label>
                                <input class="font-mono" type="email" name="email[]" value="{{ old('email.1') }}" required placeholder="nim@mail.unej.ac.id">
                            </div>
                            <div class="col-md-6 kompetisi-field mb-0">
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
                        <div class="kompetisi-member-card kompetisi-member-card-secondary">
                            <div class="kompetisi-member-header">
                                <div>
                                    <h3 class="kompetisi-member-title">Data Anggota 2</h3>
                                    <span class="kompetisi-member-subtitle">Anggota tambahan untuk tim yang beranggotakan 3 orang</span>
                                </div>
                                <button type="button" class="kompetisi-btn-remove-slot" id="btn-remove-member" title="Batalkan penambahan anggota ketiga">
                                    <i class="fa fa-times-circle"></i> Batal / Hapus
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-6 kompetisi-field">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama[]" value="{{ old('nama.2') }}" placeholder="Nama lengkap anggota 2">
                                </div>
                                <div class="col-md-6 kompetisi-field">
                                    <label>NIM</label>
                                    <input class="font-mono" type="number" name="nim[]" value="{{ old('nim.2') }}" placeholder="NIM UNEJ">
                                </div>
                                <div class="col-md-6 kompetisi-field mb-md-0">
                                    <label>Email UNEJ</label>
                                    <input class="font-mono" type="email" name="email[]" value="{{ old('email.2') }}" placeholder="nim@mail.unej.ac.id">
                                </div>
                                <div class="col-md-6 kompetisi-field mb-0">
                                    <label>No. WhatsApp</label>
                                    <input type="text" name="no_hp[]" value="{{ old('no_hp.2') }}" placeholder="08xxxxxxxxxx">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TRIGGER TAMBAH ANGGOTA KETIGA -->
                    <div id="btn-add-member" class="kompetisi-add-member-trigger" style="{{ $hasAnggota3 ? 'display: none;' : '' }}">
                        <div class="kompetisi-add-member-icon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="kompetisi-add-member-info">
                            <div class="kompetisi-add-member-title">Punya Anggota ke-3?</div>
                            <div class="kompetisi-add-member-sub">Klik di sini jika tim Anda memiliki 3 peserta untuk mengisi data anggota tambahan.</div>
                        </div>
                        <div class="kompetisi-btn-slot-action">
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
