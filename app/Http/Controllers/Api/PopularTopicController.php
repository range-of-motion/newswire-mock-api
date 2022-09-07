<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/api/popular-topics",
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK"
 *     )
 * )
 */
class PopularTopicController extends Controller
{
    public function index()
    {
        return config('mock_data.popular_topics');
    }
}
