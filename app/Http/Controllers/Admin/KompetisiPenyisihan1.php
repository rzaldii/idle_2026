<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kategori;
use App\Mahasiswa;
use App\Peserta;
use App\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KompetisiPenyisihan1 extends Controller
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
        return view('admin.pages.penyisihan_1', compact('kategori'));
    }

    public function getSetNilaiPages()
    {
        $babak = 1;
        $tahap = "Penyisihan Tahap 1";
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_kategori)
    {
        // TODO : Return view create
        return 'Create ' . $id_kategori;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($id_kategori, Request $request)
    {
        $kategori = Kategori::with('ormawa')->find($id_kategori);

        $mahasiswas = [];
        for ($i = 0; $i < count($request->nama); $i++) {
            $mahasiswas[$i]["nama"] = $request->nama[$i];
            $mahasiswas[$i]["nim"] = $request->nim[$i];
            $mahasiswas[$i]["email"] = $request->email[$i];
            $mahasiswas[$i]["no_hp"] = $request->no_hp[$i];
        }

        if (count($m = Tim::where('ketua_tim', $mahasiswas[0]["nim"])->get())) {
            return redirect()->back()->with('error', 'Gagal mendaftar, karena ' . $m->first()->nama . ' sudah menjadi ketua di tim lain');
        }

        // TODO : Validation ????

        $pesertas = [];
        $count = 0;

        foreach ($mahasiswas as $mahasiswa) {
            $count++;
            if ($count <= 1) {
                if ($mahasiswa["nim"] == null) {
                    return redirect()->back()->with('error', 'Gagal mendaftar, karena NIM belum diisi');
                } else if (preg_match("/^[0-9]{12,13}$/", $mahasiswa["nim"]) == 0) {
                    return redirect()->back()->with('error', 'Gagal mendaftar, karena NIM tidak sesuai');
                } else if (preg_match("/^[a-zA-Z0-9._%+\-]+@mail\.unej\.ac\.id$/", $mahasiswa["email"]) == 0) {
                    return redirect()->back()->with('error', 'Gagal mendaftar, karena Email bukan email unej');
                } else {
                    $mhs = Mahasiswa::createMahasiswa($mahasiswa["nim"], $mahasiswa["nama"], $mahasiswa["email"], $mahasiswa["no_hp"]);

                    array_push($pesertas, $mhs);
                }
            } else {
                if ($mahasiswa["nama"] == null && $mahasiswa["nim"] == null && $mahasiswa["email"] == null && $mahasiswa["no_hp"] == null) {
                    continue;
                } else if (preg_match("/^[0-9]{12,13}$/", $mahasiswa["nim"]) == 0) {
                    return redirect()->back()->with('error', 'Gagal mendaftar, karena NIM tidak sesuai');
                } else {
                    $mhs = Mahasiswa::createMahasiswa($mahasiswa["nim"], $mahasiswa["nama"], $mahasiswa["email"], $mahasiswa["no_hp"]);

                    array_push($pesertas, $mhs);
                }
            }
        }

        $tim = Tim::createTim($request->kategori, $pesertas[0], $request->nama_tim);

        foreach ($pesertas as $peserta) {
            Peserta::linkPesertaToTim($peserta->nim, $tim->id);
        }

        try {
            $mailer = app()->make(\Snowfire\Beautymail\Beautymail::class);
            $kode = $tim->submissionid;
            foreach ($mahasiswas as $mahasiswa) {
                // Skip jika NIM atau email kosong/null
                if (empty($mahasiswa["nim"]) || empty($mahasiswa["email"])) {
                    continue;
                }
                $email = trim($mahasiswa["email"]);
                $mailer->send('mails.daftar', compact('tim', 'kategori', 'kode'), function ($message) use ($email, $kategori) {
                    $message
                        ->from(config('mail.from.address'), config('mail.from.name'))
                        ->to($email)
                        ->subject('Pendaftaran IDLe');
                });
                \Log::info('Email pendaftaran berhasil dikirim ke: ' . $email . ' untuk tim: ' . $tim->nama_tim);
            }
        } catch (\Exception $e) {
            \Log::error('Gagal kirim email pendaftaran untuk tim [' . ($tim->nama_tim ?? '-') . ']: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
        }

        // TODO : return redirect with success

        return redirect()->back()->with('success', 'Tim berhasil didaftarkan, silahkan cek email anda');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_kategori, $id)
    {
        return 'Show ' . $id_kategori . '_' . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kategori, $id)
    {
        return 'Edit ' . $id_kategori . '_' . $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Tim::deleteTim($id)) {
            return redirect()->back()->with('Tim berhasil dihapus');
        }
        return redirect()->back()->with('Tim gagal dihapus');
    }
}
