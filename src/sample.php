<?php

$input = fgets(STDIN);
var_dump($input);
var_dump(trim($input));
$judge = (trim($input) == ('Y' || 'y'));
var_dump($judge);
