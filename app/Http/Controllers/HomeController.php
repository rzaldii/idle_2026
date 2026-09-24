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
