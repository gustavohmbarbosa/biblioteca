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
    private function message($message = "", $status = 200, $type = "success", $error = false)
    {
        return response()->json(["message" => [
            "error" => $error,
            "message" => $message,
            "type" => $type,
            "code" => $status,
        ]], $status);
    }
}
