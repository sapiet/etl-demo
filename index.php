<?php

use BenTools\ETL\EtlBuilder;

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/extractor.php';
require_once __DIR__.'/transformer.php';
require_once __DIR__.'/loader.php';
require_once __DIR__.'/recipe.php';

const API_URL = 'https://jsonplaceholder.typicode.com/users';

$pdo = new PDO('mysql:dbname=etl_demo;host=localhost', 'root', '$4piet00');

$etl = EtlBuilder::init()
    ->useRecipe(new Recipe($pdo))
    ->createEtl()
    ->process(API_URL);
