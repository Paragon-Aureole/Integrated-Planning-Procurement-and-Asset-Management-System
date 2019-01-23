<?php

use Illuminate\Database\Seeder;
use App\Office;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $offices = [
        	[
                'office_code' => "ICT",
                'office_name' => "Information Technology Section",
                'category' => '2',
                 
            ],
            [   
                'office_code' => "ADM",
                'office_name' => "Office of the City Administrator",
                'category' => '1',
                 
            ],
            [
                'office_code' => "BFP",
                'office_name' => "Bureau of Fire Protection",
                'category' => '1',
                 
            ],
            [   
                'office_code' => "DILG",
                'office_name' => "City Department of Interior and Local Government",
                'category' => '1',
                 
            ],          
            [
                'office_code' => "EEM",
                'office_name' => "City Market Office",
                'category' => '1',
                 
            ],
            [   
                'office_code' => "COC",
                'office_name' => "Clerk of Court",
                'category' => '1',
                 
            ],
            [   
                'office_code' => "COMELEC",
                'office_name' => "Commission on Elections",
                'category' => '1',
                 
            ],

            [
                'office_code' => "COA",
                'office_name' => "Commision on Audit",
                'category' => '1',
                 
            ],
            [
                'office_code' => "MTCCB1",
                'office_name' => "Court Branch 1",
                'category' => '1',
                 
            ],

            [
                'office_code' => "MTCCB2",
                'office_name' => "Court Branch 2",
                'category' => '1',
                 
            ],
            [
                'office_code' => "DEPED",
                'office_name' => "Department of Education",
                'category' => '1',
                 
            ],
            [
                'office_code' => "ELEC",
                'office_name' => "Electrical Office",
                'category' => '1',
                 
            ],
            [
                'office_code' => "EAS",
                'office_name' => "Engineering and Architectural Services",
                'category' => '1',
                 
            ],
            [       
                'office_code' => "HRM",
                'office_name' => "Human Resource Management Office",
                'category' => '1',
                 
            ],
            [   
                'office_code' => "IDS",
                'office_name' => "Information Dissemination Section",
                'category' => '1',
                 
            ],
            [       
                'office_code' => "LUSCM",
                'office_name' => "La Union Science Centrum and Museum",
                'category' => '1',
                 
            ],
            [   
                'office_code' => "LNMB",
                'office_name' => "Liga ng mga Barangay",
                'category' => '1',
                 
            ],
            [
                'office_code' => "LEBDO",
                'office_name' => "Local Economic, Business and Dev't Office",
                'category' => '1',
                 
            ],
            [
                'office_code' => "OSM",
                'office_name' => "Office for Strategy Management",
                'category' => '1',
                 
            ],
            [
                'office_code' => "ACA",
                'office_name' => "Office of the City Accountant",
                'category' => '1',
                 
            ],
            [
                'office_code' => "AGR",
                'office_name' => "Office of the City Agriculturist",
                'category' => '1',
                 
            ],
            [
                'office_code' => "OCA",
                'office_name' => "Office of the City Assesor",
                'category' => '1',
                 
            ],
            [
                'office_code' => "CBO",
                'office_name' => "Office of the City Budget Officer",
                'category' => '1',
                 
            ],
            [
                'office_code' => "ENR",
                'office_name' => "Office of the City Environment and Natural Resources Officer",
                'category' => '1',
                 
            ],
            [
                'office_code' => "GSO",
                'office_name' => "Office of the City General Sercices Officer",
                'category' => '1',
                 
            ],
            [
                'office_code' => "CHO",
                'office_name' => "Office of the City Health Officer",
                'category' => '1',
                 
            ],
            [
                'office_code' => "CLO",
                'office_name' => "Office of the City Legal Officer",
                'category' => '1',
                 
            ],
            [
                'office_code' => "LIB",
                'office_name' => "Office of the City Library",
                'category' => '1',
                 
            ],
            [
                'office_code' => "OCM",
                'office_name' => "Office of the City Mayor",
                'category' => '1',
                 
            ],
            [
                'office_code' => "PDO",
                'office_name' => "Office of the City Planning and Development Coordinator",
                'category' => '1',
                 
            ],
            [
                'office_code' => "REG",
                'office_name' => "Office of the City Registrar",
                'category' => '1',
                 
            ],
            [
                'office_code' => "SWD",
                'office_name' => "Office of the Social Welfare and Development Officer",
                'category' => '1',
                 
            ],
            [
                'office_code' => "CTO",
                'office_name' => "Office of the City Treasurer",
                'category' => '1',
                 
            ],
            [
                'office_code' => "CVO",
                'office_name' => "Office of the City Veterenarian",
                'category' => '1',
                 
            ],
            [
                'office_code' => "OCVM",
                'office_name' => "Office of the City Vice-Mayor",
                'category' => '1',
                 
            ],
            [
                'office_code' => "OPS",
                'office_name' => "Office of the Public Safety",
                'category' => '1',
                 
            ],
            [
                'office_code' => "OSP",
                'office_name' => "Office of the Sangguniang Panlungsod",
                'category' => '1',
                 
            ],
            [
                'office_code' => "OSSP",
                'office_name' => "Office of the Secretary to the Sangguniang Panlungsod",
                'category' => '1',
                 
            ],
            [
                'office_code' => "OSCA",
                'office_name' => "Office of the Senior Citizen",
                'category' => '1',
                 
            ],
            [
                'office_code' => "PNP",
                'office_name' => "Philippine National Police",
                'category' => '1',
                 
            ],
            [
                'office_code' => "PACU",
                'office_name' => "Public Assistance and Complaints Unit",
                'category' => '1',
                 
            ],
        ];

        foreach($offices as $office){
            Office::create($office);
        }

        Schema::enableForeignKeyConstraints();
    }
}
