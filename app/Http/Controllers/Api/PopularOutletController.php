<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/api/popular-outlets",
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK"
 *     )
 * )
 */
class PopularOutletController extends Controller
{
    public function index()
    {
        return config('mock_data.popular_outlets');
    }
}
