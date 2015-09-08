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

        $now = date('Y-m-d H:i:s');

        DB::table('pegawai')->insert([
            'nik' => '100000000',
            'nama_lengkap' => 'Super Administrator',
            'email' => 'admin@javan.co.id',
            'password' => bcrypt('admin'),
            'role' => 'super_admin',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('pegawai')->insert([
            'nik' => '100000001',
            'nama_lengkap' => 'Sup Admin',
            'email' => 'supadmin@javan.co.id',
            'password' => bcrypt('supadmin'),
            'role' => 'super_admin',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('pegawai')->insert([
            'nik' => '100000002',
            'nama_lengkap' => 'Frans Xaverius',
            'email' => 'frans@javan.co.id',
            'password' => bcrypt('frans'),
            'role' => 'employee',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('pegawai')->insert([
            'nik' => '100000003',
            'nama_lengkap' => 'Giovani Gani',
            'email' => 'gio@javan.co.id',
            'password' => bcrypt('gio'),
            'role' => 'employee',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('pegawai')->insert([
            'nik' => '100000004',
            'nama_lengkap' => 'Reynaldi Sunaryo',
            'email' => 'rey@javan.co.id',
            'password' => bcrypt('rey'),
            'role' => 'administration',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('pegawai')->insert([
            'nik' => '100000005',
            'nama_lengkap' => 'Tommy Putra',
            'email' => 'tommy@javan.co.id',
            'password' => bcrypt('tommy'),
            'role' => 'Finance',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);
    }
}
