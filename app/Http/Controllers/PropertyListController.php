<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addProperty;

class PropertyListController extends Controller
{
    public function index()
    {
        $propertyList = addProperty::all();
        return view('propertyList')->with('propertyList',$propertyList);
    }

    public function propertyListEdit()
    {
        return view('propertyListEdit');
    }
}
