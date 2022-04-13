<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyContract;

class RentListController extends Controller
{
    public function index()
    {
        $propertyContractData = PropertyContract::all();
        return view('rentList')->with('propertyContractData',$propertyContractData);
    }
}
