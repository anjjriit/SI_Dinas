<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->delete();

        DB::table('setting')->insert([
            'key'           => 'company_name',
            'value'         => 'JAVAN CIPTA SOLUSI',
        ]);

        DB::table('setting')->insert([
            'key'           => 'address_line_1',
            'value'         => 'Terusan Jalan Jakarta Komplek Daichi No 55',
        ]);

        DB::table('setting')->insert([
            'key'           => 'address_line_2',
            'value'         => 'Bandung, Jawa Barat, Indonesia',
        ]);

        DB::table('setting')->insert([
            'key'           => 'phone_number',
            'value'         => '(022) 87831878',
        ]);

        DB::table('setting')->insert([
            'key'           => 'email',
            'value'         => 'info@javan.co.id',
        ]);

        DB::table('setting')->insert([
            'key'           => 'website',
            'value'         => 'http://www.javan.co.id',
        ]);
    }
}
