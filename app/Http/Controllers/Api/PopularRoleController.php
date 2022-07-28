<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PopularRoleController extends Controller
{
    public function index()
    {
        return config('mock_data.popular_roles');
    }
}
