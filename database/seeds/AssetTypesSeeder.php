<?php

use Illuminate\Database\Seeder;
use App\assetType;

class AssetTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_names = [
            [ 'type_name'=>'vehicle'],
            [ 'type_name'=>'Office Supplies'],
            [ 'type_name'=>'Furniture and Fixtures'],
            [ 'type_name'=>'IT Equipments'],
        ];

        foreach ($type_names as $key => $asset_types) {
            # code...
            assetType::create($asset_types);
      };
    }
}
