<?php

use Illuminate\Database\Seeder;

class PelatihanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelatihan')->delete();

        DB::table('pelatihan')->insert([
        	'nama_pelatihan' 	=> 'Pelatihan Blog untuk Anak',
        	'nama_lembaga'		=> 'Startup Muda',
        	'tanggal_mulai' 	=> '2015-08-09',
        	'tanggal_selesai'	=> '2015-08-20',
        	'alamat'			=> 'Jalan Asia Afrika No 20',
        ]);

        DB::table('pelatihan')->insert([
        	'nama_pelatihan' 	=> 'Pelatihan BPPTIK',
        	'nama_lembaga'		=> 'BPPTIK Tanggerang',
        	'tanggal_mulai' 	=> '2015-09-09',
        	'tanggal_selesai'	=> '2015-09-20',
        	'alamat'			=> 'Jalan Lingkar No 20',
        ]);

        DB::table('pelatihan')->insert([
        	'nama_pelatihan' 	=> 'Pelatihan Kemenpora',
        	'nama_lembaga'		=> 'Kemenpora',
        	'tanggal_mulai' 	=> '2015-10-09',
        	'tanggal_selesai'	=> '2015-10-20',
        	'alamat'			=> 'Jalan Lembang No 20',
        ]);

        DB::table('pelatihan')->insert([
        	'nama_pelatihan' 	=> 'Pelatihan Sistem Kepegawaian',
        	'nama_lembaga'		=> 'PT. Gudang',
        	'tanggal_mulai' 	=> '2015-11-09',
        	'tanggal_selesai'	=> '2015-11-20',
        	'alamat'			=> 'Komplek Permata No 20',
        ]);

        DB::table('pelatihan')->insert([
        	'nama_pelatihan' 	=> 'Pelatihan Sistem Informasi Pelatihan',
        	'nama_lembaga'		=> 'BPPTIK',
        	'tanggal_mulai' 	=> '2015-12-09',
        	'tanggal_selesai'	=> '2015-12-20',
        	'alamat'			=> 'Komplek Ciptamas No 20',
        ]);
    }
}
