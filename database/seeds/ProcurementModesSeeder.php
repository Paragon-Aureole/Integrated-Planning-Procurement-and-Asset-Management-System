<?php

use Illuminate\Database\Seeder;
use App\ProcurementMode;

class ProcurementModesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modes = [
        	[
        		'method_code' => 'Section 49', 
        	 	'method_name' => 'limited source bidding',
        	 	 
        	],
        	[
        		'method_code' => 'Section 50', 
        	 	'method_name' => 'direct contracting',
        	 	 
        	],
        	[
        		'method_code' => 'Section 51', 
        	 	'method_name' => 'repeat order',
        	 	 
        	],
        	[
        		'method_code' => 'Section 51', 
        	 	'method_name' => 'shopping',
        	 	 
        	],
        	[
        		'method_code' => 'Section 53.1', 
        	 	'method_name' => 'two failed biddings',
        	 	 
        	],
        	[
        		'method_code' => 'Section 53.3', 
        	 	'method_name' => 'take - over of contracts',
        	 	 
        	],
        	[
        		'method_code' => 'Section 53.4', 
        	 	'method_name' => 'adjacent or contiguous',
        	 	 
        	],
        	[
        		'method_code' => 'Section 53.5', 
        	 	'method_name' => 'agency - to - agency',
        	 	 
        	],
        	[
        		'method_code' => 'Section 53.6', 
        	 	'method_name' => 'Science/Arts/Exclusive Tech./Media',
        	 	 
        	],
        	[
        		'method_code' => 'Section 53.7', 
        	 	'method_name' => 'highly technical consultants',
        	 	 
        	],
        	[
        		'method_code' => 'Section 53.8', 
        	 	'method_name' => 'defense cooperation agreement',
        	 	 
        	],
        	[
        		'method_code' => 'Section 53.9', 
        	 	'method_name' => 'small value procurement',
        	 	 
        	],
        	[
        		'method_code' => 'Section 53.10', 
        	 	'method_name' => 'lease of real property and venue',
        	 	 
        	],
        	[
        		'method_code' => 'Section 53.11', 
        	 	'method_name' => 'NGO Participation',
        	 	 
        	],
        	[
        		'method_code' => 'Section 53.12', 
        	 	'method_name' => 'Community Participation',
        	 	 
        	],
        	[
        		'method_code' => 'Section 53.13', 
        	 	'method_name' => 'UN Agencies/Other International Organizations',
        	 	 
        	],
        ];

        foreach ($modes as $key => $mode) {
        	# code...
        	ProcurementMode::create($mode);
        }
    }
}
