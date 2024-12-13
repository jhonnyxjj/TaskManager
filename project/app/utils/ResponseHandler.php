<?php

namespace project\app\utils;

class ResponseHandler {
    
    public static function jsonResponse(array $data, int $statusCode ) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
       $json = json_encode($data);
           
        if ($json === false) {
            $error = json_last_error_msg();
            http_response_code(500);
            echo json_encode(['error' => "Erro ao processar JSON: $error"]);
            exit;
        }
        echo $json;
        exit;
    }
}