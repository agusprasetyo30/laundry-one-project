<?php

namespace Database\Seeders;

use App\Models\AdditionalLogic;
use Illuminate\Database\Seeder;

class AdditionalLogicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdditionalLogic::create([
            'module_name' => 'promo',
            'param_name' => 'expired_promo_date',
            'attr1_val' => '2026-01-31 10:00:00',
            'attr2_val' => null,
            'attr3_val' => null,
        ]);

        $this->command->info('AdditionalLogicSeeder: Seeded additional logic data successfully.');
    }
}
