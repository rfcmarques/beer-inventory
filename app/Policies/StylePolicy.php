<?php

declare(strict_types=1);

namespace App\Policies;

use App\Traits\Policies\AdminOnlyMutations;
use App\Traits\Policies\PublicViewing;

class StylePolicy
{
    use PublicViewing, AdminOnlyMutations;
}
