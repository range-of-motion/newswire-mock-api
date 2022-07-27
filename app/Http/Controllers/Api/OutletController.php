<?php

namespace App\Http\Controllers\Api;

use App\Actions\GenerateOutletModelAction;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function show(Request $request, int $id)
    {
        $outlet = config('mock_data.outlets')[$id - 1] ?? null;

        if (!$outlet) {
            abort(404);
        }

        $model = (new GenerateOutletModelAction())->execute($outlet, $id);

        return $model;
    }
}
