<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Tim;
use Illuminate\Http\Request;

class KompetisiController extends Controller
{
    public function getPagesByCategory($kategori)
    {
        $kategoris = Kategori::get();
        $kat = Kategori::where('kategori', $kategori)->first();
        if (!$kat) {
            if ($kategori == 'animasi') {
                $kat = new Kategori();
                $kat->id = 99;
                $kat->id_ormawa = 2; // Himatif
                $kat->nama_kategori = 'Animasi';
                $kat->kategori = 'animasi';
                return view('pages.kompetisi.animasi', ['kategoris' => $kategoris, 'kategori' => $kat]);
            }
            return response()->view('errors.404_not_found');
        }
        return view('pages.kompetisi.' . $kat->kategori, ['kategoris' => $kategoris, 'kategori' => $kat]);
    }

    public function getPagePeserta($kategori)
    {
        if (count(Kategori::where('kategori', $kategori)->get()) <= 0) {
            return response()->view('errors.404_not_found');
        }
        $kategori = Kategori::with('tims')->where('kategori', $kategori)->get()->first();
        return view('pages.peserta_kategori', compact('kategori'));
    }

    public function getPesertasByCategory($kategori)
    {
        /*
            PPL 1
            Game 2
            BisTik 3
            SmartCity 4
            UIUX 5
            DataMining 6
            CPC 7
            CTF 8
            PKMGO 9
            KTI 10
        */
        /*  ========= Kendali Tahapan Perlombaan =========
         *  isikan pada array sesuai id tahapan lomba.
        */
        $kat_final = [];
        $kat_2 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];



        $kategoris = Kategori::get();
        $kategori = Kategori::where('kategori', $kategori)->get()->first();

        $babak = 1;

        if (in_array($kategori->id, $kat_2)) {
            $babak = 2;
        } else if (in_array($kategori->id, $kat_final)) {
            $babak = 3;
        }

        $tims = Tim::with('nilais')->where('id_kategori', $kategori->id)->where('babak', $babak)
            ->paginate(20);

        foreach ($tims as $tim) {
            if (count($tim->nilais) != 0) {
                $tim->nilai = [$tim->nilais[count($tim->nilais) - 1]];
            }
        }
        return view('pages.peserta', compact('kategoris', 'tims', 'kategori', 'babak'));
    }
}
