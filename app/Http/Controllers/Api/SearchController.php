<?php

namespace App\Http\Controllers\Api;

use App\Actions\GenerateArticleModelAction;
use App\Actions\GenerateOutletModelAction;
use App\Actions\GeneratePersonModelAction;
use App\Actions\SearchArticlesAction;
use App\Actions\SearchOutletsAction;
use App\Actions\SearchPeopleAction;
use App\Http\Controllers\Controller;
use App\Models\Search;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/api/search",
 *
 *     @OA\Parameter(
 *       name="query",
 *       in="query",
 *       required=false,
 *       @OA\Schema(type="string")
 *     ),
 *
 *     @OA\Parameter(
 *       name="roles",
 *       in="query",
 *       required=false,
 *       @OA\Schema(type="string")
 *     ),
 *
 *     @OA\Parameter(
 *       name="outlets",
 *       in="query",
 *       required=false,
 *       @OA\Schema(type="string")
 *     ),
 *
 *     @OA\Parameter(
 *       name="locations",
 *       in="query",
 *       required=false,
 *       @OA\Schema(type="string")
 *     ),
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK"
 *     ),
 *
 *     @OA\Response(
 *         response="422",
 *         description="Unprocessable Entity"
 *     )
 * )
 */
class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'query' => 'required_without_all:roles,outlets,locations',
            'roles' => 'required_without_all:query,outlets,locations',
            'outlets' => 'required_without_all:query,roles,locations',
            'locations' => 'required_without_all:query,roles,outlets',
        ]);

        Search::create([
            'query' => $request->getQueryString(),
        ]);

        $roles = $request->query('roles') ? explode(',', $request->query('roles')) : [];
        $outlets = $request->query('outlets') ? explode(',', $request->query('outlets')) : [];
        $locations = $request->query('locations') ? explode(',', $request->query('locations')) : [];

        $people = (new SearchPeopleAction())->execute(
            $request->query('query'),
            $roles,
            $outlets,
            $locations,
        );

        $articles = (new SearchArticlesAction())->execute(
            $request->query('query'),
            $roles,
            $outlets,
            $locations,
        );

        $outlets = (new SearchOutletsAction())->execute(
            $request->query('query'),
            $roles,
            $outlets,
            $locations,
        );

        return [
            'people' => $people,
            'articles' => $articles,
            'outlets' => $outlets,
        ];
    }
}
