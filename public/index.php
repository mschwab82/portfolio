<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';
// require_once './functions/Utilities.php';

// require_once './functions/JSON_Merge.php';

/* logData('Session wurde gestartet ' . $_SERVER['DOCUMENT_ROOT'] ); */

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};