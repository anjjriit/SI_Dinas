<?php

use Illuminate\Database\Seeder;

class JenisBiayaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_biaya_pengeluaran_standard')->delete();

        $now = date('Y-m-d H:i:s');

        DB::table('jenis_biaya_pengeluaran_standard')->insert([
        	'nama_jenis' 	=> 'Makan (per orang per hari)',
        	'biaya' 		=> '90000',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('jenis_biaya_pengeluaran_standard')->insert([
        	'nama_jenis' 	=> 'Mobil Dinas (PP)',
        	'biaya' 		=> '300000',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('jenis_biaya_pengeluaran_standard')->insert([
        	'nama_jenis' 	=> 'Travel (PP)',
        	'biaya' 		=> '200000',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('jenis_biaya_pengeluaran_standard')->insert([
        	'nama_jenis' 	=> 'Kereta (PP)',
        	'biaya' 		=> '275000',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('jenis_biaya_pengeluaran_standard')->insert([
            'nama_jenis'    => 'Pesawat (PP)',
            'biaya'         => '700000',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('jenis_biaya_pengeluaran_standard')->insert([
            'nama_jenis'    => 'Kostan (per orang per hari)',
            'biaya'         => '50000',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('jenis_biaya_pengeluaran_standard')->insert([
            'nama_jenis'    => 'Guest House (per orang per hari)',
            'biaya'         => '120000',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('jenis_biaya_pengeluaran_standard')->insert([
            'nama_jenis'    => 'Hotel (per orang per hari)',
            'biaya'         => '400000',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);
    }
}
