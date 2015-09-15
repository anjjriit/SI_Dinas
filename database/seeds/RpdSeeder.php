<?php

use Illuminate\Database\Seeder;
use Carbon;

class RpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rpd')->delete();
        DB::table('peserta')->delete();
        DB::table('sarana_transportasi')->delete();
        DB::table('action_history_pengajuan')->delete();

        //Carbon::now()

        DB::table('rpd')->insert([
        	'nik' => '100000001',
        	'kategori' => 'trip',
        	'jenis_perjalanan' => '',
        	'tanggal_mulai' => '',
        	'tanggal_selesai' => '',
        	'kode_kota_asal' => '',
        	'kode_kota_tujuan' => '',
        	'sarana_penginapan' => '',
        	'akomodasi_awal' => '',
        	'keterangan' => '',
        	'status' => '',
        	'created_at' => '',
        	'updated_at' => '',
        ]);

        DB::table('peserta')->insert([
        	'id_rpd' => '',
        	'nik_peserta' => '',
        	'jenis_kegiatan' => '',
        	'kode_kegiatan' => '',
        	'kegiatan' => '',
        	'created_at' => '',
        	'updated_at' => '',

        ]);

        DB::table('sarana_transportasi')->insert([
        	'id_rpd' => '',
        	'nama_transportasi' => '',
        	'created_at' => '',
        	'updated_at' => '',
        ]);

        DB::table('action_history_pengajuan')->insert([
        	'id_rpd' => '',
        	'nik' => '',
        	'action' => '',
        	'comment' => '',
        	'created_at' => '',
        	'updated_at' => '',
        ]);
    }
}
