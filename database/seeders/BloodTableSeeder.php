<?php

namespace Database\Seeders;

use App\Models\Type_Blood;
use Illuminate\Database\Seeder;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type_Blood::truncate();

        $bgs = ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];

        foreach($bgs as  $bg){
            Type_Blood::create(['Name' => $bg]);
        }
    }
}
