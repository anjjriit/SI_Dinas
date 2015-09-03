<?php

use Illuminate\Database\Seeder;

class KotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kota')->delete();

        DB::table('kota')->insert([
        	'nama_kota' => 'Bandung',
        ]);

        DB::table('kota')->insert([
        	'nama_kota' => 'Jakarta Pusat',
        ]);

        DB::table('kota')->insert([
        	'nama_kota' => 'Semarang',
        ]);

        DB::table('kota')->insert([
        	'nama_kota' => 'Jakarta Barat',
        ]);

        DB::table('kota')->insert([
        	'nama_kota' => 'Tanggerang',
        ]);

        DB::table('kota')->insert([
        	'nama_kota' => 'Depok',
        ]);

        DB::table('kota')->insert([
        	'nama_kota' => 'Bekasi',
        ]);
    }
}
