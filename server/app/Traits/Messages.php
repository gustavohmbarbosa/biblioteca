<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait Messages
{
    /**
     *  Message
     *
     * @param string $message
     * @param int $id
     * @param int $status
     * @return json
     */
    private function message($message, $id = 0, $status = 200)
    {
        return response()->json([
          "code"  => $status,
          "message" => $message,
          "id"      => $id
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
    private function errorMessage($message, $status = 404)
    {
        return response()->json([
          "error" => true,
          "code" => $status,
          "message" => $message
        ], $status);
    }
}
