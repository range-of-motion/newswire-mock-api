<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/api/outlets/{id}",
 *
 *     @OA\Parameter(
 *       name="id",
 *       in="path",
 *       required=true,
 *       @OA\Schema(type="integer")
 *     ),
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK"
 *     ),
 *
 *     @OA\Response(
 *         response="404",
 *         description="Not Found"
 *     )
 * )
 */
class OutletController extends Controller
{
    public function show(Outlet $outlet)
    {
        return $outlet;
    }
}
