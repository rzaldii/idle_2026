<?php

namespace App\Http\Controllers\Admin;

use App\Kategori;
use App\Mahasiswa;
use App\Penilaian;
use App\Post;
use App\PostImage;
use App\Submission;
use App\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;


class AjaxController extends Controller
{
    public function getPost()
    {
        return DataTables::of(Post::with('user')->orderBy('created_at', 'desc')->get())->make(true);
    }

    public function getPenyisihan1Tim($kategori)
    {
        $data = Tim::with('mahasiswa', 'pesertas.mahasiswa', 'submissions')
            ->where('id_kategori', $kategori)
            ->where('babak', '=', 1)
            //            ->orderBy('created_at', 'desc')
            ->get();
        $index = 1;
        foreach ($data as $d) {
            $d->no = $index++;
            $anggota = [];
            foreach ($d->pesertas as $p) {
                array_push($anggota, $p->mahasiswa->nama);
            }

            $d->submission = Submission::where('token', $d->submissionid)
                ->orderBy('created_at', 'desc')
                ->get()
                ->first();
            $d->anggota = implode(', ', $anggota);
        }

        return DataTables::of($data)->make(true);
    }

    public function getPenyisihan2Tim($kategori)
    {
        $data = Tim::with('mahasiswa', 'pesertas.mahasiswa', 'submissions')
            ->where('id_kategori', $kategori)
            ->where('babak', '=', 2)
            //            ->orderBy('created_at', 'desc')
            ->get();
        $index = 1;
        foreach ($data as $d) {
            $d->no = $index++;
            $anggota = [];
            foreach ($d->pesertas as $p) {
                array_push($anggota, $p->mahasiswa->nama);
            }

            $d->submission = Submission::where('token', $d->submissionid)
                ->orderBy('created_at', 'desc')
                ->get()
                ->first();
            $d->anggota = implode(', ', $anggota);
        }

        return DataTables::of($data)->make(true);
    }

    public function getFinalTim($kategori)
    {
        $data = Tim::with('mahasiswa', 'pesertas.mahasiswa')
            ->where('id_kategori', $kategori)
            ->where('babak', '=', 3)
            //            ->orderBy('created_at', 'desc')
            ->get();
        $index = 1;
        foreach ($data as $d) {
            $d->no = $index++;
            $anggota = [];
            foreach ($d->pesertas as $p) {
                array_push($anggota, $p->mahasiswa->nama);
            }

            $d->submission = Submission::where('token', $d->submissionid)
                ->orderBy('created_at', 'desc')
                ->get()
                ->first();
            $d->anggota = implode(', ', $anggota);
        }

        return DataTables::of($data)->make(true);
    }

    public function getMahasiswas()
    {
        $data = Mahasiswa::get();
        $no = 1;
        foreach ($data as $d) {
            $d->no = $no++;
        }
        return DataTables::of($data)->make(true);
    }

    public function getTims()
    {
        $kategoris = Kategori::where('id_ormawa', Auth::user()->id_ormawa)->get();
        $tims = [];
        $no = 1;
        foreach ($kategoris as $kategori) {
            foreach (Tim::with('mahasiswa', 'kategori')->where('id_kategori', $kategori->id)->get() as $tim) {
                $tim->no = $no++;
                array_push($tims, $tim);
            }
        }
        return DataTables::of($tims)->make(true);
    }

    public function downloadFile($id)
    {
        $file = Submission::with('tim.kategori')
            ->where('token', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$file) {
            return redirect()->back()->with('error', 'File not found');
        }

        $file_path = public_path('uploads/' . $file->file_path);

        if (!file_exists($file_path)) {
            return redirect()->back()->with('error', 'File not found');
        }

        // Ambil ekstensi
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);

        // Gabungkan nama file
        $name = $file->tim->kategori->nama_kategori . '_' . $file->tim->nama_tim . '_' . $file->judul;

        // Replace karakter ilegal dengan underscore
        $name = preg_replace('/[\/\\\:\*\?"<>\|]/', '_', $name);

        // Tambahkan ekstensi
        $name .= '.' . $extension;

        return response()->download($file_path, $name);
    }



    public function getTimsData()
    {
        $kategoris = Kategori::with('tims')->get();
        $colors = ['#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000'];
        $labels = [];
        $values = [];
        foreach ($kategoris as $key => $kategori) {
            array_push($labels, $kategori->nama_kategori);
            array_push($values, count($kategori->tims));
        }
        return [
            "color" => $colors,
            "label" => $labels,
            "value" => $values
        ];
    }

    public function getMahasiswasData()
    {
        $_prodi = ['Sistem Informasi', 'Teknologi Informasi', 'Informatika'];
        $mahasiswas = Mahasiswa::get();

        $_angkatan = [];
        // Ambil semua angkatan yang ada dari data mahasiswa
        foreach ($mahasiswas as $mahasiswa) {
            $ang = "20" . substr(($mahasiswa->nim . ''), 0, 2);
            if (!in_array($ang, $_angkatan)) {
                $_angkatan[] = $ang;
            }
        }
        
        // Urutkan angkatan
        sort($_angkatan);
        
        // Fallback jika belum ada data mahasiswa
        if (empty($_angkatan)) {
            $_angkatan = ['2024'];
        }

        $data = [];

        foreach ($_prodi as $prodi) {
            $dd = [];
            foreach ($_angkatan as $angkatan) {
                $dd[$angkatan] = 0;
            }
            $data[$prodi] = $dd;
        }

        foreach ($mahasiswas as $mahasiswa) {
            $ang = "20" . substr(($mahasiswa->nim . ''), 0, 2);
            $prodi = substr(($mahasiswa->nim . ''), -4, 1);

            $prodi = $prodi == 1 ? "Sistem Informasi" : ($prodi == 2 ? "Teknologi Informasi" : "Informatika");
            
            if (isset($data[$prodi][$ang])) {
                $data[$prodi][$ang]++;
            }
        }

        return ["data" => $data, "angkatan" => $_angkatan, "prodi" => $_prodi];
    }

    public function getNilai($id, $babak)
    {
        return Penilaian::select('nilai')
            ->where('id_tim', $id)
            ->where('babak', $babak)
            ->get()->first()->nilai;
    }

    public function setNilai(Request $request)
    {
        $id = $request->tim;
        $nilai = $request->nilai;
        $babak = $request->babak;
        $status = Penilaian::setNilai($id, $nilai, $babak);
        return $status == true ? 1 : 0;
    }

    public function getImages()
    {
        $images = PostImage::get();
        foreach ($images as $image) {
            $image->url = URL::to('/') . $image->url;
        }

        return $images;
    }
}
