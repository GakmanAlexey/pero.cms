<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
$cartCount = $this->data_view["countData"];
echo json_encode([
    'success' => true,
    'cart_count' => $this->data_view["countData"],
    'timestamp' => date('Y-m-d H:i:s')
]);

exit;
?>