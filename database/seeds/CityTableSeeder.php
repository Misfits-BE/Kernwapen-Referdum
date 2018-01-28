<?php

use App\Repositories\CityRepository;
use App\Repositories\ProvinceRepository;
use Illuminate\Database\Seeder;
use League\Csv\Reader;
use League\Csv\Statement;

/**
 * Database seeder voor de gemeentes in belgie
 * 
 * @author      Tim Joosteb <tim@activisme.be>
 * @copyright   2018 Tim Joosten 
 */
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
        $csv = Reader::createFromPath(database_path('seeds/sources/belgian-cities.csv'), 'r');
        $csv->setheaderOffset(0);

        foreach ($stmt->process($csv) as $record) {
            $province = $provinceRepository->seedCreate(['name' => $record['province']]);
            
            // Creer een nieuwe stad.
            $cityRepository->seedCreate([
                // Stads informatie.
                'province_id' => $province->id,
                'postal'      => $record['postal'],
                'name'        => $record['name'],
                'lat'         => $record['lat'],
                'lng'         => $record['lng']
            ]);
        }
    }
}
