<?php

use Illuminate\Database\Seeder;
use App\assetType;

class assetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assetType = [
            [ 'type_name'=>'vehicle'],
            [ 'type_name'=>'Office Supplies'],
            [ 'type_name'=>'Furniture and Fixtures'],
            [ 'type_name'=>'IT Equipments']
        ];

        foreach ($assetType as $key => $assetTypes) {
            # code...
            assetType::create($assetTypes);
      };

    }
}
