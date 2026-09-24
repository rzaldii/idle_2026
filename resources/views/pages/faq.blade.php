@extends('layouts.base')

@section('title', 'IDLe FAQ 2026')

@section('css')
<!-- Google Fonts: Space Grotesk & Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

<style>
  :root {
    /* Base Colors */
    --color-bg-base: #F8F5FF;
    --color-bg-section-alt: #F0ECF8;
    --color-bg-card: #FFFFFF;
    --color-bg-input: #F5F3FF;

    /* Cyan Accent (Action / Active) */
    --color-cyan-400: #22DDEE;
    --color-cyan-500: #00C8DD;
    --color-cyan-600: #00A8BB;
    --color-cyan-glow: rgba(0, 200, 221, 0.4);

    /* Magenta Accent (Highlight / Badge) */
    --color-magenta-400: #FF3FD8;
    --color-magenta-500: #E800C0;
    --color-magenta-600: #C200A0;
    --color-magenta-glow: rgba(232, 0, 192, 0.35);

    /* Text & Border Colors */
    --color-text-primary: #0F0A1E;
    --color-text-secondary: #4A3F6B;
    --color-text-muted: #8A7DA8;
    --color-border: #DDD5F0;
    --color-border-focus: #00C8DD;

    /* Gradients */
    --gradient-neon-primary: linear-gradient(135deg, #00C8DD 0%, #E800C0 100%);
    --gradient-hero-overlay: linear-gradient(180deg, #F8F5FF 0%, #EDE8FF 60%, #F8F5FF 100%);
    --gradient-card-hover: linear-gradient(135deg, rgba(0, 200, 221, 0.04) 0%, rgba(232, 0, 192, 0.04) 100%);

    /* Typography */
    --font-display: 'Space Grotesk', sans-serif;
    --font-body: 'Inter', sans-serif;

    /* Radius */
    --radius-xs: 4px;
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
    --radius-pill: 9999px;

    /* Shadows */
    --shadow-sm: 0 2px 8px rgba(15, 10, 30, 0.06);
    --shadow-md: 0 4px 16px rgba(15, 10, 30, 0.08);
    --shadow-lg: 0 8px 32px rgba(15, 10, 30, 0.12);
  }

  body {
    background-color: var(--color-bg-base);
    font-family: var(--font-body);
    color: var(--color-text-primary);
  }

  /* ==========================================================
     HERO SECTION
     ========================================================== */
  .faq-hero {
    background: var(--gradient-hero-overlay);
    position: relative;
    padding: 90px 0 50px;
    overflow: hidden;
    border-bottom: 1px solid var(--color-border);
    margin-bottom: 32px;
  }

  .faq-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image:
      linear-gradient(rgba(0, 200, 221, 0.05) 1px, transparent 1px),
      linear-gradient(90deg, rgba(0, 200, 221, 0.05) 1px, transparent 1px);
    background-size: 40px 40px;
    pointer-events: none;
  }

  .faq-hero-title {
    font-family: var(--font-display);
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--color-text-primary);
    margin-bottom: 12px;
    letter-spacing: -0.02em;
  }

  .faq-hero-desc {
    color: var(--color-text-secondary);
    font-size: 1.05rem;
    max-width: 650px;
    margin: 0 auto;
    line-height: 1.6;
  }

  /* ==========================================================
     FILTER & SEARCH TOOLBAR
     ========================================================== */
  .faq-controls-card {
    background: var(--color-bg-card);
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    padding: 24px;
    margin-bottom: 28px;
    position: relative;
    z-index: 10;
  }

  .faq-search-wrapper {
    position: relative;
    margin-bottom: 20px;
  }

  .faq-search-input {
    width: 100%;
    padding: 14px 20px 14px 48px;
    background: var(--color-bg-input);
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-pill);
    font-size: 0.95rem;
    color: var(--color-text-primary);
    font-family: var(--font-body);
    transition: all 0.2s ease;
  }

  .faq-search-input:focus {
    outline: none;
    border-color: var(--color-border-focus);
    background: #FFFFFF;
    box-shadow: 0 0 0 4px rgba(0, 200, 221, 0.18);
  }

  .faq-search-icon {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--color-text-muted);
    font-size: 1.1rem;
    pointer-events: none;
  }

  .faq-filter-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    justify-content: center;
  }

  .btn-filter-pill {
    background: #FFFFFF;
    border: 1.5px solid var(--color-border);
    color: var(--color-text-secondary);
    font-family: var(--font-display);
    font-size: 0.85rem;
    font-weight: 600;
    padding: 8px 18px;
    border-radius: var(--radius-pill);
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .btn-filter-pill:hover {
    border-color: var(--color-cyan-500);
    color: var(--color-cyan-600);
    background: rgba(0, 200, 221, 0.05);
  }

  .btn-filter-pill.active {
    background: var(--color-cyan-500);
    border-color: var(--color-cyan-500);
    color: #0A0714;
    box-shadow: var(--color-cyan-glow);
  }

  /* Specific Ormawa Pill Accents */
  .btn-filter-pill[data-filter="isic"].active {
    background: var(--color-magenta-500);
    border-color: var(--color-magenta-500);
    color: #FFFFFF;
    box-shadow: var(--color-magenta-glow);
  }

  /* ==========================================================
     ACCORDION LIST & ITEMS
     ========================================================== */
  .faq-accordion-container {
    margin-top: 30px;
    margin-bottom: 50px;
  }

  .faq-item {
    background: var(--color-bg-card);
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    margin-bottom: 12px;
    overflow: hidden;
    transition: all 0.25s ease;
  }

  .faq-item:hover {
    border-color: var(--color-cyan-500);
    box-shadow: var(--shadow-md);
  }

  .faq-item.active {
    border-color: var(--color-cyan-500);
    background: var(--gradient-card-hover);
    box-shadow: 0 4px 20px rgba(0, 200, 221, 0.12);
  }

  .faq-header-btn {
    width: 100%;
    padding: 18px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    background: transparent;
    border: none;
    text-align: left;
    cursor: pointer;
    text-decoration: none !important;
  }

  .faq-title-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-grow: 1;
  }

  .badge-category {
    font-family: var(--font-display);
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: var(--radius-xs);
    letter-spacing: 0.04em;
    text-transform: uppercase;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .badge-itec {
    background: rgba(0, 200, 221, 0.15);
    color: var(--color-cyan-600);
    border: 1px solid rgba(0, 200, 221, 0.4);
  }

  .badge-isic {
    background: rgba(232, 0, 192, 0.12);
    color: var(--color-magenta-600);
    border: 1px solid rgba(232, 0, 192, 0.35);
  }

  .badge-icom {
    background: rgba(142, 68, 173, 0.12);
    color: #8E44AD;
    border: 1px solid rgba(142, 68, 173, 0.35);
  }

  .badge-laos {
    background: rgba(211, 84, 0, 0.12);
    color: #D35400;
    border: 1px solid rgba(211, 84, 0, 0.35);
  }

  .faq-question-text {
    font-family: var(--font-display);
    font-weight: 600;
    font-size: 1.02rem;
    color: var(--color-text-primary);
    margin: 0;
    line-height: 1.4;
  }

  .faq-chevron {
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: var(--color-bg-input);
    color: var(--color-text-secondary);
    font-size: 0.85rem;
    transition: transform 0.25s ease, background 0.25s ease, color 0.25s ease;
    flex-shrink: 0;
  }

  .faq-item.active .faq-chevron {
    transform: rotate(180deg);
    background: var(--color-cyan-500);
    color: #0A0714;
    box-shadow: 0 0 10px rgba(0, 200, 221, 0.5);
  }

  .faq-body-content {
    padding: 0 24px 20px 24px;
    color: var(--color-text-secondary);
    font-size: 0.95rem;
    line-height: 1.65;
    border-top: 1px dashed rgba(221, 213, 240, 0.6);
    margin-top: 4px;
    padding-top: 14px;
  }

  .faq-body-content ol, .faq-body-content ul {
    margin-bottom: 0;
    padding-left: 20px;
  }

  .faq-body-content li {
    margin-bottom: 4px;
  }

  .faq-empty-state {
    display: none;
    text-align: center;
    padding: 48px 24px;
    background: var(--color-bg-card);
    border: 2px dashed var(--color-border);
    border-radius: var(--radius-lg);
  }

  .faq-empty-state i {
    font-size: 2.5rem;
    color: var(--color-text-muted);
    margin-bottom: 12px;
  }

  /* ==========================================================
     WHATSAPP HELPDESK CARD
     ========================================================== */
  .faq-contact-card {
    background: var(--color-bg-card);
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    padding: 36px 32px;
    margin-bottom: 60px;
    transition: border-color 0.25s ease, box-shadow 0.25s ease;
  }

  .faq-contact-card:hover {
    border-color: var(--color-cyan-500);
    box-shadow: var(--shadow-md);
  }

  .faq-contact-title {
    font-family: var(--font-display);
    font-size: 1.45rem;
    font-weight: 700;
    color: var(--color-text-primary);
    margin-bottom: 8px;
  }

  .faq-contact-subtitle {
    color: var(--color-text-secondary);
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 0;
  }

  .idle-form-group {
    margin-bottom: 18px;
  }

  .idle-form-label {
    font-family: var(--font-display);
    font-weight: 600;
    font-size: 0.88rem;
    color: var(--color-text-primary);
    margin-bottom: 6px;
    display: block;
  }

  .idle-input-control {
    width: 100%;
    background: var(--color-bg-input);
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-sm);
    padding: 12px 16px;
    font-family: var(--font-body);
    font-size: 0.95rem;
    color: var(--color-text-primary);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .idle-input-control:focus {
    outline: none;
    border-color: var(--color-border-focus);
    background: #FFFFFF;
    box-shadow: 0 0 0 3px rgba(0, 200, 221, 0.18);
  }

  .btn-idle-wa {
    background-color: var(--color-cyan-500);
    color: #0A0714;
    font-family: var(--font-display);
    font-weight: 700;
    font-size: 0.95rem;
    padding: 12px 32px;
    border: none;
    border-radius: var(--radius-pill);
    box-shadow: var(--color-cyan-glow);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
  }

  .btn-idle-wa:hover {
    background-color: var(--color-cyan-400);
    box-shadow: 0 0 20px rgba(0, 200, 221, 0.7);
    transform: translateY(-2px);
    color: #0A0714;
    text-decoration: none;
  }

  @media (max-width: 768px) {
    .faq-hero-title {
      font-size: 1.9rem;
    }
    .faq-controls-card {
      padding: 18px;
      margin-top: -20px;
    }
    .faq-header-btn {
      padding: 14px 16px;
    }
    .faq-body-content {
      padding: 0 16px 16px 16px;
    }
  }
</style>
@endsection

@section('content')
<!-- ==============================================================
     HERO BANNER SECTION
     ============================================================== -->
<section class="faq-hero text-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <h1 class="faq-hero-title">Frequently Asked Questions</h1>
        <p class="faq-hero-desc">
          Temukan jawaban lengkap dan panduan resmi seputar kompetisi, syarat pendaftaran, timeline, serta regulasi teknis cabang lomba IDLe 2026.
        </p>
      </div>
    </div>
  </div>
</section>

<div class="container">
  <!-- ==============================================================
       SEARCH & FILTER CONTROLS (BELOW HERO)
       ============================================================== -->
  <div class="faq-controls-card">
    <div class="faq-search-wrapper">
      <i class="fa fa-search faq-search-icon"></i>
      <input type="text" id="faqSearchInput" class="faq-search-input" placeholder="Cari pertanyaan seputar lomba, tema, syarat, timeline, atau aturan...">
    </div>
    
    <div class="faq-filter-pills" id="faqFilterPills">
      <button class="btn-filter-pill active" data-filter="all">Semua Kategori (39)</button>
      <button class="btn-filter-pill" data-filter="itec">ITeC (HIMATIF)</button>
      <button class="btn-filter-pill" data-filter="isic">ISIC (HIMASIF)</button>
      <button class="btn-filter-pill" data-filter="icom">I-COM (HMIF)</button>
      <button class="btn-filter-pill" data-filter="laos">LAOS Arena (UKM LAOS)</button>
    </div>
  </div>

  <!-- ==============================================================
       ACCORDION FAQ LIST
       ============================================================== -->
  <div class="faq-accordion-container" id="faqAccordion">

    <!-- ==========================================
         1. ITeC (HIMATIF) — 11 ITEMS
         ========================================== -->
    <div class="faq-item" data-category="itec">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-itec-1" aria-expanded="false" aria-controls="faq-itec-1">
        <div class="faq-title-wrap">
          <span class="badge-category badge-itec">ITeC</span>
          <h3 class="faq-question-text">ITeC itu apa sih?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-itec-1" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          ITeC (Information Technology Competition) merupakan ajang kompetisi antar mahasiswa aktif tingkat Fakultas Ilmu Komputer Universitas Jember yang diselenggarakan oleh HIMATIF (Himpunan Mahasiswa Teknologi Informasi)
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="itec">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-itec-2" aria-expanded="false" aria-controls="faq-itec-2">
        <div class="faq-title-wrap">
          <span class="badge-category badge-itec">ITeC</span>
          <h3 class="faq-question-text">Kapan pelaksanaan ITeC?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-itec-2" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Pelaksanaan ITeC 2026 akan dibuka pada tanggal 26 September 2026 hingga 18 Oktober 2026
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="itec">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-itec-3" aria-expanded="false" aria-controls="faq-itec-3">
        <div class="faq-title-wrap">
          <span class="badge-category badge-itec">ITeC</span>
          <h3 class="faq-question-text">Di ITeC 2026 ini ada berapa cabang bidang perlombaan?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-itec-3" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          ITeC 2026 ini akan ada 4 cabang bidang lomba, yakni UI/UX Design, IoT, Game Development, dan Animasi
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="itec">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-itec-4" aria-expanded="false" aria-controls="faq-itec-4">
        <div class="faq-title-wrap">
          <span class="badge-category badge-itec">ITeC</span>
          <h3 class="faq-question-text">Bagaimana cara pendaftaran ITeC?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-itec-4" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Pendaftaran dilakukan melalui Website IDLe.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="itec">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-itec-5" aria-expanded="false" aria-controls="faq-itec-5">
        <div class="faq-title-wrap">
          <span class="badge-category badge-itec">ITeC</span>
          <h3 class="faq-question-text">Apakah pendaftarannya dipungut biaya?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-itec-5" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Pendaftaran tidak dipungut biaya apapun.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="itec">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-itec-6" aria-expanded="false" aria-controls="faq-itec-6">
        <div class="faq-title-wrap">
          <span class="badge-category badge-itec">ITeC</span>
          <h3 class="faq-question-text">Apakah perlombaan ini hanya dikhususkan untuk mahasiswa Program Studi Teknologi Informasi saja?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-itec-6" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Tidak, ITeC juga merupakan bagian dari IDLe, yang berarti mahasiswa fakultas ilmu komputer bisa daftar, silahkan lihat guidebook ITeC 2026 bagian ketentuan peserta untuk lebih jelas.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="itec">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-itec-7" aria-expanded="false" aria-controls="faq-itec-7">
        <div class="faq-title-wrap">
          <span class="badge-category badge-itec">ITeC</span>
          <h3 class="faq-question-text">Apakah ada ketentuan tema dalam setiap kategori perlombaan?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-itec-7" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Tidak ada. Pada ITeC 2026, tidak terdapat tema khusus atau subtema pada masing-masing kategori perlombaan. Seluruh kategori mengacu pada tema utama kompetisi, yaitu “Digital Innovation for Smart Society: Empowering Sustainable, Inclusive, and Impactful Technology.” Peserta dapat mengembangkan karya sesuai bidang yang diikuti dengan tetap menyesuaikannya dengan tema utama tersebut. Untuk ketentuan lebih lanjut terkait masing-masing bidang perlombaan, dapat dilihat pada guidebook ITeC 2026.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="itec">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-itec-8" aria-expanded="false" aria-controls="faq-itec-8">
        <div class="faq-title-wrap">
          <span class="badge-category badge-itec">ITeC</span>
          <h3 class="faq-question-text">Apa hubungannya ITeC dengan GEMASTIK?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-itec-8" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          GEMASTIK merupakan lomba tingkat nasional, terdapat sub lomba yang merupakan inspirasi dari lomba ITeC. Adanya acara ITeC juga merupakan ajang dalam mempersiapkan mahasiswa mengikuti GEMASTIK.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="itec">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-itec-9" aria-expanded="false" aria-controls="faq-itec-9">
        <div class="faq-title-wrap">
          <span class="badge-category badge-itec">ITeC</span>
          <h3 class="faq-question-text">Apakah disediakan template untuk penyusunan proposal?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-itec-9" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Iya, template disediakan oleh panitia.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="itec">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-itec-10" aria-expanded="false" aria-controls="faq-itec-10">
        <div class="faq-title-wrap">
          <span class="badge-category badge-itec">ITeC</span>
          <h3 class="faq-question-text">Dalam satu tim terdiri dari berapa orang?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-itec-10" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Setiap tim terdiri maksimal 3 orang mahasiswa dan salah satu mahasiswa bertindak sebagai ketua tim.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="itec">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-itec-11" aria-expanded="false" aria-controls="faq-itec-11">
        <div class="faq-title-wrap">
          <span class="badge-category badge-itec">ITeC</span>
          <h3 class="faq-question-text">Apakah peserta hanya diperbolehkan mengikuti satu bidang perlombaan saja?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-itec-11" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Peserta diperbolehkan mengikuti maksimal 2 kategori lomba yang berbeda, tetapi hanya diperkenankan menjadi salah satu ketua tim dari kategori lomba yang diikuti.
        </div>
      </div>
    </div>

    <!-- ==========================================
         2. ISIC (HIMASIF) — 12 ITEMS
         ========================================== -->
    <div class="faq-item" data-category="isic">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-isic-1" aria-expanded="false" aria-controls="faq-isic-1">
        <div class="faq-title-wrap">
          <span class="badge-category badge-isic">ISIC</span>
          <h3 class="faq-question-text">Apa itu kegiatan ISIC?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-isic-1" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Information System Ideas Competition atau yang biasa dikenal sebagai ISIC merupakan kompetisi bidang IT tingkat fakultas yang dapat diikuti oleh seluruh mahasiswa aktif Fakultas Ilmu Komputer Universitas Jember dan diadakan oleh HIMASIF
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="isic">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-isic-2" aria-expanded="false" aria-controls="faq-isic-2">
        <div class="faq-title-wrap">
          <span class="badge-category badge-isic">ISIC</span>
          <h3 class="faq-question-text">Apa tujuan dilaksanakannya kegiatan ISIC 2026?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-isic-2" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Kegiatan ISIC bertujuan sebagai wadah bagi mahasiswa Fakultas Ilmu Komputer Universitas Jember untuk mengembangkan ide dan gagasan mereka dan dapat mengimplementasikannya agar dapat membantu masalah yang ada di lingkungan sekitar serta dapat mempersiapkan mereka ke ajang perlombaan yang lebih besar seperti GEMASTIK.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="isic">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-isic-3" aria-expanded="false" aria-controls="faq-isic-3">
        <div class="faq-title-wrap">
          <span class="badge-category badge-isic">ISIC</span>
          <h3 class="faq-question-text">Apakah ada Tema Khusus dalam Perlombaan ISIC 2026 ini?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-isic-3" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Tema dalam perlombaan ISIC 2026 kali ini yaitu “Dygital Sinergy: Shaping Real Solutions”. Untuk selengkapnya bisa di cek di rulebook ataupun instagram.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="isic">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-isic-4" aria-expanded="false" aria-controls="faq-isic-4">
        <div class="faq-title-wrap">
          <span class="badge-category badge-isic">ISIC</span>
          <h3 class="faq-question-text">Berapa cabang bidang lomba yang ada di ISIC 2026?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-isic-4" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          ISIC sendiri memiliki 3 cabang bidang lomba, yaitu Software Development, Smart City, dan Business Development.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="isic">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-isic-5" aria-expanded="false" aria-controls="faq-isic-5">
        <div class="faq-title-wrap">
          <span class="badge-category badge-isic">ISIC</span>
          <h3 class="faq-question-text">Apa saja sih syarat umum mengikuti ISIC 2026?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-isic-5" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Mahasiswa aktif Fakultas Ilmu Komputer Universitas Jember, tim maksimum 3 peserta (ketua dan anggota), peserta diperbolehkan dari berbagai Angkatan aktif dan program studi, karya yang diperlombakan pada ISIC 2026 tidak diperkenankan mengandung unsur SARA, radikalisme, asusila, dan plagiarisme, serta Ide atau judul lomba yang diajukan hanya berlaku untuk satu bidang perlombaan ISIC dan ide yang diajukan wajib ide baru, dilarang menggunakan ide yang sudah dimenangkan di lomba lain.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="isic">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-isic-6" aria-expanded="false" aria-controls="faq-isic-6">
        <div class="faq-title-wrap">
          <span class="badge-category badge-isic">ISIC</span>
          <h3 class="faq-question-text">Ada berapa tahap perlombaan sih di ISIC 2026?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-isic-6" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          ISIC 2026 memiliki 2 tahapan perlombaan, yaitu Tahap 1/penyisihan yang terdiri dari pengumpulan Proposal dan Poster dan Tahap 2/Final yang terdiri dari pengumpulan PPT Final dan Presentasi Final.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="isic">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-isic-7" aria-expanded="false" aria-controls="faq-isic-7">
        <div class="faq-title-wrap">
          <span class="badge-category badge-isic">ISIC</span>
          <h3 class="faq-question-text">Kapan waktu pelaksanaan ISIC 2026 dan tahap-tahapannya?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-isic-7" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          ISIC 2026 akan dibuka pada tanggal 26 September 2026 sekaligus bersamaan dengan pendaftaran Tim serta Pengumpulan Proposal dan Poster. Tahap 1/Penyisihan berlangsung mulai 26 September - 6 Oktober 2025. Untuk Tahap 2/Final berlangsung mulai 12 - 17 Oktober 2025 untuk pengumpulan PPT Final dan 18 Oktober 2025 untuk Presentasi Final.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="isic">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-isic-8" aria-expanded="false" aria-controls="faq-isic-8">
        <div class="faq-title-wrap">
          <span class="badge-category badge-isic">ISIC</span>
          <h3 class="faq-question-text">Bagaimana Cara Mendaftar ISIC 2026</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-isic-8" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Pendaftaran dilakukan melalui website IDLe.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="isic">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-isic-9" aria-expanded="false" aria-controls="faq-isic-9">
        <div class="faq-title-wrap">
          <span class="badge-category badge-isic">ISIC</span>
          <h3 class="faq-question-text">Apakah pendafatarn ISIC 2026 dipungut Biaya</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-isic-9" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Tidak, pendafatarn ISIC 2026 tidak dipungut biaya apapun.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="isic">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-isic-10" aria-expanded="false" aria-controls="faq-isic-10">
        <div class="faq-title-wrap">
          <span class="badge-category badge-isic">ISIC</span>
          <h3 class="faq-question-text">Apa Hubunganya ISIC dengan GEMASTIK?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-isic-10" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Gemastik merupakan lomba tingkat nasional, terdapat sub lomba yang merupakan inspirasi dari lomba ISIC. Adanya acara ISIC juga merupakan ajang dalam mempersiapkan mahasiswa mengikuti gemastik.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="isic">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-isic-11" aria-expanded="false" aria-controls="faq-isic-11">
        <div class="faq-title-wrap">
          <span class="badge-category badge-isic">ISIC</span>
          <h3 class="faq-question-text">Apakah Tamplate Proposal sudah disediakan dan Kapan dibagikan?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-isic-11" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Sudah, template akan disediakan oleh panitia dan untuk pembagian template sesuai dengan jadwal di website.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="isic">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-isic-12" aria-expanded="false" aria-controls="faq-isic-12">
        <div class="faq-title-wrap">
          <span class="badge-category badge-isic">ISIC</span>
          <h3 class="faq-question-text">Apa saja sih benefit mengikuti kegiatan ISIC 2026?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-isic-12" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Benefit yang bisa kalian dapatkan dari mengikuti kegiatan ISIC 2026 adalah seluruh peserta ISIC 2026 akan mendapatkan e-sertifikat lomba dan bagi pemenang lomba ISIC 2026 juara 1, 2 dan 3 akan mendapatkan penghargaan berupa sertifikat, trophy, dan pembinaan untuk kompetisi GEMASTIK.
        </div>
      </div>
    </div>

    <!-- ==========================================
         3. I-COM (HMIF) — 5 ITEMS
         ========================================== -->
    <div class="faq-item" data-category="icom">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-icom-1" aria-expanded="false" aria-controls="faq-icom-1">
        <div class="faq-title-wrap">
          <span class="badge-category badge-icom">I-COM</span>
          <h3 class="faq-question-text">ICom: Bagaimana cara untuk berpartisipasi dalam I-COM 2026?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-icom-1" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Cara berpartisipasi dapat diakses di website IDLe atau klik tautan berikut (link pendaftaran website idle).
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="icom">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-icom-2" aria-expanded="false" aria-controls="faq-icom-2">
        <div class="faq-title-wrap">
          <span class="badge-category badge-icom">I-COM</span>
          <h3 class="faq-question-text">ICom: Apa saja persyaratan untuk berpartisipasi dalam I-COM 2026?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-icom-2" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          <ol>
            <li>Merupakan mahasiswa aktif Fakultas Ilmu Komputer Universitas Jember.</li>
            <li>Peserta wajib mengikuti seluruh jadwal dan aturan ketentuan yang berlaku.</li>
            <li>Setiap 1 tim peserta terdiri dari maksimum 3 orang mahasiswa.</li>
            <li>Pendaftaran peserta dan keikutsertaan peserta tidak dipungut biaya.</li>
            <li>Peserta yang lolos sebagai finalis lomba wajib mengikuti kegiatan final lomba.</li>
          </ol>
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="icom">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-icom-3" aria-expanded="false" aria-controls="faq-icom-3">
        <div class="faq-title-wrap">
          <span class="badge-category badge-icom">I-COM</span>
          <h3 class="faq-question-text">ICom: Apakah ada tema khusus dalam perlombaan I-COM 2026 ini?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-icom-3" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          ICOM 2026 ini memiliki tema “Optimalisasi Peran Generasi Muda Berbasis Inovasi Agroindustri dan Teknologi Digital Menuju Indonesia Emas 2045”
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="icom">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-icom-4" aria-expanded="false" aria-controls="faq-icom-4">
        <div class="faq-title-wrap">
          <span class="badge-category badge-icom">I-COM</span>
          <h3 class="faq-question-text">ICom: Apakah peserta diperbolehkan mengikuti lebih dari 1 cabang/divisi perlombaan?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-icom-4" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Peserta Tidak diperbolehkan mengikuti lebih dari 1 cabang/divisi lomba yang berbeda.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="icom">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-icom-5" aria-expanded="false" aria-controls="faq-icom-5">
        <div class="faq-title-wrap">
          <span class="badge-category badge-icom">I-COM</span>
          <h3 class="faq-question-text">ICom: Kapan pelaksanaan I-COM 2026?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-icom-5" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          ICOM 2026 dilaksanakan mulai tanggal 26 september - 15 oktober 2026. Selengkapnya bisa dilihat di Rulebook.
        </div>
      </div>
    </div>

    <!-- ==========================================
         4. LAOS ARENA (UKM LAOS) — 11 ITEMS
         ========================================== -->
    <div class="faq-item" data-category="laos">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-laos-1" aria-expanded="false" aria-controls="faq-laos-1">
        <div class="faq-title-wrap">
          <span class="badge-category badge-laos">LAOS Arena</span>
          <h3 class="faq-question-text">LAOS Arena itu apa sih?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-laos-1" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          LAOS Arena adalah salah satu program kerja UKM LAOS (Linux and Open Source) yang mengadakan kompetisi Capture the Flag (CTF) di tingkat fakultas. LAOS Arena merupakan bentuk persiapan dalam menjaring dan menampung mahasiswa Fakultas Ilmu Komputer Universitas Jember yang memiliki bakat dan minat di bidang Capture the Flag (CTF) sehingga nantinya Mahasiswa Fakultas Ilmu Komputer bisa mendapat pembinaan lebih lanjut di pelatihan CTF UKM LAOS untuk mengikuti berbagai kompetisi di ajang nasional maupun internasional. Kompetisi ini memiliki mekanisme dimana setiap peserta diminta untuk mengumpulkan "bendera" atau "flag" sebanyak-banyaknya dari soal-soal berkaitan dengan keamanan yang telah diberikan.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="laos">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-laos-2" aria-expanded="false" aria-controls="faq-laos-2">
        <div class="faq-title-wrap">
          <span class="badge-category badge-laos">LAOS Arena</span>
          <h3 class="faq-question-text">Butuh berapa orang untuk satu tim?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-laos-2" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Untuk setiap tim bisa 1 hingga 3 orang
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="laos">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-laos-3" aria-expanded="false" aria-controls="faq-laos-3">
        <div class="faq-title-wrap">
          <span class="badge-category badge-laos">LAOS Arena</span>
          <h3 class="faq-question-text">Kapan pelaksanaan LAOS Arena?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-laos-3" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Pembukaan LAOS Arena dilaksanakan pada 26 September dan penutupan pada 25 Oktober 2025.
          <ul>
            <li><strong>Pendaftaran:</strong> 26 September - 8 Oktober 2025</li>
            <li><strong>Babak Qualification:</strong> 11 Oktober 2025</li>
            <li><strong>Babak Final:</strong> 18 Oktober 2025</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="laos">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-laos-4" aria-expanded="false" aria-controls="faq-laos-4">
        <div class="faq-title-wrap">
          <span class="badge-category badge-laos">LAOS Arena</span>
          <h3 class="faq-question-text">Apakah semua angkatan bisa mendaftar?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-laos-4" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Tidak, yang hanya bisa mendaftar hanya angkatan 22 sampai 26 saja
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="laos">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-laos-5" aria-expanded="false" aria-controls="faq-laos-5">
        <div class="faq-title-wrap">
          <span class="badge-category badge-laos">LAOS Arena</span>
          <h3 class="faq-question-text">Untuk peraturan apa saja?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-laos-5" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          <ol>
            <li>Dilarang melakukan kecurangan saat lomba berlangsung</li>
            <li>Dilarang melakukan DDoS server LAOS Arena</li>
            <li>Dilarang memakai pihak ketiga di saat perlombaan berlangsung</li>
          </ol>
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="laos">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-laos-6" aria-expanded="false" aria-controls="faq-laos-6">
        <div class="faq-title-wrap">
          <span class="badge-category badge-laos">LAOS Arena</span>
          <h3 class="faq-question-text">Bagaimana cara untuk mengikuti lomba?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-laos-6" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Untuk mengikuti kalian dapat mendaftar di website Idle. Selengkapnya bisa dilihat di Rulebook.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="laos">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-laos-7" aria-expanded="false" aria-controls="faq-laos-7">
        <div class="faq-title-wrap">
          <span class="badge-category badge-laos">LAOS Arena</span>
          <h3 class="faq-question-text">Bagaimana jika ada salah satu anggota yang berhalangan hadir saat final?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-laos-7" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Kami menyarankan seluruh anggota tim hadir. Namun apabila terdapat kendala yang sangat mendesak seperti sakit parah, berduka, atau memiliki surat perizinan lainnya, babak final wajib dihadiri minimal 1 (satu) orang yang merupakan anggota resmi dari tim tersebut dan tidak boleh diwakilkan oleh tim lain.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="laos">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-laos-8" aria-expanded="false" aria-controls="faq-laos-8">
        <div class="faq-title-wrap">
          <span class="badge-category badge-laos">LAOS Arena</span>
          <h3 class="faq-question-text">Kategori soal apa saja yang tersedia pada LAOS Arena?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-laos-8" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          LAOS Arena menyediakan challenge pada kategori Binary Exploitation (PWN), Web Exploitation, Cryptography, Digital Forensics, Reverse Engineering, OSINT, dan Miscellaneous.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="laos">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-laos-9" aria-expanded="false" aria-controls="faq-laos-9">
        <div class="faq-title-wrap">
          <span class="badge-category badge-laos">LAOS Arena</span>
          <h3 class="faq-question-text">Bagaimana jika peserta terlambat mengumpulkan write-up?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-laos-9" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Tidak ada toleransi terhadap keterlambatan pengumpulan write-up. Seluruh peserta wajib mengumpulkan write-up sesuai batas waktu yang telah ditentukan oleh panitia LAOS Arena.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="laos">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-laos-10" aria-expanded="false" aria-controls="faq-laos-10">
        <div class="faq-title-wrap">
          <span class="badge-category badge-laos">LAOS Arena</span>
          <h3 class="faq-question-text">Format apa yang akan digunakan oleh LAOS Arena?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-laos-10" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Seluruh rangkaian LAOS Arena mulai dari babak penyisihan hingga babak final akan menggunakan format Jeopardy dengan sistem dynamic scoring.
        </div>
      </div>
    </div>

    <div class="faq-item" data-category="laos">
      <button class="faq-header-btn" type="button" data-toggle="collapse" data-target="#faq-laos-11" aria-expanded="false" aria-controls="faq-laos-11">
        <div class="faq-title-wrap">
          <span class="badge-category badge-laos">LAOS Arena</span>
          <h3 class="faq-question-text">Apakah AI boleh digunakan selama kompetisi?</h3>
        </div>
        <div class="faq-chevron"><i class="fa fa-chevron-down"></i></div>
      </button>
      <div id="faq-laos-11" class="collapse" data-parent="#faqAccordion">
        <div class="faq-body-content">
          Baik pada babak qualification maupun babak final LAOS Arena, peserta hanya diperbolehkan menggunakan AI berbasis chat interface pada layanan free tier sebagai alat brainstorming, referensi, atau analisis. Penggunaan AI Agent, AI CLI, maupun sistem AI yang menyelesaikan challenge secara mandiri tidak diperbolehkan.
        </div>
      </div>
    </div>

    <!-- Empty State for Search Filter -->
    <div class="faq-empty-state" id="faqEmptyState">
      <i class="fa fa-search"></i>
      <h4 style="font-family: var(--font-display); font-weight: 700; color: var(--color-text-primary); margin-bottom: 8px;">Pertanyaan Tidak Ditemukan</h4>
      <p style="color: var(--color-text-secondary); margin: 0;">Maaf, tidak ada pertanyaan yang cocok dengan kata kunci pencarian Anda. Silakan gunakan kata kunci lain atau ajukan pertanyaan melalui formulir WhatsApp di bawah.</p>
    </div>

  </div>

  <!-- ==============================================================
       WHATSAPP HELPDESK FORM
       ============================================================== -->
  <div class="faq-contact-card" id="tanya">
    <div class="row align-items-center">
      <div class="col-lg-5 mb-4 mb-lg-0">
        <h2 class="faq-contact-title">Masih Punya Pertanyaan?</h2>
        <p class="faq-contact-subtitle">
          Jika informasi yang Anda butuhkan belum terjawab pada FAQ di atas, silakan hubungi panitia cabang lomba terkait secara langsung melalui WhatsApp.
        </p>
      </div>

      <div class="col-lg-7">
        <form action="{{ route('faq.ask') }}" method="POST" autocomplete="off" target="_blank">
          @csrf
          <div class="idle-form-group">
            <label class="idle-form-label">Nama Tim</label>
            <input class="idle-input-control" type="text" name="nama_tim" required placeholder="Masukkan nama tim Anda...">
          </div>

          <div class="idle-form-group">
            <label class="idle-form-label">Bidang Lomba</label>
            <select class="idle-input-control" name="kategori" required>
              <option value="" disabled selected>-- Pilih Bidang Lomba --</option>
              <option value="UI/UX">UI/UX</option>
              <option value="IoT">IoT</option>
              <option value="Game Dev">Game Dev</option>
              <option value="Animasi">Animasi</option>
              <option value="Software Dev">Software Dev</option>
              <option value="Smart City">Smart City</option>
              <option value="Business Dev">Business Dev</option>
              <option value="CPC">CPC</option>
              <option value="KTI">KTI</option>
              <option value="CTF">CTF</option>
            </select>
          </div>

          <div class="idle-form-group">
            <label class="idle-form-label">Isi Pesan Pertanyaan</label>
            <textarea class="idle-input-control" name="pesan" rows="3" required placeholder="Tuliskan pertanyaan Anda secara detail di sini..."></textarea>
          </div>

          <div class="text-right mt-3">
            <button class="btn-idle-wa" type="submit">
              Kirim
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection

@section('js')
<script>
  $(document).ready(function() {
    // 1. Accordion Active State Toggle
    $('#faqAccordion').on('show.bs.collapse', function (e) {
      $(e.target).closest('.faq-item').addClass('active');
    });

    $('#faqAccordion').on('hide.bs.collapse', function (e) {
      $(e.target).closest('.faq-item').removeClass('active');
    });

    // 2. Filter Pills Click
    $('.btn-filter-pill').on('click', function() {
      $('.btn-filter-pill').removeClass('active');
      $(this).addClass('active');
      applyFilters();
    });

    // 3. Search Input Live Filter
    $('#faqSearchInput').on('keyup', function() {
      applyFilters();
    });

    // Combined Filter & Search Function
    function applyFilters() {
      var selectedCategory = $('.btn-filter-pill.active').data('filter');
      var searchQuery = $('#faqSearchInput').val().toLowerCase().trim();
      var visibleCount = 0;

      $('.faq-item').each(function() {
        var itemCategory = $(this).data('category');
        var questionText = $(this).find('.faq-question-text').text().toLowerCase();
        var answerText = $(this).find('.faq-body-content').text().toLowerCase();

        var matchCategory = (selectedCategory === 'all' || itemCategory === selectedCategory);
        var matchSearch = (searchQuery === '' || questionText.indexOf(searchQuery) !== -1 || answerText.indexOf(searchQuery) !== -1);

        if (matchCategory && matchSearch) {
          $(this).show();
          visibleCount++;
        } else {
          $(this).hide();
          // Collapse if hidden
          $(this).find('.collapse').collapse('hide');
        }
      });

      if (visibleCount === 0) {
        $('#faqEmptyState').show();
      } else {
        $('#faqEmptyState').hide();
      }
    }
  });
</script>
@endsection
