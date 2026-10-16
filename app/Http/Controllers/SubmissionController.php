<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Submission;
use App\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function getPageSubmit($token)
    {
        $kategoris = Kategori::get();
        $tim = Tim::with('kategori')
            ->where('submissionid', $token)->get()->first();
        $kategori = Kategori::with('tims')
            ->where('id', $tim->id_kategori)->get()->first();
        if ($tim == null) {
            abort(404);
        }
        $submission = Submission::where('token', $token)->orderBy('created_at', 'desc')->first();

        if ($tim->babak == 1) {
            return view('pages.submission_1', compact('kategoris', 'kategori', 'tim', 'submission'));
        } elseif ($tim->babak == 2) {
            return view('pages.submission_2', compact('kategoris', 'kategori', 'tim', 'submission'));
        } else {
            return view('pages.submission_3', compact('kategoris', 'kategori', 'tim', 'submission'));
        }
    }

    public function submitFile(Request $request, $token)
    {
        $tim = Tim::with('kategori')
            ->where('submissionid', $token)->first();
        if (!$tim) {
            abort(404);
        }

        $customMessages = [
            'file.required' => 'File pengumpulan wajib diunggah.',
            'file.max' => 'Ukuran file melebihi batas maksimal 10 MB.',
            'file.mimes' => 'Format file harus berupa PDF, ZIP, atau RAR.',
            'judul.required' => 'Judul karya wajib diisi.',
            'judul.max' => 'Judul karya maksimal 255 karakter.',
            'file_proposal.required' => 'File Proposal Revisi (PDF) wajib diunggah.',
            'file_proposal.max' => 'Ukuran file Proposal Revisi melebihi batas maksimal 10 MB.',
            'file_proposal.mimes' => 'Format file Proposal Revisi harus berupa PDF.',
            'file_ppt.required' => 'File PPT / Presentasi (PDF) wajib diunggah.',
            'file_ppt.max' => 'Ukuran file PPT / Presentasi melebihi batas maksimal 10 MB.',
            'file_ppt.mimes' => 'Format file PPT / Presentasi harus berupa PDF.',
        ];

        // Tentukan folder dan proses berdasarkan babak
        if ($tim->babak == 1) {
            $request->validate([
                'file' => 'required|file|max:11263|mimes:pdf,zip,rar', // max ~10.9MB (< 11MB)
                'judul' => 'required|string|max:255',
            ], $customMessages);

            $sub = Submission::createSubmissionPenyisihan1(
                $tim->id,
                $request->judul,
                "submission-1",
                $token,
                $request->file('file')
            );
        } elseif ($tim->babak == 2) {
            if ($tim->id_kategori == 2) {
                $request->validate([
                    'judul' => 'required|string|max:255',
                    'link' => 'required|string|max:255',
                    'link2' => 'required|string|max:255',
                ]);

                $data = json_encode(['link' => $request->link]);
                $path = json_encode(['link2' => $request->link2]);

                $sub = Submission::createSubmissionPenyisihan2(
                    $tim->id,
                    $request->judul,
                    $path,
                    $data,
                    $token
                );
            } else {
                $request->validate([
                    'file' => 'required|file|max:11263|mimes:pdf,zip,rar',
                    'judul' => 'required|string|max:255',
                    'link' => 'nullable|string|max:255',
                ], $customMessages);

                $data = json_encode(['link' => $request->link]);

                $sub = Submission::createSubmissionPenyisihan2(
                    $tim->id,
                    $request->judul,
                    "submission-2",
                    $data,
                    $token,
                    $request->file('file')
                );
            }
        } else { // final
            if ($tim->kategori && $tim->kategori->id_ormawa == 2) {
                // Khusus ITeC: 2 file PDF (Proposal Revisi & PPT Presentasi)
                $request->validate([
                    'judul' => 'required|string|max:255',
                    'file_proposal' => 'required|file|max:11263|mimes:pdf',
                    'file_ppt' => 'required|file|max:11263|mimes:pdf',
                ], $customMessages);

                $sub = Submission::createSubmissionFinalITeC(
                    $tim->id,
                    $request->judul,
                    "submission-final",
                    $token,
                    $request->file('file_proposal'),
                    $request->file('file_ppt')
                );
            } else {
                $request->validate([
                    'file' => 'required|file|max:11263|mimes:pdf,zip,rar',
                    'judul' => 'required|string|max:255',
                ], $customMessages);

                $sub = Submission::createSubmissionFinal(
                    $tim->id,
                    $request->judul,
                    "submission-final",
                    $token,
                    $request->file('file')
                );
            }
        }

        if ($sub) {
            return redirect()->route('kompetisi.submit.index', ['token' => $token])->with('success', 'Upload Berhasil Disimpan');
        } else {
            return redirect()->back()->with('error', 'Upload Gagal');
        }
    }
}
