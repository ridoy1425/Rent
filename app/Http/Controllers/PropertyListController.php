<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addProperty;
use App\Models\propertyType;
use App\Models\PropertyContract;
use App\Models\BillCollection;

class PropertyListController extends Controller
{
    public function index()
    {
        $propertyList = addProperty::orderBy('id')->get();
        return view('propertyList')->with('propertyList',$propertyList);
    }

    public function propertyEdit($id)
    {
        $propertyList = addProperty::find($id);
        $propertyType = propertyType::orderBy('id')->get();
        // dd($propertyList->securitySystem);
        return view('propertyListEdit')->with('propertyList',$propertyList)->with('propertyType',$propertyType);
    }

    public function propertyUpdate(Request $request,$id)
    {
        $propertyData = addProperty::find($id);
        $propertyData->propertyName = $request->propertyName;
        $propertyData->propertyType = $request->propertyType;
        $propertyData->location = $request->location;
        $propertyData->propertySize = $request->propertySize;
        $propertyData->numbersOfRooms = $request->numbersOfRooms;
        $propertyData->numbersOfWashrooms = $request->numbersOfWashrooms;
        $propertyData->carParking = $request->carParking;
        $propertyData->securitySystem = $request->securitySystem;
        $propertyData->save();

        return redirect('/propertyList')->with('success','Data update successfully');
    }

    public function propertyDelete($id)
    {

        $ContractData = PropertyContract::where('propertyName',$id)->first();
        if($ContractData)
        {
            $ContractData->delete();
            $collectionData = BillCollection::where('propertyContractId',$ContractData->id)->first();
            if($collectionData)
            {
                $collectionData->delete();
            }
        }
        
        $propertyData = addProperty::find($id);
        $propertyData -> delete();
        

        
        

        return redirect('/propertyList')->with('success','Data delete successfully');
    }
}
