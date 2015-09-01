<?php

use Illuminate\Database\Seeder;

class PegawaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawai')->delete();

        DB::table('pegawai')->insert([
            'nik' => '100000000',
            'nama_lengkap' => 'Super Administrator',
            'email' => 'admin@javan.co.id',
            'password' => bcrypt('admin'),
            'role' => 'super_admin',
        ]);
    }
}
