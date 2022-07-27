<?php

namespace App\Http\Controllers\Api;

use App\Actions\GeneratePersonModelAction;
use Illuminate\Http\Request;

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
