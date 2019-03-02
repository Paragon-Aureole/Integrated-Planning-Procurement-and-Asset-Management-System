<?php

use Illuminate\Database\Seeder;
use App\MeasurementUnit;


class MeasurementUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit = [

            ['unit_code'=>'VN', 'unit_description'=>'Vehicle'],
            //area
            ['unit_code'=>'CM', 'unit_description'=>'Centimeter' ],
            ['unit_code'=>'MM', 'unit_description'=>'Millimeter' ],
            ['unit_code'=>'M', 'unit_description'=>'Millimeter' ],
            ['unit_code'=>'IN', 'unit_description'=>'Inch' ],
            ['unit_code'=>'YD', 'unit_description'=>'Yard' ],
            ['unit_code'=>'FT', 'unit_description'=>'Foot' ],
            //volume
            ['unit_code'=>'G', 'unit_description'=>'Gram' ],
            ['unit_code'=>'KG', 'unit_description'=>'Kilogram' ],
            ['unit_code'=>'LTR', 'unit_description'=>'Liter' ],
            ['unit_code'=>'LB', 'unit_description'=>'Pound' ],
            ['unit_code'=>'OZ', 'unit_description'=>'Ounce' ],
            //ISO Standards for Packaging
            ['unit_code'=>'AM', 'unit_description'=>'Ampoule, non-protected' ],
            ['unit_code'=>'AP', 'unit_description'=>'Ampoule, protected' ],
            ['unit_code'=>'AV', 'unit_description'=>'Capsule' ],
            ['unit_code'=>'BA', 'unit_description'=>'Barrel' ],
            ['unit_code'=>'BC', 'unit_description'=>'Bottlecrate/Bottlerack' ],
            ['unit_code'=>'BD', 'unit_description'=>'Board' ],
            ['unit_code'=>'BE', 'unit_description'=>'Bundle' ],
            ['unit_code'=>'BG', 'unit_description'=>'Bag'],
            ['unit_code'=>'BH', 'unit_description'=>'Bunch' ],
            ['unit_code'=>'BI', 'unit_description'=>'Bin' ],
            ['unit_code'=>'BJ', 'unit_description'=>'Bucket' ],
            ['unit_code'=>'BK', 'unit_description'=>'Basket' ],
            ['unit_code'=>'BX', 'unit_description'=>'Box' ],
            ['unit_code'=>'CI', 'unit_description'=>'Canister' ],
            ['unit_code'=>'CL', 'unit_description'=>'Coil' ],
            ['unit_code'=>'CN', 'unit_description'=>'Container' ],
            ['unit_code'=>'CQ', 'unit_description'=>'Cartridge'],
            ['unit_code'=>'CS', 'unit_description'=>'Case' ],
            ['unit_code'=>'CT', 'unit_description'=>'Carton' ],
            ['unit_code'=>'CX', 'unit_description'=>'Can, cylindrical' ],
            ['unit_code'=>'CA', 'unit_description'=>'Can, rectangular' ],
            ['unit_code'=>'CY', 'unit_description'=>'Cylinder' ],
            ['unit_code'=>'CZ', 'unit_description'=>'Canvas' ],
            ['unit_code'=>'DR', 'unit_description'=>'Drum' ],
            ['unit_code'=>'DZ', 'unit_description'=>'Dozen'],
            ['unit_code'=>'EN', 'unit_description'=>'Envelope' ],
            ['unit_code'=>'FL', 'unit_description'=>'Flask' ],
            ['unit_code'=>'FR', 'unit_description'=>'Frame' ],
            ['unit_code'=>'GL', 'unit_description'=>'Container, gallon'],
            ['unit_code'=>'JG', 'unit_description'=>'Jug' ],
            ['unit_code'=>'JR', 'unit_description'=>'Jar' ],
            ['unit_code'=>'PG', 'unit_description'=>'Plate' ],
            ['unit_code'=>'PH', 'unit_description'=>'Pitcher' ],
            ['unit_code'=>'PK', 'unit_description'=>'Package/Packs'],
            ['unit_code'=>'PL', 'unit_description'=>'Pail' ],
            ['unit_code'=>'PO', 'unit_description'=>'Pouch' ],
            ['unit_code'=>'PC', 'unit_description'=>'Piece'],
            ['unit_code'=>'PU', 'unit_description'=>'Tray' ],
            ['unit_code'=>'RO', 'unit_description'=>'Roll' ],
            ['unit_code'=>'RM', 'unit_description'=>'Ream' ],
            ['unit_code'=>'SA', 'unit_description'=>'Sack' ],
            ['unit_code'=>'SB', 'unit_description'=>'Slab' ],
            ['unit_code'=>'ST', 'unit_description'=>'Sheet' ],
            ['unit_code'=>'VI', 'unit_description'=>'Vial' ],
            ['unit_code'=>'UN', 'unit_description'=>'Unit'],
            
      ];

      //['unit_code'=>'', 'unit_description'=>'' ],

      foreach ($unit as $key => $units) {
            # code...
            MeasurementUnit::create($units);
      }
    }
}
