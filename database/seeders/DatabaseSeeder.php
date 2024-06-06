<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Student;
use App\Models\Parameter;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         //User::factory(10)->create();



        // Student::factory(20)->create();
         Parameter::factory(1)->create();
        
        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
