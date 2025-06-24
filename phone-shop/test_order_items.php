<?php

// Test Order Items functionality

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Boot Laravel
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== ORDER ITEMS TABLE TEST ===\n\n";

try {
    // 1. Test database connection
    $pdo = new PDO('mysql:host=localhost;dbname=phone_shop_db', 'root', '');
    echo "✓ Database connection: OK\n";
    
    // 2. Check order_items table structure
    echo "\n--- ORDER_ITEMS TABLE STRUCTURE ---\n";
    $stmt = $pdo->query("DESCRIBE order_items");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($columns as $col) {
        echo "- {$col['Field']}: {$col['Type']} ({$col['Null']})\n";
    }
    
    // 3. Test OrderItem model fillable
    echo "\n--- TESTING ORDERITEM MODEL ---\n";
    $orderItem = new \App\Models\OrderItem();
    $fillable = $orderItem->getFillable();
    echo "Fillable fields: " . implode(', ', $fillable) . "\n";
    
    // 4. Check if all fillable fields exist in table
    echo "\n--- FIELD VALIDATION ---\n";
    $tableColumns = array_column($columns, 'Field');
    foreach ($fillable as $field) {
        if (in_array($field, $tableColumns)) {
            echo "✓ $field: EXISTS\n";
        } else {
            echo "✗ $field: NOT EXISTS\n";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\n=== TEST COMPLETED ===\n";

?>
