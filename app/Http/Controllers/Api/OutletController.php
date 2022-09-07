<?php

namespace App\Http\Controllers\Api;

use App\Actions\GenerateOutletModelAction;
use App\Http\Controllers\Controller;
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
    public function show(Request $request, int $id)
    {
        $outlet = config('mock_data.outlets')[$id - 1] ?? null;

        if (!$outlet) {
            abort(404);
        }

        $model = (new GenerateOutletModelAction())->execute($outlet, $id);

        return $model;
    }
}
