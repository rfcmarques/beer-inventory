<?php

declare(strict_types=1);

arch()->preset()->php();

arch()->preset()->laravel();

arch('strict types')
    ->expect('App')
    ->toUseStrictTypes();