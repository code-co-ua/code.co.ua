<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckSession extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'id' => $request->session()->getId(),
        ]);
    }
}
