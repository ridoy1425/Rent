<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Unit;
use App\Models\Tenant;
use App\Models\Contract;
use App\Models\Payment;
use App\Http\Traits\Calculation;
use App\Models\Registration;

class PropertyContractController extends Controller
{
    use Calculation;
    public function index()
    {
        $property = Property::where('userId', session('loginId'))->get();
        $tenant = Tenant::where('userId', session('loginId'))->get();        
        return view('propertyContract')->with('property',$property)->with('tenant',$tenant);
    }
    // autocomplete search
    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = Registration::select('phone_number')->where('phone_number', 'LIKE', '%'. $query. '%')->where('type', '0')->pluck('phone_number');
          return response()->json($filterResult);
    }

    public function tenantSearch(Request $request)
    {
        $query = $request->get('tenantSearch');
        $tenantResult = Registration::where('phone_number', $query)->where('type', '0')->first();
        return response()->json($tenantResult);
    }

    public function unitSearch(Request $request)
    {
        $propertyId = $request->propertyId;
        $unitName = Unit::select('id','unitName')->where('userId', session('loginId'))->where('propertyName',$propertyId)->get();
        return response()->json($unitName);
    }

    public function contractStore(Request $request)
    {

        $contract = Contract::where('userId', session('loginId'))->where('propertyName',$request->propertyName)
                            ->where('tenantName',$request->tenantName)->where('unitName',$request->unitName)->first();
        $payment = Payment::where('userId', session('loginId'))->where('propertyName',$request->propertyName)
                            ->where('tenantName',$request->tenantName)->where('unitName',$request->unitName)->first();
        if($contract)
        {
            return redirect()->back()->with('error','This Contract Is Already Done');
        }
        else
        {
            // image Management
            $imageName = time().'.'.$request->document->extension();
            $request->document->move(public_path('images/contract'),$imageName);
            // insert into database
            $input = new Contract();
            $input->userId = session('loginId');
            $input->tenantName = $request->tenantName;
            $input->propertyName = $request->propertyName;
            $input->hasUnit = $request->unitCreate;
            $input->unitName = $request->unitName;
            $input->deadline = $request->deadline;
            $input->frequency = $request->frequency;
            $input->document = $imageName;
            $input->save();
            
            $totalAmount = $this->totalAmount();
            
            foreach($totalAmount as $data)
            {
                if($data['id'] == $request->unitName or $data['id']== $request->propertyName)
                {
                    $amount =  $data['totalAmount'];
                }                
            }
            
            $payment = new Payment();
            $payment->userId = session('loginId');
            $payment->tenantName = $request->tenantName;
            $payment->propertyName = $request->propertyName;
            $payment->unitName = $request->unitName;
            $payment->PaidAmount = 0;
            $payment->advanceAmt = 0;
            $payment->dueAmount = $amount;
            $payment->method = 0;
            $payment->save();

            return redirect()->back()->with('success','Contract Has Made Successfully');
        } 
    }

    public function contractList()
    {
        $contract = Contract::where('userId', session('loginId'))->orderBy('id','DESC')->get();
        return view('contractList')->with('contract',$contract);
    }
}
