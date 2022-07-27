<?php

namespace App\Http\Controllers\Api;

use App\Actions\GenerateArticleModelAction;
use Illuminate\Http\Request;

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
