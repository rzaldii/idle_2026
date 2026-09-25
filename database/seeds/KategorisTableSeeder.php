<?php

use Illuminate\Database\Seeder;

class KategorisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoris =
            [
                'Himasif' => [
                    ['PPL', 'ppl'],
                    ['Smart City', 'smart-city'],
                    ['Bisnis TIK', 'bisnis-tik']
                ],

                'Himatif' => [
                    ['UI/UX', 'uiux'],
                    ['Game Development', 'game-dev'],
                    ['Animasi', 'animasi'],
                    ['IOT', 'iot']
                ],

                'Hmif' => [
                    ['CPC', 'cpc'],
                    ['KTI', 'kti'],
                ],

                'Laos' => [
                    ['CTF', 'ctf']
                ]
            ];

        foreach($kategoris as $ormawa => $kategori){
            foreach($kategori as $k){
                DB::table('kategoris')->insert([
                    'id_ormawa' => \App\Ormawa::where('nama_ormawa' , $ormawa)->first()->id,
                    'nama_kategori' => $k[0],
                    'kategori' => $k[1],
                ]);
            }
        }
    }
}
