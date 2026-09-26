<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kategori;
use App\Mahasiswa;
use App\Peserta;
use App\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KompetisiFinal extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_kategori)
    {
        // TODO : Return view with datatable
        $kategori = Kategori::where('kategori', $id_kategori)->get()->first();
        return view('admin.pages.final', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_kategori)
    {
        // TODO : Return view create
        $kategori = Kategori::where('kategori', $id_kategori)->get()->first();
        if ($kategori->id_ormawa == 1 || $kategori->id_ormawa == 2 || $kategori->id_ormawa == 3 || $kategori->id_ormawa == 4 || $kategori->kategori == 'data-mining'){
            $tims = Tim::where('id_kategori', $kategori->id)->where('babak', '=', 1)->get();
        } else {
            $tims = Tim::where('id_kategori', $kategori->id)->where('babak', '=', 2)->get();
        }
        return view('admin.pages.add_final', compact('kategori', 'tims'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id_kategori, Request $request)
    {
        $tims = $request->tims;
        $tahap = "final";
        $kategori = Kategori::where('kategori', $id_kategori)->get()->first();
        $mailer = app()->make(\Snowfire\Beautymail\Beautymail::class);
        foreach($tims as $tim){
            Tim::updateKompetisi($tim, 3);
            $tim_ = Tim::with('pesertas.mahasiswa')->find($tim);
            $kode = $tim_->submissionid;
            $nama = $tim_->nama_tim;
            foreach ($tim_->pesertas as $peserta){
                $email = $peserta->mahasiswa->email;
                $mailer->send('mails.lolos', compact('tahap', 'tim_', 'kategori', 'nama', 'kode'), function ($message) use ($email) {
                    $message
                        ->from('_mainaccount@idlefasilkom.blog')
                        ->to($email)
                        ->subject('Pengumuman Final');
                });
            }
        }

        // TODO : return redirect with success
        return redirect()->route('admin.final.index', $id_kategori);
    }

    public function getSetNilaiPages()
    {
        $babak = 3;
        $tahap = "Final";
        $kategoris = Kategori::where('id_ormawa', Auth::user()->id_ormawa)->get();
        $tims = [];
        foreach ($kategoris as $kategori) {
            $tim = Tim::select('id', 'nama_tim', 'babak')
                ->where('id_kategori', $kategori->id)
                ->where('babak', $babak)
                ->get();
            foreach ($tim as $t) {
                array_push($tims, $t);
            }
        }
        return view('admin.pages.set_nilai', compact('tims', 'tahap', 'babak'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_kategori, $id)
    {
        return route('admin.tim.show', ['tim' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kategori, $id)
    {
        return 'Edit ' . $id_kategori . '_' . $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kategori, $id)
    {
        $tim = Tim::updateKompetisi($id, 2);
        if($tim){
            return redirect()->route('admin.final.index', compact('kategori'));
        }
        return redirect()->route('admin.final.index', compact('kategori'));
    }
}
