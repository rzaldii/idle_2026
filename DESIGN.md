# DESIGN.md — IDLE 2026 Website Design System

> **Inspirasi visual:** Tema _retro arcade gaming_ dengan mesin arcade, neon glow, grid synthwave, dan estetika sci-fi futuristik. Website tetap menggunakan **light mode** sebagai base, dengan neon accent sebagai kontras visual yang kuat.

---

## 1. Color Palette

### 1.1 Base / Background Colors

| Token                    | Hex       | HSL                   | Penggunaan                                    |
| ------------------------ | --------- | --------------------- | --------------------------------------------- |
| `--color-bg-base`        | `#F8F5FF` | `hsl(258, 100%, 98%)` | Background halaman utama (body)               |
| `--color-bg-section-alt` | `#F0ECF8` | `hsl(258, 33%, 95%)`  | Background section alternating (zebra stripe) |
| `--color-bg-card`        | `#FFFFFF` | `hsl(0, 0%, 100%)`    | Background card                               |
| `--color-bg-input`       | `#F5F3FF` | `hsl(252, 100%, 97%)` | Background input field                        |

### 1.2 Primary Accent — Cyan (Action)

| Token               | Hex                      | HSL                   | Penggunaan                           |
| ------------------- | ------------------------ | --------------------- | ------------------------------------ |
| `--color-cyan-400`  | `#22DDEE`                | `hsl(185, 83%, 53%)`  | Hover state, icon fill               |
| `--color-cyan-500`  | `#00C8DD`                | `hsl(185, 100%, 43%)` | **Primary CTA button, link aktif**   |
| `--color-cyan-600`  | `#00A8BB`                | `hsl(186, 100%, 37%)` | Button pressed state, teks cyan      |
| `--color-cyan-glow` | `rgba(0, 200, 221, 0.4)` | —                     | Neon glow shadow pada button/heading |

### 1.3 Secondary Accent — Magenta (Highlight)

| Token                  | Hex                       | HSL                   | Penggunaan                             |
| ---------------------- | ------------------------- | --------------------- | -------------------------------------- |
| `--color-magenta-400`  | `#FF3FD8`                 | `hsl(312, 100%, 62%)` | Badge hover, icon highlight            |
| `--color-magenta-500`  | `#E800C0`                 | `hsl(312, 100%, 46%)` | **Badge, tag kategori, label penting** |
| `--color-magenta-600`  | `#C200A0`                 | `hsl(312, 100%, 38%)` | Badge pressed/dark state               |
| `--color-magenta-glow` | `rgba(232, 0, 192, 0.35)` | —                     | Neon glow shadow pada badge/label      |

### 1.4 Neutral / Text Colors

| Token                    | Hex       | Penggunaan                                        |
| ------------------------ | --------- | ------------------------------------------------- |
| `--color-text-primary`   | `#0F0A1E` | Teks utama (heading, body)                        |
| `--color-text-secondary` | `#4A3F6B` | Teks sekunder, caption                            |
| `--color-text-muted`     | `#8A7DA8` | Placeholder, teks disabled                        |
| `--color-text-on-dark`   | `#F0EEFF` | Teks di atas background gelap (footer, card dark) |
| `--color-border`         | `#DDD5F0` | Border card, input, divider                       |
| `--color-border-focus`   | `#00C8DD` | Border saat input/card dalam fokus                |

### 1.5 Footer / Dark Surface Colors

| Token                  | Hex       | Penggunaan             |
| ---------------------- | --------- | ---------------------- |
| `--color-dark-bg`      | `#0A0714` | Footer background      |
| `--color-dark-surface` | `#150E2A` | Footer card/panel      |
| `--color-dark-border`  | `#2A1F4A` | Border internal footer |

### 1.6 Gradient Tokens

```css
--gradient-neon-primary: linear-gradient(135deg, #00c8dd 0%, #e800c0 100%);
--gradient-neon-subtle: linear-gradient(135deg, #22ddee22 0%, #ff3fd822 100%);
--gradient-hero-overlay: linear-gradient(
    180deg,
    #f8f5ff 0%,
    #ede8ff 60%,
    #f8f5ff 100%
);
--gradient-footer-top: linear-gradient(90deg, #00c8dd 0%, #e800c0 100%);
--gradient-card-hover: linear-gradient(
    135deg,
    rgba(0, 200, 221, 0.08) 0%,
    rgba(232, 0, 192, 0.08) 100%
);
```

---

## 2. Typography

### 2.1 Font Families

| Peran                 | Font           | Google Fonts Import                  |
| --------------------- | -------------- | ------------------------------------ |
| **Display / Heading** | Space Grotesk  | `Space+Grotesk:wght@400;500;600;700` |
| **Body / UI**         | Inter          | `Inter:wght@300;400;500;600`         |
| **Monospace / Code**  | JetBrains Mono | `JetBrains+Mono:wght@400;700`        |

```html
<!-- Tambahkan di <head> layout -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;700&display=swap"
    rel="stylesheet"
/>
```

### 2.2 Type Scale

| Token            | Size              | Weight | Line Height | Penggunaan                    |
| ---------------- | ----------------- | ------ | ----------- | ----------------------------- |
| `--text-display` | `3rem / 48px`     | 700    | 1.1         | Hero heading utama            |
| `--text-h1`      | `2.25rem / 36px`  | 700    | 1.2         | Judul halaman                 |
| `--text-h2`      | `1.75rem / 28px`  | 600    | 1.25        | Judul section                 |
| `--text-h3`      | `1.375rem / 22px` | 600    | 1.3         | Sub-section, card title       |
| `--text-h4`      | `1.125rem / 18px` | 500    | 1.4         | Label group, accordion header |
| `--text-body-lg` | `1rem / 16px`     | 400    | 1.6         | Paragraf utama                |
| `--text-body`    | `0.9rem / 14.4px` | 400    | 1.6         | Paragraf biasa                |
| `--text-sm`      | `0.8rem / 12.8px` | 400    | 1.5         | Caption, helper text          |
| `--text-xs`      | `0.7rem / 11.2px` | 500    | 1.4         | Badge, label kecil            |

```css
/* CSS Variables */
--font-display: "Space Grotesk", sans-serif;
--font-body: "Inter", sans-serif;
--font-mono: "JetBrains Mono", monospace;
```

> **Aturan:** Semua `h1`-`h4` dan teks heading **wajib** menggunakan `--font-display`. Semua teks paragraf, form, navigasi, dan label UI menggunakan `--font-body`.

---

## 3. Border Radius Scale

| Token           | Value    | Penggunaan                          |
| --------------- | -------- | ----------------------------------- |
| `--radius-xs`   | `4px`    | Badge kecil, chip, tag              |
| `--radius-sm`   | `8px`    | Input field, dropdown item          |
| `--radius-md`   | `12px`   | Card, panel                         |
| `--radius-lg`   | `16px`   | Modal, popover, card besar          |
| `--radius-xl`   | `20px`   | Section/container dengan background |
| `--radius-pill` | `9999px` | Button pill, pagination aktif       |
| `--radius-full` | `50%`    | Avatar, icon circle                 |

> **Aturan:** Button CTA utama menggunakan `--radius-pill`. Card standar menggunakan `--radius-md`. Modal menggunakan `--radius-lg`.

---

## 4. Spacing Scale

Berbasis kelipatan **4px**:

| Token        | Value  | Penggunaan                       |
| ------------ | ------ | -------------------------------- |
| `--space-1`  | `4px`  | Padding micro (icon gap)         |
| `--space-2`  | `8px`  | Padding badge, gap elemen kecil  |
| `--space-3`  | `12px` | Padding button kompak            |
| `--space-4`  | `16px` | Padding button standar, gap card |
| `--space-5`  | `20px` | Padding input                    |
| `--space-6`  | `24px` | Padding card                     |
| `--space-8`  | `32px` | Padding section kecil            |
| `--space-10` | `40px` | Gap antar card di grid           |
| `--space-12` | `48px` | Padding section sedang           |
| `--space-16` | `64px` | Padding section besar            |
| `--space-20` | `80px` | Padding hero                     |

---

## 5. Shadow & Glow System

```css
/* Standar shadow (light mode) */
--shadow-xs: 0 1px 3px rgba(15, 10, 30, 0.08);
--shadow-sm: 0 2px 8px rgba(15, 10, 30, 0.1);
--shadow-md: 0 4px 16px rgba(15, 10, 30, 0.12);
--shadow-lg: 0 8px 32px rgba(15, 10, 30, 0.16);

/* Neon glow shadows */
--glow-cyan: 0 0 12px rgba(0, 200, 221, 0.5), 0 0 32px rgba(0, 200, 221, 0.25);
--glow-cyan-strong:
    0 0 20px rgba(0, 200, 221, 0.7), 0 0 60px rgba(0, 200, 221, 0.35);
--glow-magenta:
    0 0 12px rgba(232, 0, 192, 0.5), 0 0 32px rgba(232, 0, 192, 0.25);
--glow-magenta-strong:
    0 0 20px rgba(232, 0, 192, 0.7), 0 0 60px rgba(232, 0, 192, 0.35);
--glow-dual: 0 0 16px rgba(0, 200, 221, 0.4), 0 0 16px rgba(232, 0, 192, 0.4);
```

> **Aturan:** Gunakan `--glow-*` **hanya pada hover state** atau elemen yang ingin ditonjolkan. Jangan gunakan glow pada seluruh page untuk menghindari visual yang terlalu berat.

---

## 6. Component Specifications

### 6.1 Navbar

- **Style:** Glassmorphism — `backdrop-filter: blur(16px)`, background `rgba(248, 245, 255, 0.75)`
- **Position:** `fixed-top`, shrink on scroll (padding berkurang)
- **Border bottom:** `1px solid rgba(221, 213, 240, 0.5)`
- **Logo:** Logo IDLe 2026, height `44px`
- **Nav links:** Font `--font-body`, `font-weight: 500`, `font-size: 0.9rem`, warna `--color-text-secondary`
- **Active/Hover link:** Warna `--color-cyan-500`, underline animasi slide dari kiri
- **Dropdown:** Background `rgba(255,255,255,0.95)`, `border-radius: --radius-md`, `box-shadow: --shadow-md`
- **CTA button di navbar (jika ada):** Solid cyan dengan glow, `--radius-pill`

```css
.navbar {
    background: rgba(248, 245, 255, 0.75);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(221, 213, 240, 0.5);
    transition:
        padding 0.3s ease,
        background 0.3s ease;
}
.navbar.scrolled {
    background: rgba(248, 245, 255, 0.92);
    padding-top: 8px;
    padding-bottom: 8px;
}
```

---

### 6.2 Buttons

#### Button Primary (Solid Cyan + Neon Glow)

```css
.btn-idle-primary {
    background-color: var(--color-cyan-500);
    color: #0a0714;
    font-family: var(--font-display);
    font-weight: 600;
    font-size: 0.95rem;
    padding: 12px 28px;
    border: none;
    border-radius: var(--radius-pill);
    box-shadow: var(--glow-cyan);
    cursor: pointer;
    transition:
        background 0.2s ease,
        box-shadow 0.2s ease,
        transform 0.15s ease;
}
.btn-idle-primary:hover {
    background-color: var(--color-cyan-400);
    box-shadow: var(--glow-cyan-strong);
    transform: translateY(-2px);
}
.btn-idle-primary:active {
    background-color: var(--color-cyan-600);
    transform: translateY(0px);
    box-shadow: var(--glow-cyan);
}
```

#### Button Secondary (Solid Magenta + Neon Glow)

```css
.btn-idle-secondary {
    background-color: var(--color-magenta-500);
    color: #ffffff;
    font-family: var(--font-display);
    font-weight: 600;
    font-size: 0.95rem;
    padding: 12px 28px;
    border: none;
    border-radius: var(--radius-pill);
    box-shadow: var(--glow-magenta);
    cursor: pointer;
    transition:
        background 0.2s ease,
        box-shadow 0.2s ease,
        transform 0.15s ease;
}
.btn-idle-secondary:hover {
    box-shadow: var(--glow-magenta-strong);
    transform: translateY(-2px);
}
```

#### Button Outline (Ghost / Neon Border)

```css
.btn-idle-outline {
    background: transparent;
    color: var(--color-cyan-500);
    border: 2px solid var(--color-cyan-500);
    border-radius: var(--radius-pill);
    font-family: var(--font-display);
    font-weight: 600;
    padding: 10px 26px;
    transition: all 0.2s ease;
}
.btn-idle-outline:hover {
    background: var(--color-cyan-500);
    color: #0a0714;
    box-shadow: var(--glow-cyan);
}
```

---

### 6.3 Cards

#### Card Kompetisi (Retro Corner + Hover Glow)

```css
.card-kompetisi {
    background: #ffffff;
    border: 2px solid var(--color-border);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        border-color 0.25s ease,
        background 0.25s ease;
    position: relative;
}

/* Retro pixel corner decorations */
.card-kompetisi::before,
.card-kompetisi::after {
    content: "";
    position: absolute;
    width: 12px;
    height: 12px;
    border-color: var(--color-cyan-500);
    border-style: solid;
    opacity: 0;
    transition: opacity 0.25s ease;
}
.card-kompetisi::before {
    top: 6px;
    left: 6px;
    border-width: 2px 0 0 2px;
}
.card-kompetisi::after {
    bottom: 6px;
    right: 6px;
    border-width: 0 2px 2px 0;
}

.card-kompetisi:hover {
    transform: translateY(-6px);
    border-color: var(--color-cyan-500);
    box-shadow: var(--shadow-md), var(--glow-cyan);
    background: var(--gradient-card-hover);
}
.card-kompetisi:hover::before,
.card-kompetisi:hover::after {
    opacity: 1;
}
```

#### Card Berita

```css
.card-berita {
    background: #ffffff;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-md);
    border-top: 3px solid transparent;
    border-image: var(--gradient-neon-primary) 1;
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease;
}
.card-berita:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}
```

---

### 6.4 Badge / Tag Kategori

```css
.badge-idle {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: var(--radius-xs);
    font-family: var(--font-body);
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.badge-idle-cyan {
    background: rgba(0, 200, 221, 0.15);
    color: var(--color-cyan-600);
    border: 1px solid rgba(0, 200, 221, 0.4);
}
.badge-idle-magenta {
    background: rgba(232, 0, 192, 0.12);
    color: var(--color-magenta-600);
    border: 1px solid rgba(232, 0, 192, 0.35);
    box-shadow: var(--glow-magenta);
}
```

---

### 6.5 Form / Input

```css
.idle-input {
    background: var(--color-bg-input);
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-sm);
    padding: 12px 16px;
    font-family: var(--font-body);
    font-size: 1rem;
    color: var(--color-text-primary);
    width: 100%;
    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease;
}
.idle-input:focus {
    outline: none;
    border-color: var(--color-border-focus);
    box-shadow: 0 0 0 3px rgba(0, 200, 221, 0.18);
}
.idle-input::placeholder {
    color: var(--color-text-muted);
}
```

---

### 6.6 Section Hero

- **Background:** `--gradient-hero-overlay` dengan subtle **grid pattern** overlay
- **Grid pattern:** CSS background-image `40px x 40px`, opacity `0.04`, warna cyan
- **Heading utama:** Font `Space Grotesk`, weight 700, dengan neon `text-shadow` pada kata kunci
- **Subheading:** Font `Inter`, weight 400, warna `--color-text-secondary`

```css
.section-hero {
    background: var(--gradient-hero-overlay);
    position: relative;
    overflow: hidden;
}

/* Subtle grid/scanline pattern */
.section-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(0, 200, 221, 0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0, 200, 221, 0.04) 1px, transparent 1px);
    background-size: 40px 40px;
    pointer-events: none;
}

/* Neon text highlight helpers */
.text-neon-cyan {
    color: var(--color-cyan-500);
    text-shadow: var(--glow-cyan);
}
.text-neon-magenta {
    color: var(--color-magenta-500);
    text-shadow: var(--glow-magenta);
}
```

---

### 6.7 Footer

- **Background:** `--color-dark-bg` (`#0A0714`)
- **Top border:** `4px` gradient `linear-gradient(90deg, #00C8DD, #E800C0)`
- **Text:** `--color-text-on-dark` (`#F0EEFF`)
- **Link:** `#8A7DA8` default → hover `--color-cyan-500`
- **Copyright:** Font `Inter`, `0.8rem`, `--color-text-muted`

```css
.footer-idle {
    background: var(--color-dark-bg);
    border-top: 4px solid;
    border-image: var(--gradient-footer-top) 1;
    color: var(--color-text-on-dark);
    padding: 48px 0 24px;
}
.footer-idle a {
    color: #8a7da8;
    transition: color 0.2s ease;
    text-decoration: none;
}
.footer-idle a:hover {
    color: var(--color-cyan-500);
}
```

---

## 7. Animation & Motion Guidelines

### 7.1 Neon Glow Pulse

```css
@keyframes neon-pulse-cyan {
    0%,
    100% {
        box-shadow: var(--glow-cyan);
    }
    50% {
        box-shadow: var(--glow-cyan-strong);
    }
}
@keyframes neon-pulse-magenta {
    0%,
    100% {
        box-shadow: var(--glow-magenta);
    }
    50% {
        box-shadow: var(--glow-magenta-strong);
    }
}
/* Gunakan secara selektif, hanya pada 1 CTA utama per halaman */
.btn-idle-primary.pulse {
    animation: neon-pulse-cyan 2.5s ease-in-out infinite;
}
```

### 7.2 Glitch Text Animation

```css
@keyframes glitch {
    0% {
        clip-path: inset(0 0 98% 0);
        transform: translate(-4px, 0) skewX(-2deg);
    }
    10% {
        clip-path: inset(40% 0 50% 0);
        transform: translate(4px, 0) skewX(2deg);
    }
    20% {
        clip-path: inset(80% 0 10% 0);
        transform: translate(-2px, 0);
    }
    30% {
        clip-path: inset(10% 0 70% 0);
        transform: translate(2px, 0);
    }
    40% {
        clip-path: inset(60% 0 25% 0);
        transform: translate(-3px, 0);
    }
    100% {
        clip-path: inset(0 0 98% 0);
        transform: translate(0);
    }
}
@media (prefers-reduced-motion: no-preference) {
    .glitch-text::before {
        color: var(--color-cyan-500);
        animation: glitch 4s infinite steps(1) 0.2s;
        opacity: 0.7;
    }
    .glitch-text::after {
        color: var(--color-magenta-500);
        animation: glitch 4s infinite steps(1) 0.5s;
        opacity: 0.7;
    }
}
```

> **Batasan:** Gunakan hanya pada **1–2 heading per halaman**. Wajib `data-text` attribute pada elemen.

### 7.3 Star / Particle Background

- Library: `tsparticles` (ringan, modern)
- Jumlah: maks **60 particles**
- Ukuran: `1–2px`, warna `#00C8DD` dan `#E800C0`, opacity `0.3–0.5`
- Kecepatan: lambat (nilai `speed: 1`)
- **Scope:** Hanya section hero dan section CTA utama

### 7.4 Scroll Reveal

- Library: `AOS.js` (sudah ada di project)
- Animasi: `fade-up`, durasi `600ms`
- Delay bertahap: `100ms` per elemen dalam satu grup
- Jangan gunakan pada elemen yang sangat kecil (badge, caption)

### 7.5 Hover Transitions

- Durasi standar: `200–250ms ease`
- Transform card: maks `translateY(-6px)`
- Transform button: maks `translateY(-2px)`
- Hindari `scale > 1.05`

---

## 8. Iconography

| Aspek                      | Aturan                                   |
| -------------------------- | ---------------------------------------- |
| Library                    | Font Awesome (sudah ada di project)      |
| Ukuran inline              | `16px`                                   |
| Ukuran UI button           | `20px`                                   |
| Ukuran feature icon        | `24px`                                   |
| Ukuran hero icon           | `32–48px`                                |
| Warna action icon          | `--color-cyan-500`                       |
| Warna alert/highlight icon | `--color-magenta-500`                    |
| Glow pada icon             | Hanya untuk hero / feature section utama |

---

## 9. Breakpoints & Responsive

| Nama    | Breakpoint      | Layout                                         |
| ------- | --------------- | ---------------------------------------------- |
| Mobile  | `< 576px`       | Stack semua kolom, font display dikurangi ~20% |
| Tablet  | `576px – 991px` | Grid 2 kolom                                   |
| Desktop | `>= 992px`      | Grid penuh, layout standar                     |
| Wide    | `>= 1400px`     | Max-width container `1320px`                   |

---

## 10. CSS Variables — Master Reference

Tempatkan di `:root` pada file `idle-design-system.css` (atau di `styles.css`):

```css
:root {
    /* === COLORS — Background === */
    --color-bg-base: #f8f5ff;
    --color-bg-section-alt: #f0ecf8;
    --color-bg-card: #ffffff;
    --color-bg-input: #f5f3ff;

    /* === COLORS — Cyan (Primary) === */
    --color-cyan-400: #22ddee;
    --color-cyan-500: #00c8dd;
    --color-cyan-600: #00a8bb;
    --color-cyan-glow: rgba(0, 200, 221, 0.4);

    /* === COLORS — Magenta (Secondary) === */
    --color-magenta-400: #ff3fd8;
    --color-magenta-500: #e800c0;
    --color-magenta-600: #c200a0;
    --color-magenta-glow: rgba(232, 0, 192, 0.35);

    /* === COLORS — Text & Border === */
    --color-text-primary: #0f0a1e;
    --color-text-secondary: #4a3f6b;
    --color-text-muted: #8a7da8;
    --color-text-on-dark: #f0eeff;
    --color-border: #ddd5f0;
    --color-border-focus: #00c8dd;

    /* === COLORS — Dark Surface (Footer) === */
    --color-dark-bg: #0a0714;
    --color-dark-surface: #150e2a;
    --color-dark-border: #2a1f4a;

    /* === GRADIENTS === */
    --gradient-neon-primary: linear-gradient(135deg, #00c8dd 0%, #e800c0 100%);
    --gradient-neon-subtle: linear-gradient(
        135deg,
        rgba(34, 221, 238, 0.13) 0%,
        rgba(255, 63, 216, 0.13) 100%
    );
    --gradient-hero-overlay: linear-gradient(
        180deg,
        #f8f5ff 0%,
        #ede8ff 60%,
        #f8f5ff 100%
    );
    --gradient-footer-top: linear-gradient(90deg, #00c8dd 0%, #e800c0 100%);
    --gradient-card-hover: linear-gradient(
        135deg,
        rgba(0, 200, 221, 0.08) 0%,
        rgba(232, 0, 192, 0.08) 100%
    );

    /* === TYPOGRAPHY === */
    --font-display: "Space Grotesk", sans-serif;
    --font-body: "Inter", sans-serif;
    --font-mono: "JetBrains Mono", monospace;

    /* === BORDER RADIUS === */
    --radius-xs: 4px;
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
    --radius-xl: 20px;
    --radius-pill: 9999px;
    --radius-full: 50%;

    /* === SPACING === */
    --space-1: 4px;
    --space-2: 8px;
    --space-3: 12px;
    --space-4: 16px;
    --space-5: 20px;
    --space-6: 24px;
    --space-8: 32px;
    --space-10: 40px;
    --space-12: 48px;
    --space-16: 64px;
    --space-20: 80px;

    /* === SHADOWS === */
    --shadow-xs: 0 1px 3px rgba(15, 10, 30, 0.08);
    --shadow-sm: 0 2px 8px rgba(15, 10, 30, 0.1);
    --shadow-md: 0 4px 16px rgba(15, 10, 30, 0.12);
    --shadow-lg: 0 8px 32px rgba(15, 10, 30, 0.16);

    /* === NEON GLOWS === */
    --glow-cyan:
        0 0 12px rgba(0, 200, 221, 0.5), 0 0 32px rgba(0, 200, 221, 0.25);
    --glow-cyan-strong:
        0 0 20px rgba(0, 200, 221, 0.7), 0 0 60px rgba(0, 200, 221, 0.35);
    --glow-magenta:
        0 0 12px rgba(232, 0, 192, 0.5), 0 0 32px rgba(232, 0, 192, 0.25);
    --glow-magenta-strong:
        0 0 20px rgba(232, 0, 192, 0.7), 0 0 60px rgba(232, 0, 192, 0.35);
    --glow-dual:
        0 0 16px rgba(0, 200, 221, 0.4), 0 0 16px rgba(232, 0, 192, 0.4);

    /* === TRANSITIONS === */
    --transition-fast: 150ms ease;
    --transition-base: 220ms ease;
    --transition-slow: 350ms ease;
}
```

---

## 11. Dos and Don'ts

### DO

- Gunakan `Space Grotesk` untuk semua heading dan judul
- Terapkan neon glow **hanya pada hover** atau elemen CTA utama
- Gunakan dual-accent secara konsisten: **cyan = aksi**, **magenta = highlight/badge**
- Pastikan contrast ratio teks minimum **WCAG AA (4.5:1)**
- Gunakan `--radius-pill` untuk button, `--radius-md` untuk card
- Semua animasi wajib punya `prefers-reduced-motion` fallback

### DON'T

- Jangan gunakan neon glow pada **semua elemen sekaligus**
- Jangan gunakan glitch animation di lebih dari **2 heading per halaman**
- Jangan gunakan `#00C8DD` sebagai warna teks panjang di atas putih (contrast rendah) — gunakan `--color-cyan-600`
- Jangan gunakan font lama: `Nunito`, `Raleway`, `Lora`, `Baloo`
- Jangan hardcode warna hex di file Blade/CSS individual — selalu gunakan CSS variable
- Jangan lupa set `background-color: var(--color-bg-base)` pada `body`

---

## 12. Accessibility

| Aspek              | Aturan                                                           |
| ------------------ | ---------------------------------------------------------------- |
| Contrast body text | `#0F0A1E` pada `#F8F5FF` = ~18.5:1 (AAA)                         |
| Cyan untuk teks    | Gunakan `--color-cyan-600` (#00A8BB), contrast ~5.1:1 (AA)       |
| Magenta untuk teks | `--color-magenta-500` (#E800C0) pada putih = ~4.8:1 (AA)         |
| Focus indicator    | `:focus-visible { box-shadow: 0 0 0 3px rgba(0,200,221,0.4); }`  |
| Animasi            | Wajib dibungkus `@media (prefers-reduced-motion: no-preference)` |
| Alt text           | Semua `<img>` wajib memiliki `alt` yang deskriptif               |

---

_Dokumen ini merupakan panduan desain resmi IDLE 2026. Setiap perubahan signifikan pada palet warna, tipografi, atau sistem komponen harus diperbarui di sini sebelum diimplementasikan ke kode._
