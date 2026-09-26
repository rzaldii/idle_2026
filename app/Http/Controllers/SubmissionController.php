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
        if ($tim->babak == 1) {
            return view('pages.submission_1', compact('kategoris', 'kategori', 'tim'));
        } elseif ($tim->babak == 2) {
            return view('pages.submission_2', compact('kategoris', 'kategori', 'tim'));
        } else {
            return view('pages.submission_3', compact('kategoris', 'kategori', 'tim'));
        }
        return $tim;
        return $token;
        // TODO : return page submit
    }

    public function submitFile(Request $request, $token)
    {
        $tim = Tim::with('kategori')
            ->where('submissionid', $token)->first();
        if (!$tim) {
            abort(404);
        }

        // Tentukan folder dan proses berdasarkan babak
        if ($tim->babak == 1) {
            $request->validate([
                'file' => 'required|file|max:5120|mimes:pdf,zip,rar', // max 5MB
                'judul' => 'required|string|max:255',
            ]);

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
                    'file' => 'required|file|max:5120|mimes:pdf,zip,rar',
                    'judul' => 'required|string|max:255',
                    'link' => 'nullable|string|max:255',
                ]);

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
            $request->validate([
                'file' => 'required|file|max:5120|mimes:pdf,zip,rar',
                'judul' => 'required|string|max:255',
            ]);

            $sub = Submission::createSubmissionFinal(
                $tim->id,
                $request->judul,
                "submission-final",
                $token,
                $request->file('file')
            );
        }

        if ($sub) {
            return redirect('/')->with('success', 'Upload Berhasil');
        } else {
            return redirect()->back()->with('error', 'Upload Gagal');
        }
    }
}
