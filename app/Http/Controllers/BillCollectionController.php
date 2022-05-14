<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyContract;
use App\Models\BillCollection;
use App\Models\Registration;
use PDF;

class BillCollectionController extends Controller
{
    public function index()
    {
        $contractData = PropertyContract::where('userId', session('loginId'))->orderBy('id')->get();
        // $colectionArray = array();
        // if($contractData)
        // {
        //     foreach($contractData as $row)
        //     {
        //         $totalAmount = $row->houseBill+$row->gasBill+$row->waterBill+$row->utilityBill;
        //         $otherBill = $row->otherBill;
        //         if($otherBill)
        //         {
        //             foreach($otherBill as $value)
        //             {
        //                 $totalAmount = $totalAmount + $value['billAmount'];
        //             }
                
        //         }
        //         $dueAmountData = BillCollection::select('dueAmount','paymentDate')->where('propertyContractId',$row->id)->first();
                
        //         if($dueAmountData)
        //         {
        //             $paymentDate = strtotime($dueAmountData->paymentDate);
        //             $curentDate = strtotime(date('y-m-d'));
        //             $difference = abs($curentDate-$paymentDate);
        //             $months = floor($difference/60/60/24/30);
        //             $monthlyAmount = $totalAmount * $months;
        //             $dueAmount = $dueAmountData->dueAmount;
        //             $finalAmount =  $monthlyAmount + $dueAmount;
        //         }
        //         else
        //         {
        //             $dueAmount = "0";
        //             $finalAmount = $totalAmount;
        //         }
        //         $totalAmountArray = array(
        //             'id' => $row->id,
        //             'amount' => $finalAmount,
        //             'monthly' => $totalAmount,
        //             'due' => $dueAmount
        //         );
        //     $colectionArray[] =  $totalAmountArray;
        //     }
            
        // }
        // dd($contractData);
        return view('billCollection')->with('contractData',$contractData);
    }

    public function billGenerate(Request $request)
    {
        $electricPUnit = $request->pUnitElecticity;
        $waterpUnit = $request->pUnitWater;
        $contractId = $request->inputContractId;
        $paymentDate = $request->paymentDate;
        
        // function call
        $response = $this->totalAmount($electricPUnit,$waterpUnit,$contractId);
        $waterBill = $response['waterBill'];
        $electricBill = $response['electricBill'];
        $totalAmount = $response['totalAmount'];
        $contractData = $response['contractData'];
        $userInfo = $response['userInfo'];

        return view('invoice')->with('waterBill',$waterBill)->with('electricBill',$electricBill)->with('contractData',$contractData)
                            ->with('totalAmount',$totalAmount)->with('userInfo',$userInfo)->with('paymentDate',$paymentDate);
                            // ->with('electricPUnit',$electricPUnit)->with('waterpUnit',$waterpUnit)->with('contractId',$contractId);
    }

    public function pdfDownload(Request $request)
    {
        $waterBill = $request->waterBill;
        $electricBill = $request->electricBill;
        $contractData = $request->contractData;
        $totalAmount = $request->totalAmount;
        $userInfo = $request->userInfo;
        $paymentDate = $request->paymentDate;
        $data = [
            'waterBill' => $waterBill,
            'electricBill' => $electricBill,
            'contractData' => $contractData,
            'totalAmount' => $totalAmount,
            'userInfo' => $userInfo,
            'paymentDate' => $paymentDate
        ];
        
        $pdf = PDF::loadView('pdfgenarator',$data);
	    return $pdf->stream('Rent.pdf');
    }

    function totalAmount($electricPUnit,$waterpUnit,$contractId)
    {
        // dd($contractId)    ; 
        $userInfo = Registration::where('id',session('loginId'))->first();
        $contractData = PropertyContract::where('id',$contractId)->where('userId',session('loginId'))->first();  
        
        if($contractData)
        {
            $totalAmount = 0;
            $waterBill = 0;
            $electricBill = 0;
            // calculate water bill
            if($contractData->water != '1')
            {
                $waterIniUnit = $contractData->waterIniUnit;
                $waterUnitCost = $contractData->waterPerCost;
                $waterBill = ($waterpUnit - $waterIniUnit) * $waterUnitCost;
                $totalAmount += $waterBill;
            }            
            // calculate electric bill
            if($contractData->electicity != '1')
            {
                $electricIniUnit = $contractData->electicityIniUnit;
                $electricUnitCost = $contractData->electicityPerCost;
                $electricBill = ($electricPUnit - $electricIniUnit) * $electricUnitCost;
                $totalAmount += $electricBill;
            }
            $totalAmount += $contractData->houseBill+$contractData->gasBill+$contractData->elevatorBill+$contractData->garageCharge+$contractData->guardBill;
            $otherBill = $contractData->otherBill;
            if($otherBill)
            {
                foreach($otherBill as $key=>$value)
                {
                    $totalAmount += $value['billAmount'];
                }
            
            }
        }
        $response['totalAmount'] = $totalAmount;
        $response['waterBill'] = $waterBill;
        $response['electricBill'] = $electricBill;
        $response['contractData'] = $contractData;
        $response['userInfo'] = $userInfo;

        return $response;
    }

   
}
