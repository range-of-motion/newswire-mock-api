<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/api/popular-media-types",
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK"
 *     )
 * )
 */
class PopularMediaTypeController extends Controller
{
    public function index()
    {
        return config('mock_data.popular_media_types');
    }
}
