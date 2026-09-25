<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kategoris = Kategori::get();

        // Pastikan kategori Animasi ikut tampil di beranda jika belum ada di database
        if (!$kategoris->contains('kategori', 'animasi')) {
            $animasi = new Kategori();
            $animasi->id = 99;
            $animasi->id_ormawa = 2; // Himatif
            $animasi->nama_kategori = 'Animasi';
            $animasi->kategori = 'animasi';
            $kategoris->push($animasi);
        }

        // Urutan baku card lomba IDLe 2026:
        // Himasif (ISIC): PPL/Software Dev, Bisnis TIK, Smart City
        // Himatif (ITeC): UI/UX, IoT, Game Development, Animasi (runtut setelah Smart City)
        // HMIF (I-COM): CPC, KTI
        // UKM LAOS (LAOS Arena): CTF
        $order = [
            'ppl' => 1, 'software' => 1,
            'bisnis-tik' => 2, 'bisnis-development' => 2,
            'smart-city' => 3,
            'uiux' => 4,
            'iot' => 5,
            'game' => 6, 'gamedev' => 6, 'game-dev' => 6,
            'animasi' => 7,
            'cpc' => 8,
            'kti' => 9,
            'ctf' => 10,
        ];

        $kategoris = $kategoris->sortBy(function($kat) use ($order) {
            return $order[$kat->kategori] ?? 99;
        })->values();

        $posts = Post::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(8);
//        return $posts;
        return view('pages.home', compact('kategoris', 'posts'));
    }

    public function faq()
    {
        $kategoris = Kategori::get();
        return view('pages.faq', compact('kategoris'));
    }

    public function ask(Request $request)
    {
        $no_isic = '6289687331240';     // Himasif (ISIC) - Febbyna Jasmine
        $no_itec = '6287711713783';     // HIMATIF (ITeC) - Richo
        $no_icom = '6285233116110';     // HMIF (I-COM) - Sefia
        $no_laos = '6285607914835';     // UKM LAOS (LAOS Arena) - Dina

        $URl = "api.whatsapp.com/send?phone=%T%&text=%M%";

        $kategori = $request['kategori'];
        $raw_pesan = rawurlencode("Halo... Saya dari tim *".$request['nama_tim']."* Kategori *".$kategori."* ingin bertanya: ".$request['pesan']);

        if($kategori=="Software Dev" || $kategori=="Business Dev" || $kategori=="Smart City" || $kategori=="PPL" || $kategori=="Bisnis TIK" || $kategori=="PKM-GO" )
        {
            $target = $no_isic;
        }else if($kategori=="UI/UX" || $kategori=="IoT" || $kategori=="IOT" || $kategori=="Game Dev" || $kategori=="Animasi" || $kategori=="Data Mining"){
            $target = $no_itec;
        }else if($kategori=="CPC" || $kategori=="KTI" || $kategori=="Game" || $kategori=="PAP" ){
            $target = $no_icom;
        }else if($kategori=="CTF" ){
            $target = $no_laos;
        }else{
            $target = $no_itec;
        }

        $orig = array("%T%", "%M%");
        $mod  = array($target, $raw_pesan);

        $pesan = str_replace($orig, $mod, $URl);
        return redirect('https://'.$pesan);
    }

}
