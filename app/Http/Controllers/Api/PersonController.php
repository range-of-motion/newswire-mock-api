<?php

namespace App\Http\Controllers\Api;

use App\Actions\GeneratePersonModelAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/api/people/{id}",
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
class PersonController extends Controller
{
    public function show(Request $request, int $id)
    {
        $person = config('mock_data.people')[$id - 1] ?? null;

        if (!$person) {
            abort(404);
        }

        $model = (new GeneratePersonModelAction())->execute($person, $id);

        return $model;
    }
}
