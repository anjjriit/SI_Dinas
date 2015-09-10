<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project')->delete();

        $now = date('Y-m-d H:i:s');
        
        DB::table('project')->insert([
        	'nama_project' 		=> 'Website Startup Muda',
        	'nama_lembaga'		=> 'Startup Muda',
        	'tanggal_mulai' 	=> '2015-08-05',
        	'tanggal_selesai'	=> '2015-08-30',
        	'alamat'			=> 'Jalan Asia Afrika No 20',
            'created_at'        => $now,
            'updated_at'        => $now,
        ]);

        DB::table('project')->insert([
        	'nama_project' 		=> 'Website E-Commerce HijabAlya',
        	'nama_lembaga'		=> 'Hijab Alya',
        	'tanggal_mulai' 	=> '2015-04-05',
        	'tanggal_selesai'	=> '2015-05-30',
        	'alamat'			=> 'Komplek Permata Blok A No 10',
            'created_at'        => $now,
            'updated_at'        => $now,
        ]);

        DB::table('project')->insert([
        	'nama_project' 		=> 'Sistem Informasi Perpustakaan',
        	'nama_lembaga'		=> 'SMP Al-Azhar',
        	'tanggal_mulai' 	=> '2015-09-05',
        	'tanggal_selesai'	=> '2015-10-30',
        	'alamat'			=> 'Jalan Van de Venter No 20',
            'created_at'        => $now,
            'updated_at'        => $now,
        ]);

        DB::table('project')->insert([
        	'nama_project' 		=> 'Sistem Informasi Perpustakaan',
        	'nama_lembaga'		=> 'SD Bina Islam',
        	'tanggal_mulai' 	=> '2015-07-05',
        	'tanggal_selesai'	=> '2015-08-30',
        	'alamat'			=> 'Jalan Patuha No 20',
            'created_at'        => $now,
            'updated_at'        => $now,
        ]);

        DB::table('project')->insert([
        	'nama_project' 		=> 'Website E-Commerce Sign Fashion',
        	'nama_lembaga'		=> 'Sign Fashion',
        	'tanggal_mulai' 	=> '2015-10-05',
        	'tanggal_selesai'	=> '2015-10-30',
        	'alamat'			=> 'Komplek Alia Blok 3 No 20',
            'created_at'        => $now,
            'updated_at'        => $now,
        ]);
    }
}
