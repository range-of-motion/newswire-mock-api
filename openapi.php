<?php

require_once './vendor/autoload.php';

$openapi = \OpenApi\Generator::scan(['./app/Http/Controllers']);
echo $openapi->toYaml();
