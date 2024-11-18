<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $programs = [
            'angel_tree', 'kids_clubs', 'promis_path', 'scholarship_program', 'poorna_jeevana'
        ];
        foreach ($programs as $program) {
            \App\Models\Program::create([
                'name' => $program,
            ]);
        }

        $prisons = [
            'Agunukolapallassa','Ambepussa','Anuradhapura','Badulla','Batticalo','Bogambara','Boossa',
            'Colombo Remand','Dumbara','Gall','Jaffna','Kaluthara','Kandewatta','Kandurugasaara','Kegall','Kuruwita',
            'Magazine','Mahara','Matara','Meethirigala','Monaragala','Negambo','Pallakale','Pallansena','Polonnaruwa',
            'Thaldena','Trincomalee','Vavunia','Waariyapola','Wallikada','Wataraka','Weerawila'
        ];
        foreach ($prisons as $prison) {
            \App\Models\Prison::create([
                'name' => $prison,
            ]);
        }
    }
}
