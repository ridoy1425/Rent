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
        $propertyDetails = addProperty::select('id','propertyName')->get();
        return view('propertyContract')->with('propertyDetails',$propertyDetails);
    }

    public function propertTypeSearch(Request $request)
    {
        $propertyId = $request->propertyId;
        $propertyData = addProperty::select('propertyType')->where('id',$propertyId)->first();
        $propertyTypeId = $propertyData->propertyType;
        $propertyTypeData = propertyType::select('propertyType')->where('id',$propertyTypeId)->first();
        $propertyTypeName = $propertyTypeData->propertyType;

        return response()->json($propertyTypeName) ;
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'houseBill' => 'required|numeric',
            'gasBill' => 'required|numeric',
            'waterBill' => 'required|numeric',
            'utilityBill' => 'required|numeric',
            'advanceBill' => 'required|numeric',
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
        $input->propertyName = $request->propertyName;
        $input->houseBill = $request->houseBill;
        $input->gasBill = $request->gasBill;
        $input->waterBill = $request->waterBill;
        $input->utilityBill = $request->utilityBill;
        $input->advanceBill = $request->advanceBill;
        $input->flatNumber = $request->flatNumber;
        $input->otherBill = $otherBillArray;
        $input->tenentName = $request->tenentName;
        $input->tenentAddress = $request->tenentAddress;
        $input->tenentPhone = $request->tenentPhone;
        $input->tenentProfession = $request->tenentProfession;
        $input->tenentNID = $request->tenentNID;
        $input->save();

        return redirect()->back()->with('success','Data Store Successfully');
    }
}
