<?php

require_once('Model.php');
require_once('Formation.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pdo = new PDO('sqlite:' . __DIR__ . '/database.db');


$data = [ 'name' => 'wwwacademy', 'role' => 'student'];

$formation = new Formation($pdo);

$formation->create($data);

$formation->createTable();