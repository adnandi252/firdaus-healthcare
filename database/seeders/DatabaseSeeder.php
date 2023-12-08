<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Pharmacist;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Doctor::create([
        //     'user_id' => 4,
        //     'spesialist' => 'Penyakit Dalam',
        //     'address' => 'Jl. Raya Bogor',
        //     'active_day' => 'monday',
        //     'start_hour' => '08:00:00',
        //     'end_hour' => '16:00:00',
        // ]);
        // Patient::create([
        //     'user_id' => 2,
        //     'address' => 'Jl. Raya Jogja',
        //     'birth_date' => '2004-10-10',
        //     'phone' => '082345765213',
        // ]);
        // Pharmacist::create([
        //     'user_id' => 5,
        //     'address' => 'Jl. Raya Makassar',
        //     'birth_date' => '2007-11-30',
        //     'phone' => '081211344588',
        // ]);
        // User::create([
        //     'name' => 'doctor',
        //     'email' => 'doctor@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'role' => 'doctor'
        // ]);
        // User::create([
        //     'name' => 'pharmacist',
        //     'email' => 'pharmacist@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'role' => 'pharmacist'
        // ]);
    }
}