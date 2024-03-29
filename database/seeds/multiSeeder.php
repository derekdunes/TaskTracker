<?php

use Illuminate\Database\Seeder;

class multiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('clients')->delete();

        $clients = [
          [
          	'client_code' => 'ABSU',
          	'client_name' => 'ABIA STATE UNIVERSITY'
          ],
          [
          	'client_code' => 'ABIAPOLY',
          	'client_name' => 'ABIA STATE POLYTECHNIC'            
          ],
          [
          	'client_code' => 'ILARO',
          	'client_name' => 'FEDERAL POLYTECHNIC ILARO'          	
          ],
          [
            'client_code' => 'ABSCOTECH(COHA)',
            'client_name' => 'ABIA STATE COLLEGE OF HEALTH ABA'            
          ],
        ];


    DB::table('clients')->insert($clients);

    }
}
