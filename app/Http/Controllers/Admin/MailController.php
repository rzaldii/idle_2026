<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kategori;
use App\Mahasiswa;
use App\Peserta;
use App\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ParticipationMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function getMailPage()
    {
        $kategoris = Kategori::select('id')
            ->where('id_ormawa', Auth::user()->id_ormawa)
            ->get();

        $tims = [];
        foreach ($kategoris as $kategori) {
            $tim = Tim::select('id', 'nama_tim')
                ->where('id_kategori', $kategori->id)
                ->get();
            foreach ($tim as $t) {
                array_push($tims, $t);
            }
        }

        $mahasiswas = Mahasiswa::select('nim', 'nama', 'email')->get();
        return view('admin.pages.mail', compact('tims', 'mahasiswas'));
    }

    public function sendMailMahasiswa(Request $request)
    {
        $text = $request->pesan;
        $mailer = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $emails = $request->emails ?? [];
        foreach ($emails as $email) {
            $mhs = Mahasiswa::where('email', $email)->first();
            $nama = $mhs ? $mhs->nama : 'Peserta';
            try {
                $mailer->send('mails.send', compact('text', 'nama'), function ($message) use ($email) {
                    $message
                        ->from(config('mail.from.address'), config('mail.from.name'))
                        ->to($email)
                        ->subject('Pesan dari IDLe');
                });
                \Log::info('Email broadcast berhasil dikirim ke mahasiswa: ' . $email);
            } catch (\Exception $e) {
                \Log::error('Gagal kirim email mahasiswa ke ' . $email . ': ' . $e->getMessage());
            }
        }
        return redirect()->route('admin.mail.page')->with('success', 'Pesan berhasil dikirim');
    }

    public function sendMailTim(Request $request)
    {
        $mailer = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $text = $request->pesan;
        $tims = $request->tims ?? [];
        foreach ($tims as $t) {
            $tim = Tim::with('pesertas.mahasiswa')->find($t);
            if (!$tim) {
                continue;
            }
            foreach ($tim->pesertas as $peserta) {
                if (!$peserta->mahasiswa || empty($peserta->mahasiswa->email)) {
                    continue;
                }
                $nama = $peserta->mahasiswa->nama;
                $email = trim($peserta->mahasiswa->email);
                try {
                    $mailer->send('mails.send', compact('text', 'nama'), function ($message) use ($email) {
                        $message
                            ->from(config('mail.from.address'), config('mail.from.name'))
                            ->to($email)
                            ->subject('Pesan dari IDLe');
                    });
                    \Log::info('Email broadcast berhasil dikirim ke tim ' . $tim->nama_tim . ' (' . $email . ')');
                } catch (\Exception $e) {
                    \Log::error('Gagal kirim email tim ke ' . $email . ': ' . $e->getMessage());
                }
            }
        }
        return redirect()->route('admin.mail.page')->with('success', 'Pesan berhasil dikirim');
    }

    public function sendMailTimParticipation(Request $request)
    {
        $text = $request->pesan;
        $data = [
                'pengirim'=> strtolower(Auth::user()->name) . '@idle-unej.my.id'
                ];
        foreach ($request->tims as $t) {
            $tim = Tim::with('pesertas.mahasiswa')
                ->findOrFail($t);
            $data['tim'] = $tim;
            $data['kategori'] = $tim->kategori->nama_kategori;
            $mahasiswa= [];
            foreach ($tim->pesertas as $peserta) {
              array_push($mahasiswa, $peserta->mahasiswa);
            }
            $data['peserta'] = $mahasiswa;
            foreach ($tim->pesertas as $peserta) {
              $email = $peserta->mahasiswa->email;
              Mail::to($email)->send(new ParticipationMail([$data]));
            }
        }
        return redirect()->route('admin.mail.page')->with('success', 'Pesan berhasil dikirim');
    }

    public function testing()
    {
        $mailer = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $kode = md5('kontol');
        $kategori = Kategori::with('ormawa')->find(1);
        $email = '222410101050@mail.unej.ac.id';
        $tim = Tim::find(30);
        $mailer->send('mails.daftar', compact('tim', 'kategori', 'kode'), function ($message) use ($email, $kategori) {
            $message
                ->from('_mainaccount@idlefasilkom.blog')
                ->to($email)
                ->subject('Pendaftaran IDLe');
        });

    }
}
