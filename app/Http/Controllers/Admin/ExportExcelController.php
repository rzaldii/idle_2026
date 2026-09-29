<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MahasiswaExport;
use App\Exports\OrmawaPesertaExport;
use App\Exports\PesertaExport;
use App\Exports\TimExport;
use App\Http\Controllers\Controller;
use App\Kategori;
use App\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    public function exportPenyisihan1($kategori){
        $nama_kategori = Kategori::findOrFail($kategori)->nama_kategori;
        return Excel::download(new PesertaExport($kategori), "Peserta Tahap 1 $nama_kategori.xlsx");
    }

    public function exportPenyisihan2($kategori){
        $nama_kategori = Kategori::findOrFail($kategori)->nama_kategori;
        return Excel::download(new PesertaExport($kategori, 2), "Peserta Tahap 2 $nama_kategori.xlsx");
    }

    public function exportFinal($kategori){
        $nama_kategori = Kategori::findOrFail($kategori)->nama_kategori;
        return Excel::download(new PesertaExport($kategori, 3), "Peserta Final $nama_kategori.xlsx");
    }

    public function exportTims(){
        return Excel::download(new TimExport(), 'Tim Seluruh Lomba IDLe.xlsx');
    }

    public function exportPesertas(){
        $id_ormawa = Auth::user()->id_ormawa ?? null;
        $nama_ormawa = Auth::user()->name ?? 'Ormawa';
        return Excel::download(new OrmawaPesertaExport($id_ormawa), "Daftar Peserta $nama_ormawa IDLe.xlsx");
    }

    public function exportMahasiswas(){
        return $this->exportPesertas();
    }
}
