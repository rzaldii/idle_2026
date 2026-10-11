@extends('admin.layouts.base')

{{--Page Title--}}

@section('title', 'Admin Dashboard')

{{--Custom CSS--}}
@section('css')
<style media="screen">
.tile {
  overflow-x: auto;
}
.kategori-status-card {
  border-radius: 8px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.05);
  margin-bottom: 25px;
}
.badge-status-open {
  background-color: #28a745;
  color: #fff;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 0.82rem;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.badge-status-closed {
  background-color: #dc3545;
  color: #fff;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 0.82rem;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.btn-toggle-status {
  min-width: 130px;
  font-weight: 600;
  font-size: 0.85rem;
  border-radius: 6px;
  transition: all 0.2s ease;
}
.bulk-btn-group .btn {
  font-weight: 600;
  font-size: 0.88rem;
  border-radius: 6px;
  margin-left: 8px;
}
</style>
@endsection

{{--App Title--}}

@section('app-title', 'Dashboard')
@section('app-description', 'Dashboard untuk ' . \Illuminate\Support\Facades\Auth::user()->name)

{{--Content--}}

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-triangle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Panel Kontrol Pendaftaran Lomba Ormawa -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile kategori-status-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <div>
                        <h3 class="tile-title mb-1">
                            <i class="text-primary mr-2"></i>Status Pendaftaran Bidang Lomba ({{ \Illuminate\Support\Facades\Auth::user()->name }})
                        </h3>
                        <!-- <p class="text-muted small mb-0">Kontrol akses pendaftaran peserta untuk seluruh bidang lomba yang dikelola oleh ormawa Anda.</p> -->
                    </div>
                    <div class="bulk-btn-group mt-2 mt-md-0">
                        <button type="button" class="btn btn-outline-danger shadow-sm" id="btn-tutup-semua" onclick="toggleAllRegistration(0)">
                            <i class="fa fa-lock mr-1"></i> Tutup Semua Pendaftaran
                        </button>
                        <button type="button" class="btn btn-outline-success shadow-sm" id="btn-buka-semua" onclick="toggleAllRegistration(1)">
                            <i class="fa fa-unlock mr-1"></i> Buka Semua Pendaftaran
                        </button>
                    </div>
                </div>

                @if(isset($kategorisOrmawa) && $kategorisOrmawa->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 50px;" class="text-center">#</th>
                                    <th>Bidang Lomba</th>
                                    <th>Halaman Lomba</th>
                                    <th class="text-center" style="width: 140px;">Tim Terdaftar</th>
                                    <th class="text-center" style="width: 160px;">Status Pendaftaran</th>
                                    <th class="text-center" style="width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategorisOrmawa as $index => $kat)
                                    <tr id="row-kategori-{{ $kat->id }}">
                                        <td class="text-center font-weight-bold">{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $kat->nama_kategori }}</strong>
                                        </td>
                                        <td>
                                            <a href="{{ route('kompetisi.index', ['kategori' => $kat->kategori]) }}" target="_blank" class="text-primary small">
                                                <i class="fa fa-external-link mr-1"></i> /kompetisi/{{ $kat->kategori }}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-info px-2 py-1" style="font-size: 0.85rem;">
                                                <i class="fa fa-users mr-1"></i> {{ $kat->tims_count ?? 0 }} Tim
                                            </span>
                                        </td>
                                        <td class="text-center" id="status-col-{{ $kat->id }}">
                                            @if($kat->is_open ?? true)
                                                <span class="badge-status-open">
                                                    <i class="fa fa-check-circle"></i> Terbuka
                                                </span>
                                            @else
                                                <span class="badge-status-closed">
                                                    <i class="fa fa-lock"></i> Ditutup
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center" id="action-col-{{ $kat->id }}">
                                            @if($kat->is_open ?? true)
                                                <button type="button" class="btn btn-sm btn-danger btn-toggle-status" onclick="toggleSingleRegistration({{ $kat->id }}, '{{ addslashes($kat->nama_kategori) }}')">
                                                    <i class="fa fa-lock mr-1"></i> Tutup
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-success btn-toggle-status" onclick="toggleSingleRegistration({{ $kat->id }}, '{{ addslashes($kat->nama_kategori) }}')">
                                                    <i class="fa fa-unlock mr-1"></i> Buka
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="fa fa-info-circle mr-2"></i>Tidak ada kategori lomba yang terhubung dengan akun ormawa ini.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Total Peserta IDL</h3>
                {!! $totalPesertaChart->container() !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Total Tim</h3>
                {!! $totalTimChart->container() !!}
            </div>
        </div>
    </div>
@endsection

{{--Custom Javascript--}}

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>

    {!! $totalTimChart->script() !!}
    {!! $totalPesertaChart->script() !!}

    <script>
        function toggleSingleRegistration(kategoriId, namaKategori) {
            var actionCol = $('#action-col-' + kategoriId);
            var btn = actionCol.find('button');
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-1"></i> Memproses...');

            $.ajax({
                url: "{{ url('admin/kategori/toggle') }}/" + kategoriId,
                type: "POST",
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        var statusCol = $('#status-col-' + kategoriId);
                        if (response.is_open) {
                            statusCol.html('<span class="badge-status-open"><i class="fa fa-check-circle"></i> Terbuka</span>');
                            actionCol.html('<button type="button" class="btn btn-sm btn-danger btn-toggle-status" onclick="toggleSingleRegistration(' + kategoriId + ', \'' + namaKategori + '\')"><i class="fa fa-lock mr-1"></i> Tutup</button>');
                        } else {
                            statusCol.html('<span class="badge-status-closed"><i class="fa fa-lock"></i> Ditutup</span>');
                            actionCol.html('<button type="button" class="btn btn-sm btn-success btn-toggle-status" onclick="toggleSingleRegistration(' + kategoriId + ', \'' + namaKategori + '\')"><i class="fa fa-unlock mr-1"></i> Buka</button>');
                        }
                        if (typeof successNotification === 'function') {
                            successNotification('Berhasil', response.message);
                        }
                    } else {
                        if (typeof errorNotification === 'function') {
                            errorNotification('Gagal', response.message || 'Terjadi kesalahan.');
                        }
                        btn.prop('disabled', false);
                    }
                },
                error: function(xhr) {
                    var msg = 'Gagal memperbarui status pendaftaran.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    if (typeof errorNotification === 'function') {
                        errorNotification('Error', msg);
                    } else {
                        alert(msg);
                    }
                    btn.prop('disabled', false);
                }
            });
        }

        function toggleAllRegistration(status) {
            var statusLabel = status === 1 ? 'Membuka' : 'Menutup';
            var confirmMsg = status === 1 
                ? 'Apakah Anda yakin ingin MEMBUKA seluruh pendaftaran bidang lomba ormawa ini?'
                : 'Apakah Anda yakin ingin MENUTUP seluruh pendaftaran bidang lomba ormawa ini?';

            if (!confirm(confirmMsg)) {
                return;
            }

            var btnId = status === 1 ? '#btn-buka-semua' : '#btn-tutup-semua';
            var originalText = $(btnId).html();
            $(btnId).prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-1"></i> ' + statusLabel + '...');

            $.ajax({
                url: "{{ route('admin.kategori.toggle-all') }}",
                type: "POST",
                data: { status: status },
                dataType: "json",
                success: function(response) {
                    $(btnId).prop('disabled', false).html(originalText);
                    if (response.success) {
                        if (typeof successNotification === 'function') {
                            successNotification('Berhasil', response.message);
                        }
                        setTimeout(function() {
                            location.reload();
                        }, 800);
                    } else {
                        if (typeof errorNotification === 'function') {
                            errorNotification('Gagal', response.message || 'Terjadi kesalahan.');
                        }
                    }
                },
                error: function(xhr) {
                    $(btnId).prop('disabled', false).html(originalText);
                    var msg = 'Gagal memperbarui status pendaftaran massal.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    if (typeof errorNotification === 'function') {
                        errorNotification('Error', msg);
                    } else {
                        alert(msg);
                    }
                }
            });
        }
    </script>
@endsection
