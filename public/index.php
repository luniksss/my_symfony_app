<?php

use App\Kernel;

require_once __DIR__.'/../vendor/autoload_runtime.php';
require_once __DIR__.'/../vendor/autoload.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};