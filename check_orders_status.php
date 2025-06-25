<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Order;

echo "=== KIỂM TRA TRẠNG THÁI ĐỚN HÀNG ===\n";

$orders = Order::select('id', 'order_number', 'status', 'created_at')->get();

if ($orders->count() > 0) {
    foreach ($orders as $order) {
        echo "Đơn hàng #{$order->order_number} - Trạng thái: {$order->status} - Ngày: {$order->created_at->format('d/m/Y')}\n";
    }
    
    echo "\n=== THỐNG KÊ THEO TRẠNG THÁI ===\n";
    $statusCounts = Order::selectRaw('status, COUNT(*) as count')->groupBy('status')->get();
    foreach ($statusCounts as $status) {
        echo "{$status->status}: {$status->count} đơn hàng\n";
    }
} else {
    echo "Không có đơn hàng nào trong hệ thống.\n";
}

echo "\n=== TEST TẠO ĐƠN HÀNG TRẠNG THÁI DELIVERED ===\n";
echo "Tạo đơn hàng test với trạng thái 'delivered'...\n";

try {
    $testOrder = Order::create([
        'order_number' => 'TEST-' . time(),
        'status' => 'delivered',
        'total_amount' => 1000000,
        'shipping_first_name' => 'Test',
        'shipping_last_name' => 'User',
        'shipping_email' => 'test@example.com',
        'shipping_phone' => '0123456789',
        'shipping_address' => 'Test Address',
        'shipping_city' => 'Test City',
        'payment_method' => 'cod',
        'delivered_at' => now(),
        'notes' => 'Đơn hàng test để kiểm tra nút "Đã nhận hàng"'
    ]);
    
    echo "✅ Đã tạo đơn hàng test #{$testOrder->order_number} với trạng thái 'delivered'\n";
    echo "Bây giờ bạn có thể vào trang đơn hàng để thấy nút 'Đã nhận hàng'\n";
} catch (Exception $e) {
    echo "❌ Lỗi tạo đơn hàng test: " . $e->getMessage() . "\n";
}

?>
