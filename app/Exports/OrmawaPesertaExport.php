<?php

namespace App\Exports;

use App\Kategori;
use App\Tim;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrmawaPesertaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    public $id_ormawa;

    public function __construct($id_ormawa = null)
    {
        $this->id_ormawa = $id_ormawa;
    }

    public function collection()
    {
        $kategoriQuery = Kategori::query();
        if ($this->id_ormawa) {
            $kategoriQuery->where('id_ormawa', $this->id_ormawa);
        }
        $kategoriIds = $kategoriQuery->pluck('id');

        $tims = Tim::with(['pesertas.mahasiswa', 'kategori'])
            ->whereIn('id_kategori', $kategoriIds)
            ->get();

        $result = [];
        $no = 1;
        foreach ($tims as $tim) {
            foreach ($tim->pesertas as $peserta) {
                if (!$peserta->mahasiswa) {
                    continue;
                }
                $temp = new \stdClass();
                $temp->no = $no++;
                $temp->nim = $peserta->mahasiswa->nim;
                $temp->nama = $peserta->mahasiswa->nama;
                $temp->nama_tim = $tim->nama_tim;
                $temp->kategori = $tim->kategori->nama_kategori ?? '-';
                $temp->email = $peserta->mahasiswa->email;
                $temp->no_hp = $peserta->mahasiswa->no_hp;
                $result[] = $temp;
            }
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            'No',
            'NIM',
            'Nama',
            'Nama Tim',
            'Kategori/Bidang',
            'Email',
            'No HP'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => '@',
            'G' => '@'
        ];
    }
}
