<?php

require 'vendor/autoload.php';

ini_set('display_errors', 1);

use Estudacom\Model\Person;
use Estudacom\Model\House;

var_dump(Person::all());

$person = Person::find(1);
var_dump($person);

var_dump($person->house());

var_dump(House::all());

$house = House::find(1);
var_dump($house);

var_dump($house->people());

