<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\BillCollection;
use App\Models\Registration;
use App\Models\Payment;
use App\Models\PresentUnit;
use App\Models\Unit;
use App\Models\PaymentMethod;
use PDF;
use Carbon\Carbon;
use DB;
class BillCollectionController extends Controller
{
    public function index()
    {
        $contractData = Contract::where('userId', session('loginId'))->orderBy('id')->get();
        $paymentData = Payment::where('userId', session('loginId'))->latest('id')->first();
        $paymentMethod = PaymentMethod::all();
        return view('payment')->with('contractData',$contractData)->with('paymentData',$paymentData)->with('paymentMethod',$paymentMethod);
    }

    public function payment(Request $request)
    {
        $payment = new Payment();
        $payment->userId = session('loginId');
        $payment->tenantName = $request->tenantName;
        $payment->propertyName = $request->propertyName;
        $payment->unitName = $request->unitName;
        $payment->PaidAmount = $request->paidAmount;
        $payment->advanceAmt = $request->advanceAmt;
        $payment->dueAmount = $request->dueAmount;
        $payment->method = $request->payMethod;
        $payment->save();

        return redirect('billCollection')->with('success','Payment Has Successfully');

    }

    public function presentUnit(Request $request)
    {
        $presentUnit = new PresentUnit();
        $presentUnit->userId = session('loginId');
        $presentUnit->tenantName = $request->tenantName;
        $presentUnit->propertyName = $request->propertyName;
        $presentUnit->unitName = $request->unitName;
        $presentUnit->electricPreUnit = $request->electricPreUnit;
        $presentUnit->waterPreUnit = $request->waterPreUnit;
        $presentUnit->save();

        $totalAmount = 0;
        $unitData = Unit::findOrFail($request->unitName);
        if($unitData) {
            if($request->electricPreUnit)
            {
                $electricPreUnit = $request->electricPreUnit;
                $electricIniUnit = $unitData->electricIniUnit;
                $electricUnitCost = $unitData->electricUnitCost;
                $electricBill = ($electricPreUnit - $electricIniUnit) * $electricUnitCost;
                $totalAmount += $electricBill;

                $unitData->electricity = 4;
                $unitData->save();
            }
            if($request->waterPreUnit)
            {
                $waterPreUnit = $request->waterPreUnit;
                $waterIniUnit = $unitData->waterIniUnit;
                $waterUnitCost = $unitData->waterUnitCost;
                $waterBill = ($waterPreUnit - $waterIniUnit) * $waterUnitCost;
                $totalAmount += $waterBill;

                $unitData->water = 4;
                $unitData->save();
            }
            
        }
        // $payment = Payment::where('userId',session('loginId'))->where('tenantName',$request->tenantName)->where('propertyName',$request->propertyName)->where('unitName',$request->unitName)->first();
       
        $updatePayment = Payment::findOrFail($request->paymentId);
        $totalAmount += $updatePayment->dueAmount;
        $updatePayment->dueAmount = $totalAmount;
        $updatePayment->save();

        return redirect('billCollection')->with('success','Present Unit Insert Successfully');
    }

    public function paymentHistory(Request $request)
    {
        $tenant = $request->tenant;
        $property = $request->property;
        $unit = $request->unit;

        $paymentHistory = DB::table('payments')
                        ->join('payment_methods', 'payments.method', '=', 'payment_methods.id')->select('payments.*','payment_methods.method')
                        ->where('payments.userId',session('loginId'))->where('payments.tenantName',$tenant)->where('payments.propertyName',$property)
                        ->where('payments.unitName',$unit)->whereMonth('payments.created_at', date('m'))
                        ->orderBy('payments.id','DESC')
                        ->get();
        // dd($paymentHistory);        
        // return Payment::find(2)->findMethod;
        return response()->json($paymentHistory);
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
