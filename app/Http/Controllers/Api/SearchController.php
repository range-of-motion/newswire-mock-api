<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/searches/recent",
     *
     *     @OA\Response(
     *         response="200",
     *         description="OK"
     *     )
     * )
     */
    public function recent()
    {
        $searches = Search::query()
            ->latest()
            ->limit(5)
            ->get();

        return $searches->map(function ($search) {
            return [
                'id' => $search->id,
                'query' => $search->query,
                'searched_at' => $search->created_at,
            ];
        });
    }

    /**
     * @OA\Get(
     *     path="/api/searches/saved",
     *
     *     @OA\Response(
     *         response="200",
     *         description="OK"
     *     )
     * )
     */
    public function saved()
    {
        $searches = Search::query()
            ->latest()
            ->where('saved', true)
            ->limit(5)
            ->get();

        return $searches->map(function ($search) {
            return [
                'id' => $search->id,
                'query' => $search->query,
                'searched_at' => $search->created_at,
            ];
        });
    }
}
