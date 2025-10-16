<?php

try {
    $service = new \Modules\Cdek\Modul\Servicewidget(
         'wqGwiQx0gg8mLtiEKsUinjVSICCjtTEP',

        'RmAmgvSgSl1yirlz9QupbzOJVqhCxcP5');
        
    $service->process($_GET, file_get_contents('php://input'));
} catch (\Exception $e) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Fatal error: ' . $e->getMessage(),
        'error' => 'FATAL_ERROR'
    ]);
}
?>