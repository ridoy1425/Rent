<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addProperty;
use App\Models\propertyType;

class AddPropertyController extends Controller
{
    public function index()
    {
        $propertyType = propertyType::orderBy('id')->get();
        return view('addProperty')->with('propertyType',$propertyType);
    }

    public function store(Request $request)
    {
        
        // dd('hasdioasdf');
        $input = new addProperty();
        $input->userId = session('loginId');
        $input->propertyName = $request->propertyName;
        $input->propertyType = $request->propertyType;
        $input->location = $request->location;
        $input->propertySize = $request->propertySize;
        $input->numbersOfRooms = $request->numbersOfRooms;
        $input->numbersOfWashrooms = $request->numbersOfWashrooms;
        $input->facilities = $request->facilities;
        $input->save();

        return redirect()->back()->with('success','Data Store Successfully');

    }
}
