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

        $now = date('Y-m-d H:i:s');

        DB::table('kota')->insert([
        	'nama_kota' => 'Bandung',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('kota')->insert([
        	'nama_kota' => 'Jakarta Pusat',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('kota')->insert([
        	'nama_kota' => 'Semarang',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('kota')->insert([
        	'nama_kota' => 'Jakarta Barat',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('kota')->insert([
        	'nama_kota' => 'Tanggerang',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('kota')->insert([
        	'nama_kota' => 'Depok',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('kota')->insert([
        	'nama_kota' => 'Bekasi',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);
    }
}
