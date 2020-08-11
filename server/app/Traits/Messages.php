<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait Messages
{
    /**
     *  Message
     *
     * @param string $message
     * @param int $status
     * @param string $type
     * @return json
     */
    private function message($message, $status = 200, $type = "success")
    {
        return response()->json([
            "message" => $message,
            "type" => $type,
            "code" => $status,
        ], $status);
    }

    /**
     *  Error message
     *
     * @param string $message
     * @param int $status
     * @param string $type
     * @return json
     */
    private function errorMessage($message, $status = 404, $type = "warning")
    {
        return response()->json([
            "error" => true,
            "message" => $message,
            "type" => $type,
            "code" => $status,
        ], $status);
    }
}
