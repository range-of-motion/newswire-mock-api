<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
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
    public function show(Article $article)
    {
        return $article;
    }
}
