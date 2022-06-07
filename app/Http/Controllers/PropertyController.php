<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\propertyType;

class PropertyController extends Controller
{
    public function index()
    {
        $propertyType = propertyType::orderBy('propertyType')->get();
        return view('addProperty')->with('propertyType',$propertyType);
    }

    public function store(Request $request)
    {
        $property = Property::where('propertyName',$request->propertyName)->first();
        if($property)
        {
            return redirect()->back()->with('error','Propery Already Exist');
        }
        else
        {
            $input = new Property();
            $input->userId = session('loginId');
            $input->propertyName = $request->propertyName;
            $input->propertyType = $request->propertyType;
            $input->state = $request->state;
            $input->postalCode = $request->postalCode;
            $input->city = $request->city;
            $input->country = $request->country;
            $input->propertyAge = $request->propertyAge;
            $input->bedRooms = $request->bedRooms;
            $input->belcony = $request->belcony;
            $input->rooms = $request->rooms;
            $input->washrooms = $request->washrooms;
            $input->propertySize = $request->propertySize;
            $input->amenities = $request->amenities;
            $input->save();

            return redirect()->back()->with('success','Propery Create Successfully');
        }
    }

    public function propertyListView()
    {
        $property = Property::where('userId', session('loginId'))->orderBy('id','DESC')->get();
        return view('propertyList')->with('property',$property);
    }

    public function propertyEdit($id)
    {
        $property = Property::find($id);
        $propertyType = propertyType::orderBy('id')->get();
        return view('propertyListEdit')->with('property',$property)->with('propertyType',$propertyType);
    }

    public function propertyUpdate(Request $request,$id)
    {
       
        $propertyData = Property::find($id);        
        $propertyData->userId = session('loginId');
        $propertyData->propertyName = $request->propertyName;
        $propertyData->propertyType = $request->propertyType;
        $propertyData->state = $request->state;
        $propertyData->postalCode = $request->postalCode;
        $propertyData->city = $request->city;
        $propertyData->country = $request->country;
        $propertyData->propertyAge = $request->propertyAge;
        $propertyData->bedRooms = $request->bedRooms;
        $propertyData->belcony = $request->belcony;
        $propertyData->rooms = $request->rooms;
        $propertyData->washrooms = $request->washrooms;
        $propertyData->propertySize = $request->propertySize;
        $propertyData->amenities = $request->amenities;
        $propertyData->save();

        return redirect('/propertyList')->with('success','Property Update Successfully');
    }

    public function propertyDelete($id)
    {

        // $ContractData = PropertyContract::where('propertyName',$id)->first();
        // if($ContractData)
        // {
        //     $ContractData->delete();
        //     $collectionData = BillCollection::where('propertyContractId',$ContractData->id)->first();
        //     if($collectionData)
        //     {
        //         $collectionData->delete();
        //     }
        // }        
        $propertyData = Property::find($id);
        $propertyData -> delete();
        return redirect('/propertyList')->with('success','Property Delete Duccessfully');
    }
}
