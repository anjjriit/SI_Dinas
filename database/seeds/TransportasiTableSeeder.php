<?php

use Illuminate\Database\Seeder;

class TransportasiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transportasi')->delete();

        $now = Carbon\Carbon::now();

        DB::table('transportasi')->insert([
        	'nama_transportasi'	=> 'Travel',
        	'created_at'		=> $now,
        	'update_at'			=> $now,
        ]);

        DB::table('transportasi')->insert([
        	'nama_transportasi'	=> 'Mobil Dinas',
        	'created_at'		=> $now,
        	'update_at'			=> $now,
        ]);

        DB::table('transportasi')->insert([
        	'nama_transportasi'	=> 'Pesawat',
        	'created_at'		=> $now,
        	'update_at'			=> $now,
        ]);

        DB::table('transportasi')->insert([
        	'nama_transportasi'	=> 'Kereta Api',
        	'created_at'		=> $now,
        	'update_at'			=> $now,
        ]);

        DB::table('transportasi')->insert([
        	'nama_transportasi'	=> 'Ojek',
        	'created_at'		=> $now,
        	'update_at'			=> $now,
        ]);
    }
}
