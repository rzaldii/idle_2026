<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Charts\DoughnutChart;
use Illuminate\Http\Request;
use App\Kategori;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalTimChart = new DoughnutChart;
        $totalPesertaChart = new DoughnutChart;

        $dataController = new AjaxController();
        $dataTotalTim = $dataController->getTimsData();
        $dataTotalPeserta = $dataController->getMahasiswasData();

        $totalPesertaChart->labels($dataTotalPeserta["angkatan"]);

        foreach ($dataTotalPeserta["data"] as $prodi => $dataByProdi){
            $dataAngkatan = [];
            foreach ($dataByProdi as $angkatan => $value){
                array_push($dataAngkatan, $value);
            }
            $totalPesertaChart->dataset($prodi, 'column', $dataAngkatan);
        }

        $totalTimChart->labels($dataTotalTim["label"]);
        $totalTimChart->dataset('Total Tim', 'pie', $dataTotalTim["value"])->color($dataTotalTim["color"]);

        $kategorisOrmawa = collect();
        if (Auth::user() && Auth::user()->id_ormawa) {
            $kategorisOrmawa = Kategori::where('id_ormawa', Auth::user()->id_ormawa)
                ->withCount('tims')
                ->get();
        }

        return view('admin.pages.dashboard', compact('totalTimChart', 'totalPesertaChart', 'kategorisOrmawa'));
    }

    public function toggleKategoriStatus(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        if (Auth::user()->id_ormawa && $kategori->id_ormawa != Auth::user()->id_ormawa) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Anda tidak memiliki hak akses untuk mengubah status lomba ini.'], 403);
            }
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses untuk mengubah status lomba ini.');
        }

        $kategori->is_open = !$kategori->is_open;
        $kategori->save();

        $statusText = $kategori->is_open ? 'dibuka' : 'ditutup';
        $message = 'Pendaftaran lomba ' . $kategori->nama_kategori . ' berhasil ' . $statusText . '.';

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'is_open' => (bool)$kategori->is_open,
                'status_text' => $kategori->is_open ? 'Terbuka' : 'Ditutup',
                'message' => $message,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function toggleAllKategoriStatus(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->id_ormawa) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Ormawa tidak valid.'], 400);
            }
            return redirect()->back()->with('error', 'Ormawa tidak valid.');
        }

        $targetStatus = $request->input('status', 0) == 1 ? 1 : 0;
        Kategori::where('id_ormawa', $user->id_ormawa)->update(['is_open' => $targetStatus]);

        $statusText = $targetStatus == 1 ? 'dibuka' : 'ditutup';
        $message = 'Seluruh pendaftaran lomba ormawa berhasil ' . $statusText . '.';

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'is_open' => (bool)$targetStatus,
                'message' => $message,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function ChangePassword(){
      return view('auth.passwords.change');
    }
    public function PostPassword(Request $request){
        $id = $request['user'];
        $user = User::findOrFail($id);
        if( $user && strlen($request['password'])>= 8 ){
            $user->update([
              'password' => Hash::make($request['password']),
            ]);
            return redirect()->route('admin.dashboard')->with('success', 'Kata sandi berhasil diubah');
        }else{
            return redirect()->route('admin.dashboard')->with('error', 'Kesalahan dalam mengubah sandi');
        }
    }
}
