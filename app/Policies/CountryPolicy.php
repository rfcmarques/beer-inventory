<?php

namespace App\Policies;

use App\Traits\Policies\AdminOnlyMutations;
use App\Traits\Policies\AdminOnlyViewing;

class CountryPolicy
{
    use AdminOnlyViewing, AdminOnlyMutations;
}
