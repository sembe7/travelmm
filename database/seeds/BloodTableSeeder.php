<?php

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
        //
        DB::table('users_blood_type')->insert([
            'blood_type' => 'O(I)',
        ]);
        DB::table('users_blood_type')->insert([
            'blood_type' => 'A(II)',
        ]);
        DB::table('users_blood_type')->insert([
            'blood_type' => 'B(III)',
        ]);
        DB::table('users_blood_type')->insert([
            'blood_type' => 'AB(IV)',
        ]);
    }
}
