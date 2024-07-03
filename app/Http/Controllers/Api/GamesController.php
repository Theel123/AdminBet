<?php

namespace App\Http\Controllers\Api;

use App\Models\Games;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GamesController extends Controller
{
    public function index() 
    {
        $games = Games::get();

        return response()->json($games, 200);
    }
}
