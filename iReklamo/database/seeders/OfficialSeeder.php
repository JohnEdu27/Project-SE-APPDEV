<?php

namespace Database\Seeders;

use App\Models\Officials;
use Illuminate\Database\Seeder;

class OfficialSeeder extends Seeder
{
    public function run(): void
    {
        $officials = [
    ['name' => 'Juan Dela Cruz',  'position' => 'Barangay Tanod',     'categories' => ['noise', 'garbage', 'peace_order']],
    ['name' => 'Maria Santos',    'position' => 'Barangay Captain',   'categories' => ['road', 'flooding', 'fire', 'life_at_risk']],
    ['name' => 'Pedro Reyes',     'position' => 'Barangay Secretary', 'categories' => ['utilities', 'stray_animals'], 'is_default' => true],
];

        foreach ($officials as $o) {
            Officials::updateOrCreate(['name' => $o['name']], $o);
        }
    }
}