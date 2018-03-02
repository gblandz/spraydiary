<?php

use Illuminate\Database\Seeder;

class ChemtypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chemtypes')->insert(array(
             array('id'=>'1','name'=>'Insecticides'),
             array('id'=>'2','name'=>'Fungicides'),
             array('id'=>'3','name'=>'Fertilisers'),

          ));
    }
}
