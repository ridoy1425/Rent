<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillCollectionController extends Controller
{
    public function index()
    {
        return view('billCollection');
    }
}
