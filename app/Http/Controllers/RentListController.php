<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyContract;
use App\Models\addProperty;
use App\Models\BillCollection;

class RentListController extends Controller
{
    public function index()
    {
        $propertyContractData = PropertyContract::orderBy('id')->get();
        return view('rentList')->with('propertyContractData',$propertyContractData);
    }

    public function rentListEdit($id)
    {
        $ContractData = PropertyContract::find($id);
        $propertyData = addProperty::select('propertyName','id')->get();
        return view('rentListEdit')->with('ContractData',$ContractData)->with('propertyData',$propertyData);
    }

    public function updateRentList(Request $request, $id)
    {
        $this->validate($request,[
            'houseBill' => 'required|numeric',
            'gasBill' => 'required|numeric',
            'waterBill' => 'required|numeric',
            'utilityBill' => 'required|numeric',
            'advanceBill' => 'required|numeric',
            'tenentPhone' => 'required|regex:/(01)[0-9]{9}/'
            ]);
        
        // otherbill management
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
        $ContractData = PropertyContract::find($id);
        $ContractData->propertyName = $request->propertyName;
        $ContractData->houseBill = $request->houseBill;
        $ContractData->gasBill = $request->gasBill;
        $ContractData->waterBill = $request->waterBill;
        $ContractData->utilityBill = $request->utilityBill;
        $ContractData->advanceBill = $request->advanceBill;
        $ContractData->flatNumber = $request->flatNumber;
        $ContractData->otherBill = $otherBillArray;
        $ContractData->tenentName = $request->tenentName;
        $ContractData->tenentAddress = $request->tenentAddress;
        $ContractData->tenentPhone = $request->tenentPhone;
        $ContractData->tenentProfession = $request->tenentProfession;
        $ContractData->tenentNID = $request->tenentNID;
        $ContractData->save();

        return redirect('/rentList')->with('success','Data update successfully');
    }

    public function rentListDelete($id)
    {
        $ContractData = PropertyContract::find($id);
        $ContractData -> delete();

        $collectionData = BillCollection::where('propertyContractId',$id)->first();
        if($collectionData)
        {
            $collectionData->delete();
        }
        

        return redirect('/rentList')->with('success','Data delete successfully');
    }
}
