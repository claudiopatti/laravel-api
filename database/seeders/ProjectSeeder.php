<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Helpers
use Illuminate\Support\Facades\Schema;

// Models 
use App\Models\{
    Project,
    Type,
    Technology
};

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Project::truncate();
        });

        for ($i=0; $i < 15; $i++) { 
            $name = fake()->words(3, true);
            $slug = str()->slug($name);

            $randomTypeId = null;
            if (rand(0,2)) {
                $randomType = Type::inRandomOrder()->first();
                $randomTypeId = $randomType->id;
            }

            $project = Project::create([
                'name' => $name,
                'slug' => $slug,
                'description' => fake()->text(),
                'delivery_time' => rand(1,110),
                'price' => fake()->randomFloat(2, 1 , 99999),
                'cover' => fake()->imageUrl(),
                'complete' => fake()->boolean(80),
                'type_id' => $randomTypeId
            ]);

            $technologyIds =[];
            for ($j = 0; $j < rand(0, Technology::count()) ; $j++) { 
                $randomTechnology = Technology::inRandomOrder()->first();

                if (!in_array($randomTechnology->id, $technologyIds)) {
                    $technologyIds[] = $randomTechnology->id;
                }
            }

            $project->technologies()->sync($technologyIds);
        }
    }
}
