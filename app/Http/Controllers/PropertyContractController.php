<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addProperty;
use App\Models\propertyType;
use App\Models\PropertyContract;

class PropertyContractController extends Controller
{
    public function index()
    {
        $propertyDetails = addProperty::select('id','propertyName','facilities')->where('userId', session('loginId'))->get();
        return view('propertyContract')->with('propertyDetails',$propertyDetails);
    }

    public function propertTypeSearch(Request $request)
    {
        $propertyId = $request->propertyId;
        $propertyData = addProperty::select('propertyType','facilities')->where('id',$propertyId)->first();
        $propertyTypeId = $propertyData->propertyType;
        $propertyTypeData = propertyType::select('propertyType')->where('id',$propertyTypeId)->first();
        $propertyTypeName = $propertyTypeData->propertyType;
        return response()->json([$propertyTypeName,$propertyData]) ;
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'houseBill' => 'required|numeric',
            'advanceBill' => 'numeric',
            'tenentPhone' => 'required|regex:/(01)[0-9]{9}/'
            ]);

        // other bill management 
        $otherBillDetails = $request->otherBillName;
        $otherBillArray = array();
        if($otherBillDetails)
        {            
            foreach($otherBillDetails as $key=>$row)
            {
                $otherBillArray[] =array(
                    "billName" => $row,
                    "billAmount" => $request->otherBillAmount[$key]
                );
            }
        }        

        // insert into database
        $input = new PropertyContract();
        $input->userId = session('loginId');
        $input->tenentName = $request->tenentName;
        $input->tenentAddress = $request->tenentAddress;
        $input->tenentPhone = $request->tenentPhone;
        $input->tenentProfession = $request->tenentProfession;
        $input->tenentNID = $request->tenentNID;
        $input->propertyName = $request->propertyName;
        $input->houseBill = $request->houseBill;
        $input->gas = $request->Gas;
        $input->water = $request->Water;
        $input->electicity = $request->Electicity;
        $input->elevator = $request->Elevator;
        $input->garage = $request->Garage;
        $input->guard = $request->Guard;
        $input->camera = $request->Camera;
        $input->advanceBill = $request->advanceBill;
        $input->flatNumber = $request->flatNumber;        
        $input->gasBill = $request->gasBill;
        $input->waterIniUnit = $request->waterIniUnit;
        $input->waterPerCost = $request->waterPerCost;
        $input->electicityIniUnit = $request->electicityIniUnit;
        $input->electicityPerCost = $request->electicityPerCost;
        $input->elevatorBill = $request->elevatorBill;
        $input->garageCharge = $request->garageCharge;
        $input->guardBill = $request->guardBill;
        $input->otherBill = $otherBillArray;
       
        $input->save();

        return redirect()->back()->with('success','Data Store Successfully');
    }
}
