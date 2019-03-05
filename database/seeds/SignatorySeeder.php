<?php

use Illuminate\Database\Seeder;
use App\Signatory;

class SignatorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $signatories = [
        	//department heads
        	[
        		'office_id' => '1',
        		'signatory_name' => 'Germe O. Deang',
        		'signatory_position' => 'Information Technology Officer II',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '1',
        		'signatory_name' => 'Jay Carlou C. Sabado',
        		'signatory_position' => 'Information Technology Officer I',
        		'category' => '1',
        		'is_activated' => '0',
        	],[
        		'office_id' => '23',
        		'signatory_name' => 'Anna Liza A. Esperanza',
        		'signatory_position' => 'City Budget Officer',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '26',
        		'signatory_name' => 'Dr. Eduardo S. Posadas',
        		'signatory_position' => 'City Health Officer',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '34',
        		'signatory_name' => 'Flosie P. Decena',
        		'signatory_position' => 'City Veterenarian',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '33',
        		'signatory_name' => 'Edmar C. Luna',
        		'signatory_position' => 'City Treasurer',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '21',
        		'signatory_name' => 'Eduvijis T. Flores',
        		'signatory_position' => 'City Agriculturist',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '36',
        		'signatory_name' => 'Efren E. Javier',
        		'signatory_position' => 'Public Safety Officer',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '2',
        		'signatory_name' => 'Ernesto V. Datuin',
        		'signatory_position' => 'City Administrator',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '31',
        		'signatory_name' => 'Evelyn A. Guhit',
        		'signatory_position' => 'City Administrator',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '3',
        		'signatory_name' => 'Ferdinand B. Formacion',
        		'signatory_position' => 'Chief Inspector',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '35',
        		'signatory_name' => 'Hon. Alfredo Pablo R. Ortega',
        		'signatory_position' => 'City Vice Mayor',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '13',
        		'signatory_name' => 'Madeline R. Tadifa',
        		'signatory_position' => 'OIC-City Engineer',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '29',
        		'signatory_name' => 'Hon. Hemenegildo A. Gualberto',
        		'signatory_position' => 'City Mayor',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '38',
        		'signatory_name' => 'Margaret I. Farolan',
        		'signatory_position' => 'Secretary to the Sanggunian Panlungsod',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '5',
        		'signatory_name' => 'Marylin R. Jucar',
        		'signatory_position' => 'City Market Supervisor',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '20',
        		'signatory_name' => 'Mercy G. Go',
        		'signatory_position' => 'City Accountant',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '28',
        		'signatory_name' => 'Michael Nagas',
        		'signatory_position' => 'OIC-City Library',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '15',
        		'signatory_name' => 'Mikka Francesca H. Buenaventura',
        		'signatory_position' => 'Information Officer',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '27',
        		'signatory_name' => 'Nancy R. Lopez-Bilaoen',
        		'signatory_position' => 'City Legal Officer',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '18',
        		'signatory_name' => 'Ofelia V. Mendoza',
        		'signatory_position' => 'City Government Assistant Department Head',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '14',
        		'signatory_name' => 'Patricia Gerogina F. Tano',
        		'signatory_position' => 'City Government Assistant Department Head',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '30',
        		'signatory_name' => 'Rizalina G. Cristobal',
        		'signatory_position' => 'OIC - Planning and Development Office',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '19',
        		'signatory_name' => 'Rizalyn Medrano',
        		'signatory_position' => 'OIC - Planning and Development Office',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '32',
        		'signatory_name' => 'Sally C. Matoza',
        		'signatory_position' => 'City Social Welfare Officer',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '25',
        		'signatory_name' => 'Teresita M. Gacayan',
        		'signatory_position' => 'OIC - City General Services Office',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '22',
        		'signatory_name' => 'Thelma A. Jucutan',
        		'signatory_position' => 'OIC - Assistant City Assessor',
        		'category' => '1',
        		'is_activated' => '1',
        	],[
        		'office_id' => '24',
        		'signatory_name' => 'Valmar M. Valdez',
        		'signatory_position' => 'City Environment and Natural Resources Officer',
        		'category' => '1',
        		'is_activated' => '1',
        	],

        	//Appropriation Avail.
        	[
        		'office_id' => '23',
        		'signatory_name' => 'Anna Liza A. Esperanza',
        		'signatory_position' => 'OIC-City Budget Officer',
        		'category' => '2',
        		'is_activated' => '1',
        	],

        	//Cash Avail.
        	[
        		'office_id' => '33',
        		'signatory_name' => 'Edmar C. Luna',
        		'signatory_position' => 'City Treasurer',
        		'category' => '3',
        		'is_activated' => '1',
        	],

        	//Approval
        	[
        		'office_id' => '29',
        		'signatory_name' => 'Hon. Hemenegildo A. Gualberto',
        		'signatory_position' => 'City Mayor',
        		'category' => '4',
        		'is_activated' => '1',
        	],[
        		'office_id' => '35',
        		'signatory_name' => 'Hon. Alfredo Pablo R. Ortega',
        		'signatory_position' => 'City Vice Mayor',
        		'category' => '4',
        		'is_activated' => '0',
        	],[
        		'office_id' => '37',
        		'signatory_name' => 'Hon. Maria Rosario Eufrosina P. Nisce	',
        		'signatory_position' => 'City Councilor',
        		'category' => '4',
        		'is_activated' => '0',
        	],

        	//Technical Working Group
        	[
        		'office_id' => '42',
        		'signatory_name' => 'Ma. Teresa Navarro',
        		'signatory_position' => 'Goods & Supplies',
        		'category' => '5',
        		'is_activated' => '1',
        	],[
        		'office_id' => '42',
        		'signatory_name' => 'Elvy N. Casilla',
        		'signatory_position' => 'Goods & Supplies',
        		'category' => '5',
        		'is_activated' => '1',
        	],[
        		'office_id' => '42',
        		'signatory_name' => 'Gem Tamani',
        		'signatory_position' => 'Construction & Supplies',
        		'category' => '5',
        		'is_activated' => '1',
        	],[
        		'office_id' => '42',
        		'signatory_name' => 'Madeline Tadifa',
        		'signatory_position' => 'Construction & Supplies',
        		'category' => '5',
        		'is_activated' => '1',
        	],[
        		'office_id' => '42',
        		'signatory_name' => 'Jovito Casuga',
        		'signatory_position' => 'Auto Repair & Supplies',
        		'category' => '5',
        		'is_activated' => '1',
        	],[
        		'office_id' => '42',
        		'signatory_name' => 'Germie O. Deang',
        		'signatory_position' => 'IT & Supplies',
        		'category' => '5',
        		'is_activated' => '1',
        	],

        	//Property Officer
        	[
        		'office_id' => '25',
        		'signatory_name' => 'Alexander Flores',
        		'signatory_position' => 'GSO',
        		'category' => '6',
        		'is_activated' => '1',
        	],
        	//Inspection Officer
        	[
        		'office_id' => '1',
        		'signatory_name' => 'Kendrix Chan',
        		'signatory_position' => 'Administrative Aide IV',
        		'category' => '7',
        		'is_activated' => '1',
        	],
        ];

        foreach ($signatories as $key => $signatory) {
        	# code...
        	Signatory::create($signatory);
        }
    }
}
