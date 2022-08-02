<?php

namespace App\Http\Controllers\Api;

use App\Actions\GenerateArticleModelAction;
use App\Actions\GenerateOutletModelAction;
use App\Actions\GeneratePersonModelAction;
use App\Actions\SearchArticlesAction;
use App\Actions\SearchOutletsAction;
use App\Actions\SearchPeopleAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'query' => 'required_without:outlets',
            'outlets' => 'required_without:query',
        ]);

        $outlets = $request->query('outlets') ? explode(',', $request->query('outlets')) : [];

        $people = (new SearchPeopleAction())->execute(
            $request->query('query'),
            $outlets,
        );

        $articles = (new SearchArticlesAction())->execute(
            $request->query('query'),
            $outlets,
        );

        $outlets = (new SearchOutletsAction())->execute(
            $request->query('query'),
            $outlets,
        );

        return [
            'people' => $people,
            'articles' => $articles,
            'outlets' => $outlets,
        ];
    }
}
