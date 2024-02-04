<?php

namespace App\Http\Controllers\threed\agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('threed.agent.index');
    }
}
