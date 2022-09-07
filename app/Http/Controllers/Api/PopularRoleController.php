<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/api/popular-roles",
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK"
 *     )
 * )
 */
class PopularRoleController extends Controller
{
    public function index()
    {
        return config('mock_data.popular_roles');
    }
}
