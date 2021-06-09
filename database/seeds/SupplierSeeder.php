<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        foreach(range(0,10) as $i){
            DB::table('supplier')->insert([
                'nama_supplier' => $faker->company,
                'alamat' => $faker->address
            ]);
        }
    }
}
