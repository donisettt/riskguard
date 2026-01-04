<?php

/**
 * Helper class untuk mengirim JSON Response yang konsisten
 */
class JsonResponse
{
    /**
     * Kirim response sukses
     */
    public static function success($message, $data = null, $statusCode = 200)
    {
        http_response_code($statusCode);

        $response = [
            'success' => true,
            'message' => $message
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Kirim response error
     */
    public static function error($message, $statusCode = 400, $errors = null)
    {
        http_response_code($statusCode);

        $response = [
            'success' => false,
            'message' => $message
        ];

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Set CORS headers untuk API
     */
    public static function setCorsHeaders()
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        // Handle preflight request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }
    }

    /**
     * Parse JSON body dari request
     */
    public static function getJsonBody()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            self::error('Invalid JSON format', 400);
        }

        return $data;
    }

    /**
     * Validasi required fields
     */
    public static function validateRequired($data, $requiredFields)
    {
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            self::error('Missing required fields', 400, [
                'missing_fields' => $missingFields
            ]);
        }

        return true;
    }
}
