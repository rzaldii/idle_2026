@extends('layouts.base')

@section('title', 'Daftar Peserta ' . $kategori->nama_kategori . ' — IDLe 2026')

@section('css')
<style>
    body {
        background-color: var(--color-bg-base, #F8F5FF);
        font-family: var(--font-body, 'Inter', sans-serif);
        color: var(--color-text-primary, #0F0A1E);
    }

    .peserta-wrapper {
        min-height: 80vh;
        padding-top: 120px;
        padding-bottom: 70px;
    }

    .peserta-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .peserta-title {
        font-family: var(--font-display, 'Space Grotesk', sans-serif);
        font-weight: 700;
        font-size: 2.2rem;
        color: var(--color-text-primary, #0F0A1E);
        margin-bottom: 8px;
    }

    .peserta-subtitle {
        font-size: 0.95rem;
        color: var(--color-text-secondary, #4A3F6B);
        max-width: 600px;
        margin: 0 auto;
    }

    .peserta-card {
        background: #FFFFFF;
        border: 1px solid var(--color-border, #DDD5F0);
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(15, 10, 30, 0.05);
        padding: 28px 32px;
        margin-bottom: 30px;
    }

    .peserta-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }

    .peserta-count {
        font-size: 0.9rem;
        color: var(--color-text-secondary, #4A3F6B);
        font-weight: 500;
    }

    .peserta-search {
        max-width: 260px;
        width: 100%;
    }

    .peserta-search input {
        width: 100%;
        padding: 8px 14px;
        font-size: 0.88rem;
        border: 1px solid var(--color-border, #DDD5F0);
        border-radius: 8px;
        background: var(--color-bg-input, #F5F3FF);
        color: var(--color-text-primary, #0F0A1E);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .peserta-search input:focus {
        outline: none;
        background: #FFFFFF;
        border-color: var(--color-cyan-500, #00C8DD);
        box-shadow: 0 0 0 3px rgba(0, 200, 221, 0.15);
    }

    .peserta-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }

    .peserta-table thead th {
        background-color: var(--color-bg-section-alt, #F0ECF8);
        color: var(--color-text-secondary, #4A3F6B);
        font-family: var(--font-display, 'Space Grotesk', sans-serif);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        padding: 12px 16px;
        border-top: none;
        border-bottom: 1.5px solid var(--color-border, #DDD5F0);
    }

    .peserta-table tbody td {
        padding: 14px 16px;
        font-size: 0.92rem;
        color: var(--color-text-primary, #0F0A1E);
        border-top: 1px solid #ECE7FA;
        vertical-align: middle;
    }

    .peserta-table tbody tr:hover {
        background-color: rgba(0, 200, 221, 0.03);
    }

    .peserta-empty {
        text-align: center;
        padding: 50px 20px;
        color: var(--color-text-muted, #8A7DA8);
        font-size: 0.95rem;
    }

    .pagination-wrapper {
        margin-top: 24px;
        display: flex;
        justify-content: center;
    }

    .pagination-wrapper .pagination {
        margin: 0;
        display: flex;
        gap: 4px;
    }

    .pagination-wrapper .page-item .page-link {
        color: var(--color-text-secondary, #4A3F6B);
        border: 1px solid var(--color-border, #DDD5F0);
        border-radius: 6px;
        padding: 6px 12px;
        font-size: 0.88rem;
        background: #FFFFFF;
    }

    .pagination-wrapper .page-item.active .page-link {
        background-color: var(--color-cyan-500, #00C8DD);
        border-color: var(--color-cyan-500, #00C8DD);
        color: #0A0714;
        font-weight: 600;
    }

    @media (max-width: 576px) {
        .peserta-wrapper {
            padding-top: 100px;
        }

        .peserta-title {
            font-size: 1.6rem;
        }

        .peserta-card {
            padding: 20px 16px;
        }

        .peserta-card-header {
            flex-direction: column;
            align-items: stretch;
        }

        .peserta-search {
            max-width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="peserta-wrapper">
    <div class="container">
        <!-- Header -->
        <div class="peserta-header">
            <h1 class="peserta-title">Daftar Peserta {{ $kategori->nama_kategori }}</h1>
            @if($babak != 1)
                <p class="peserta-subtitle">
                    Daftar peserta yang masuk pada babak {{ $babak }} dengan nilai pada babak sebelumnya.
                </p>
            @endif
        </div>

        <!-- Table Card -->
        <div class="peserta-card">
            <div class="peserta-card-header">
                <span class="peserta-count">
                    Total: {{ $tims->total() }} tim
                </span>
                @if(count($tims) > 0)
                <div class="peserta-search">
                    <input type="text" id="filterInput" placeholder="Cari nama tim...">
                </div>
                @endif
            </div>

            <div class="table-responsive">
                @if(count($tims) > 0)
                <table class="table peserta-table" id="tablePeserta">
                    <thead>
                        <tr>
                            <th width="8%" class="text-center">#</th>
                            <th width="72%">Nama Tim</th>
                            <th width="20%" class="text-center">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tims as $key => $tim)
                        @php
                            $no = ($tims->currentPage() - 1) * $tims->perPage() + $key + 1;
                            $score = isset($tim->nilai[0]->nilai) ? $tim->nilai[0]->nilai : '-';
                        @endphp
                        <tr class="row-peserta">
                            <td class="text-center" style="color: var(--color-text-muted);">{{ $no }}</td>
                            <td class="team-name" style="font-weight: 600;">{{ $tim->nama_tim }}</td>
                            <td class="text-center" style="font-family: var(--font-mono, monospace); font-weight: 600;">{{ $score }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="peserta-empty">
                    Belum ada peserta dalam kategori {{ $kategori->nama_kategori }}.
                </div>
                @endif
            </div>

            @if($tims->hasPages())
            <div class="pagination-wrapper">
                {{ $tims->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#filterInput').on('keyup', function () {
            var value = $(this).val().toLowerCase().trim();
            $('.row-peserta').each(function () {
                var name = $(this).find('.team-name').text().toLowerCase();
                if (name.indexOf(value) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
@endsection
