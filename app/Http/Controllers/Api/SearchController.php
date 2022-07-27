<?php

namespace App\Http\Controllers\Api;

use App\Actions\GenerateArticleModelAction;
use App\Actions\GenerateOutletModelAction;
use App\Actions\GeneratePersonModelAction;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'query' => 'required',
        ]);

        $simplifiedQuery = strtolower($request->query('query'));

        $people = [];
        foreach (config('mock_data.people') as $i => $person) {
            $person = (new GeneratePersonModelAction())->execute($person, $i + 1);

            $doesNameMatch = strpos($person['name'], $simplifiedQuery) !== false;

            if ($doesNameMatch) {
                $people[] = $person;
            }
        }

        $articles = [];
        foreach (config('mock_data.articles') as $i => $article) {
            $article = (new GenerateArticleModelAction())->execute($article, $i + 1);

            $doesTitleMatch = strpos(strtolower($article['title']), $simplifiedQuery) !== false;

            if ($doesTitleMatch) {
                $articles[] = $article;
            }
        }

        $outlets = [];
        foreach (config('mock_data.outlets') as $i => $outlet) {
            $outlet = (new GenerateOutletModelAction())->execute($outlet, $i + 1);

            $doesNameMatch = strpos(strtolower($outlet['name']), $simplifiedQuery) !== false;
            $doesBioMatch = strpos(strtolower($outlet['bio']), $simplifiedQuery) !== false;

            if ($doesNameMatch || $doesBioMatch) {
                $outlets[] = $outlet;
            }
        }

        return [
            'people' => $people,
            'articles' => $articles,
            'outlets' => $outlets,
        ];
    }
}
