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
     * @param boolean $error
     */
    private function message($message = "", $type = "success", $status = 200, $error = false)
    {
        return response()->json(["message" => [
            "error" => $error,
            "code" => $status,
            "message" => $message,
            "type" => $type
        ]], $status);
    }
}
