<?php
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'phone_shop_db',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

try {
    $columns = Capsule::schema()->getColumnListing('orders');
    echo "Orders table columns:\n";
    foreach ($columns as $column) {
        echo "- $column\n";
    }
    
    echo "\nChecking if shipped_by column exists: ";
    echo in_array('shipped_by', $columns) ? "YES" : "NO";
    echo "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}