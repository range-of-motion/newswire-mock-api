<?php

namespace App\Http\Controllers\Api;

use App\Actions\GenerateArticleModelAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/api/articles/{id}",
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
class ArticleController extends Controller
{
    public function show(Request $request, int $id)
    {
        $article = config('mock_data.articles')[$id - 1] ?? null;

        if (!$article) {
            abort(404);
        }

        $model = (new GenerateArticleModelAction())->execute($article, $id);

        return $model;
    }
}
