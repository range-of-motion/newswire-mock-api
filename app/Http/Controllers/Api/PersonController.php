<?php

namespace App\Http\Controllers\Api;

use App\Actions\GeneratePersonModelAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function show(Request $request, int $id)
    {
        $person = config('mock_data.people')[$id - 1] ?? null;

        if (!$person) {
            abort(404);
        }

        // Find and attach articles written by person
        $person['articles'] = array_filter(config('mock_data.articles'), function ($article) use ($person) {
            return $article['author'] === $person['name'];
        });

        $model = (new GeneratePersonModelAction())->execute($person, $id);

        return $model;
    }
}
