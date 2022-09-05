<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Contract;
use File;

class TenantController extends Controller
{
    public function tenantRegisterView()
    {
        return view('tenant.tenantProperty');
    }

    public function tenantStore(Request $request)
    {
        $tenant = Tenant::where('name',$request->name)->first();
        if($tenant)
        {
            return redirect()->back()->with('error','Tenant Already Exist');
        }
        else
        {
            // validation
            $this->validate($request,[
                'phone' => 'required|regex:/(01)[0-9]{9}/',
                'relativePhone' => 'required|regex:/(01)[0-9]{9}/'
            ]);
            // image Management
            $imageName = $request->name.'.'.$request->image->extension();
            $request->image->move(public_path('images/tenant'),$imageName);
            // insert into database
            $input = new Tenant();
            $input->userId = session('loginId');
            $input->name = $request->name;
            $input->phone = $request->phone;
            $input->email = $request->email;
            $input->nidNo = $request->nidNo;
            $input->address = $request->address;
            $input->image = $imageName;
            $input->ocupation = $request->ocupation;
            $input->workPlace = $request->workPlace;
            $input->relation = $request->relation;
            $input->relativeName = $request->relativeName;
            $input->relativePhone = $request->relativePhone;
            $input->save();

            return redirect()->back()->with('success','Tenant Register Successfully');
        }
    }

    public function tenantListView()
    {
        $tenant = Tenant::where('userId', session('loginId'))->orderBy('id','DESC')->get();
        $contract = Contract::select('id','propertyName','unitName','tenantName')->where('userId', session('loginId'))
                                ->distinct('tenantName')->get();
                                // dd($contract);
                
        return view('tenantlist')->with('tenant',$tenant)->with('contract',$contract);
    }

    public function tenantEdit($id)
    {
        $tenant = Tenant::find($id);        
        return view('tenantListEdit')->with('tenant',$tenant);
    }

    public function tenantUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'relativePhone' => 'required|regex:/(01)[0-9]{9}/'
        ]);
        // data update
        $input = Tenant::find($id);
        $input->userId = session('loginId');
        $input->name = $request->name;
        $input->phone = $request->phone;
        $input->email = $request->email;
        $input->nidNo = $request->nidNo;
        $input->address = $request->address;        
        $input->ocupation = $request->ocupation;
        $input->workPlace = $request->workPlace;
        $input->relation = $request->relation;
        $input->relativeName = $request->relativeName;
        $input->relativePhone = $request->relativePhone;
        // image Management

        $oldImage=$input->image;
        if($request->image)
        {
            unlink(public_path().'\images/tenant'.$oldImage );
            $imageName = $request->name.'.'.$request->image->extension();
            $request->image->move(public_path('images'),$imageName);
            $input->image = $imageName;
        }
        else
        {
            $input->image = $oldImage;
        }
        $input->save();

        return redirect('/tenantList')->with('success', 'Tenant Update Successfully');        
    }

    public function tenantDelete($id)
    {
        $tenant = Tenant::find($id);
        if (File::exists(public_path().'\images/tenant/'.$tenant->image))
        {
            unlink(public_path().'\images/tenant/'.$tenant->image );
        }        
        $tenant->delete();

        return redirect('/tenantList')->with('success','Tenant Delete Duccessfully');
    }
}
