<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Unit;
use App\Models\Contract;
use App\Http\Traits\Calculation;

class UnitController extends Controller
{
    use Calculation;
    public function unitCreateView()
    {
        $property = Property::select('id','propertyName','amenities')->where('userId', session('loginId'))->orderBy('id')->get();
        return view('unitCreate')->with('property',$property);
    }

    public function propertSearch(Request $request)
    {
        $propertyId = $request->propertyId;
        $propertyData = Property::select('amenities')->where('id',$propertyId)->first();
        return response()->json($propertyData) ;
    }

    public function createUnit(Request $request)
    {
        $this->validate($request,[
            'houseRent' => 'required|numeric',
            'deposit' => 'numeric'
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
        if($request->unitName)
        {
            $unit = Unit::where('userId', session('loginId'))->where('propertyName',$request->propertyName)->where('unitName',$request->unitName)->first();
            $unitName = $request->unitName;
        }
        else{
            $unit = Unit::where('userId', session('loginId'))->where('propertyName',$request->propertyName)->where('unitName',"fixed")->first();
            $unitName = 'fixed';
        }
        
        if($unit)
        {
            return redirect()->back()->with('error','This Property and Unit Already Exist');
        }
        else{
             // insert into database
            $input = new Unit();
            $input->userId = session('loginId');
            $input->propertyName = $request->propertyName;
            $input->unitName = $unitName;
            $input->houseRent = $request->houseRent;
            $input->deposit = $request->deposit;
            $input->gasBill = $request->gasBill;
            $input->electricity = $request->Electricity;
            $input->electricBill = $request->electricBill;
            $input->electricIniUnit = $request->electricIniUnit;
            $input->electricUnitCost = $request->electricUnitCost;
            $input->water = $request->Water;
            $input->waterBill = $request->waterBill;
            $input->waterIniUnit = $request->waterIniUnit;        
            $input->waterUnitCost = $request->waterUnitCost;
            $input->carParkingBill = $request->carParkingBill;
            $input->guardBill = $request->guardBill;
            $input->elevatorBill = $request->elevatorBill;
            $input->securityBill = $request->securityBill;
            $input->internetBill = $request->internetBill;
            $input->othersBill = $otherBillArray; 
            $input->save();

            return redirect()->back()->with('success','Unit Create Successfully');
        }
       
    }
    

    public function unitsList()
    {
        $totalAmount = $this->totalAmount();
        $units = Unit::where('userId', session('loginId'))->orderBy('id','DESC')->get();
        $contract = Contract::select('id','propertyName','unitName','tenantName')->where('userId', session('loginId'))->get();
        return view('unitsList')->with('units',$units)->with('contract',$contract)->with('totalAmount',$totalAmount);
    }

    public function unitsDetails($id)
    {
        $units = Unit::where('userId', session('loginId'))->where('id',$id)->orderBy('id','DESC')->first();
        $propertyName = Property::select('propertyName')->where('userId', session('loginId'))->where('id',$units->propertyName)->first();
        return view('unitDetails')->with('units',$units)->with('propertyName',$propertyName);
    }

    public function unitEdit($id)
    {
        $property = Property::select('id','propertyName','amenities')->where('userId', session('loginId'))->orderBy('id')->get();
        $unit = Unit::where('id',$id)->first();
        return view('unitEdit')->with('property',$property)->with('unit',$unit);
    }
}
