<?php

use Illuminate\Database\Seeder;
use App\assetType;

class AssetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assetType = [
            ['type_name'=>'Vehicle'],
            ['type_name'=>'Office Supplies'],
            ['type_name'=>'Furniture and Fixtures'],
            ['type_name'=>'IT Equipments']
        ];

        foreach ($assetType as $key => $assetTypeValue) {
            assetType::create($assetTypeValue);
        };
    }
}
