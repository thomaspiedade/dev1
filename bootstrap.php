<?php
include __DIR__ . '/vendor/autoload.php';
DB::init();
$Storage = new PDOStorage( DB::PDOInstance() );
include __DIR__ . '/config/routes.php';