<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\System;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             // force password to be 'password'
                'password' => bcrypt('password'),
         ]);




        // Create the root systems (systems without parents)
        $rootSystems = System::factory(2)->create();

        // Create child systems for each root system
        foreach ($rootSystems as $rootSystem) {
            $childSystems = System::factory(2)->create([
                'parent_system_id' => $rootSystem->id,
            ]);

            // Create grandchildren for each child system (optional)
            foreach ($childSystems as $childSystem) {
                System::factory(1)->create([
                    'parent_system_id' => $childSystem->id,
                ]);
            }
        }

         \App\Models\Item::factory(10)->create();

         //\App\Models\Subsystem::factory(10)->create(); // cria 10 itens
         // create user
         //\App\Models\User::factory(1)->create();
    }
}
