<?php

namespace App\Exceptions;

use Exception;

class PostNotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'success' => false,
            'message' => 'Пост не найден.'
        ], 404);
    }
}
