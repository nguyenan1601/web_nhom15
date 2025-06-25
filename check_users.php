<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$app->boot();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

echo "Users table columns:\n";
$columns = Schema::getColumnListing('users');
foreach ($columns as $column) {
    echo "- $column\n";
}

echo "\nUsers table structure:\n";
$structure = DB::select('DESCRIBE users');
foreach ($structure as $col) {
    echo "- {$col->Field}: {$col->Type} ({$col->Null}) {$col->Key}\n";
}

echo "\nNumber of users: " . DB::table('users')->count() . "\n";
