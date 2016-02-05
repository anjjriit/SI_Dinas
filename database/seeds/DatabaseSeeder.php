<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PegawaiTableSeeder::class);
        $this->call(KotaTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(PelatihanTableSeeder::class);
        $this->call(JenisBiayaTableSeeder::class);
        $this->call(ProspekTableSeeder::class);
        //$this->call(RpdSeeder::class);
        $this->call(PenginapanTableSeeder::class);
        $this->call(TransportasiTableSeeder::class);
        $this->call(SettingTableSeeder::class);

        Model::reguard();
    }
}
