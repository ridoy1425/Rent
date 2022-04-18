<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyContract;
use App\Models\BillCollection;

class BillCollectionController extends Controller
{
    public function index()
    {
        $contractData = PropertyContract::all();
        $colectionArray = array();
        if($contractData)
        {
            foreach($contractData as $row)
            {
                $totalAmount = $row->houseBill+$row->gasBill+$row->waterBill+$row->utilityBill;
                $otherBill = $row->otherBill;
                if($otherBill)
                {
                    foreach($otherBill as $value)
                    {
                        $totalAmount = $totalAmount + $value['billAmount'];
                    }
                
                }
                $dueAmountData = BillCollection::select('dueAmount','paymentDate')->where('propertyContractId',$row->id)->first();
                
                if($dueAmountData)
                {
                    $paymentDate = strtotime($dueAmountData->paymentDate);
                    $curentDate = strtotime(date('y-m-d'));
                    $difference = abs($curentDate-$paymentDate);
                    $months = floor($difference/60/60/24/30);
                    $monthlyAmount = $totalAmount * $months;
                    $dueAmount = $dueAmountData->dueAmount;
                    $finalAmount =  $monthlyAmount + $dueAmount;
                }
                else
                {
                    $dueAmount = "0";
                    $finalAmount = $totalAmount;
                }
                $totalAmountArray = array(
                    'id' => $row->id,
                    'amount' => $finalAmount,
                    'monthly' => $totalAmount,
                    'due' => $dueAmount
                );
            $colectionArray[] =  $totalAmountArray;
            }
            
        }
        return view('billCollection')->with('colectionArray',$colectionArray);
    }

    public function billPayment(Request $request)
    {
        $contractId = $request->inputContractId;
        $billCollectionData = BillCollection::select('propertyContractId')->where('propertyContractId',$contractId)->first();
        if($billCollectionData)
        {
            BillCollection::where(['propertyContractId'=>$contractId])
                            ->update(['dueAmount' => $request->dueAmount,'totalAmount'=>$request->total_amt,'paymentDate'=>$request->paymentDate]);
        }
        else{
            $input = new BillCollection();
            $input->propertyContractId = $request->inputContractId;
            $input->totalAmount = $request->total_amt;
            $input->dueAmount = $request->dueAmount;
            $input->paymentDate = $request->paymentDate;
            $input->save();
        }
 
        return redirect('/billCollection')->with('success','Payment Successfull');
    }
}
