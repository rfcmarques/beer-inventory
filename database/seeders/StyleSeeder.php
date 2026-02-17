<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Style;
use Illuminate\Database\Seeder;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Style::factory(100)->make()->each(function ($style) {
            Style::firstOrCreate(
                ['name' => $style->name],
                $style->toArray()
            );
        });
    }
}
