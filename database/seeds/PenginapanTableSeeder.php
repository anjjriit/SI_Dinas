<?php

use Illuminate\Database\Seeder;

class PenginapanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penginapan')->delete();

        $now = date('Y-m-d H:i:s');

        DB::table('penginapan')->insert([
        	'nama_penginapan'	=> 'Kost',
        	'biaya' 			=> '800000',
        	'created_at'		=> $now,
        	'updated_at'		=> $now,
        ]);

        DB::table('penginapan')->insert([
        	'nama_penginapan'	=> 'Hotel Aston',
        	'biaya' 			=> '800000',
        	'created_at'		=> $now,
        	'updated_at'		=> $now,
        ]);

        DB::table('penginapan')->insert([
        	'nama_penginapan'	=> 'Hotel Hilton',
        	'biaya' 			=> '1000000',
        	'created_at'		=> $now,
        	'updated_at'		=> $now,
        ]);

        DB::table('penginapan')->insert([
        	'nama_penginapan'	=> 'Guest House',
        	'biaya' 			=> '500000',
        	'created_at'		=> $now,
        	'updated_at'		=> $now,
        ]);
    }
}
