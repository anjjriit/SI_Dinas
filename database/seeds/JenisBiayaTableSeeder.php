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

        DB::table('jenis_biaya_pengeluaran_standard')->insert([
        	'nama_jenis' 	=> 'Makan per orang per hari',
        	'biaya' 		=> '100000',
        ]);

        DB::table('jenis_biaya_pengeluaran_standard')->insert([
        	'nama_jenis' 	=> 'Tranportasi per orang',
        	'biaya' 		=> '200000',
        ]);

        DB::table('jenis_biaya_pengeluaran_standard')->insert([
        	'nama_jenis' 	=> 'Cemilan per orang',
        	'biaya' 		=> '50000',
        ]);

        DB::table('jenis_biaya_pengeluaran_standard')->insert([
        	'nama_jenis' 	=> 'Penginapan per orang per hari',
        	'biaya' 		=> '250000',
        ]);
    }
}
