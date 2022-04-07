<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PropertyListController extends Controller
{
    public function index()
    {
        return view('propertyList');
    }
}
