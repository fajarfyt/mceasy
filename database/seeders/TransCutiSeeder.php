<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('trans_cuti')->insert(array(
            [
                'id_cuti' => null,
                'nomor_induk' => 'IP06001',
                'tanggal_cuti' => '2020-08-02',
                'lama_cuti' => 2,
                'Keterangan' => 'Acara Keluarga'
            ],
            [
                'id_cuti' => null,
                'nomor_induk' => 'IP06001',
                'tanggal_cuti' => '2020-08-18',
                'lama_cuti' => 2,
                'Keterangan' => 'Anak Sakit'
            ],
            [
                'id_cuti' => null,
                'nomor_induk' => 'IP06006',
                'tanggal_cuti' => '2020-08-19',
                'lama_cuti' => 1,
                'Keterangan' => 'Nenek Sakit'
            ],
            [
                'id_cuti' => null,
                'nomor_induk' => 'IP06007',
                'tanggal_cuti' => '2020-08-23',
                'lama_cuti' => 1,
                'Keterangan' => 'Sakit'
            ],
            [
                'id_cuti' => null,
                'nomor_induk' => 'IP06004',
                'tanggal_cuti' => '2020-08-29',
                'lama_cuti' => 5,
                'Keterangan' => 'Menikah'
            ],
            [
                'id_cuti' => null,
                'nomor_induk' => 'IP06003',
                'tanggal_cuti' => '2020-08-30',
                'lama_cuti' => 2,
                'Keterangan' => 'Acara Keluarga'
            ],
        ));
    }
}
