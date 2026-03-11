<?php

declare(strict_types=1);

namespace App\Actions\Styles;

use App\Models\Style;

final class CreateStyleAction
{
    public function handle(string $name, ?int $srm): Style
    {
        return Style::create([
            'name' => $name,
            'srm' => $srm,
        ]);
    }
}
