<?php

use League\Csv\Reader;
use League\Csv\Statement;
use App\Repositories\CityRepository; 
use App\Repositories\ProvinceRepository;
use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param  Statement $stmt CSV statement class
     * @return void
     */
    public function run(CityRepository $cityRepository, ProvinceRepository $provinceRepository, Statement $stmt): void
    {
        //
    }
}
