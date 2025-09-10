<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
$cartCount = "19";
echo json_encode([
    'success' => true,
    'cart_count' => $cartCount,
    'timestamp' => date('Y-m-d H:i:s')
]);

exit;
?>