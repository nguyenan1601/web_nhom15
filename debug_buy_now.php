<?php
// Debug file để kiểm tra nút mua ngay
echo "POST data:\n";
print_r($_POST);

echo "\nGET data:\n";
print_r($_GET);

echo "\nRequest method: " . $_SERVER['REQUEST_METHOD'] . "\n";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n";
?>
