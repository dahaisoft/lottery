<?php
// Here you can initialize variables that will be available to your tests

use Codeception\Util\Fixtures;

require codecept_root_dir() . '/src/Lottery.php';
require codecept_root_dir() . '/vendor/autoload.php';

Fixtures::add('runTimes', 1000);
